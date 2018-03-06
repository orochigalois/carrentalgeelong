<?php
/**
 * @package NRS
 * @author Kestutis Matuliauskas
 * @copyright Kestutis Matuliauskas
 * See Licensing/README_License.txt for copyright notices and details.
 */
use NativeRentalSystem\Models\Configuration\ExtensionConfiguration;
use NativeRentalSystem\Models\Validation\StaticValidator;
use NativeRentalSystem\Models\Language\Language;
use Stripe\Stripe;
use Stripe\Charge AS StripeCharge;
use Stripe\Error\Card AS StripeCardError;

class NRSStripeProcessor
{
    protected $conf 	                = NULL;
    protected $lang 		            = NULL;
    protected $debugMode 	            = 0;

    protected $currencyCode		        = 'USD';
    protected $companyName              = "";

    public function __construct(ExtensionConfiguration &$paramConf, Language &$paramLang, array $paramSettings)
    {
        // Set class settings
        $this->conf = $paramConf;
        // Already sanitized before in it's constructor. Too much sanitation will kill the system speed
        $this->lang = $paramLang;

        $this->currencyCode = StaticValidator::getValidSetting($paramSettings, 'conf_currency_code', "textval", "USD");
        $this->companyName = StaticValidator::getValidSetting($paramSettings, 'company_name', "textval", "");

        // Initialize stripe
        require_once('init.php');
    }

    /**
     * Based on https://stripe.com/docs/charges
     * @param $paramPrivateKey
     * @param $paramBookingCode
     * @param string $paramTotalPayNow
     * @return bool
     */
    public function process($paramPrivateKey, $paramBookingCode, $paramTotalPayNow = '0.00')
    {
        $success = TRUE;
        $sanitizedBookingCode = sanitize_text_field($paramBookingCode);
        $validTotalPayNowInCents = intval($paramTotalPayNow * 100);

        // Are you writing a plugin that integrates Stripe and embeds our library?
        // Then please use the setAppInfo function to identify your plugin. For example:
        Stripe::setAppInfo($this->conf->getExtensionName(), $this->conf->getVersion(), "https://profiles.wordpress.org/KestutisIT");

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey(sanitize_text_field($paramPrivateKey));

        // Get the credit card details submitted by the form
        $token = isset($_POST['stripeToken']) ? sanitize_text_field($_POST['stripeToken']) : "";

        // Create a charge: this will charge the user's card
        try
        {
            $charge = StripeCharge::create(array(
                "amount" => $validTotalPayNowInCents, // Amount in cents
                "currency" => $this->currencyCode,
                "source" => $token,
                "description" => $this->companyName.': '.$sanitizedBookingCode,
            ));

            /** Return is object, with demo response.
             * Example is from here: https://stripe.com/docs/api#metadata
             * When call is Stripe charges v1:
             * $ curl https://api.stripe.com/v1/charges \
            -u sk_test_BQokikJOvBiI2HlWgH4olfQ2: \
            -d amount=2000 \
            -d currency=usd \
            -d source=tok_189faZ2eZvKYlo2CqFhJ2iLh \
            -d metadata[order_id]=6735
             * Then example response is the following:
            Example Response{
            "id": "ch_19F41L2eZvKYlo2CyzjX9Q8r",
            "object": "charge",
            "amount": 100,
            "amount_refunded": 0,
            "application": null,
            "application_fee": null,
            "balance_transaction": "txn_18tjj22eZvKYlo2CeFxM3FxI",
            "captured": true,
            "created": 1478966783,
            "currency": "usd",
            "customer": null,
            "description": null,
            "destination": null,
            "dispute": null,
            "failure_code": null,
            "failure_message": null,
            "fraud_details": {
            },
            "invoice": null,
            "livemode": false,
            "metadata": {
            "order_id": "6735"
            },
            "order": null,
            "outcome": {
            "network_status": "approved_by_network",
            "reason": null,
            "risk_level": "normal",
            "seller_message": "Payment complete.",
            "type": "authorized"
            },
            "paid": true,
            "receipt_email": null,
            "receipt_number": null,
            "refunded": false,
            "refunds": {
            "object": "list",
            "data": [
            ],
            "has_more": false,
            "total_count": 0,
            "url": "/v1/charges/ch_19F41L2eZvKYlo2CyzjX9Q8r/refunds"
            },
            "review": null,
            "shipping": null,
            "source": {
            "id": "card_19F41K2eZvKYlo2CNnNawij1",
            "object": "card",
            "address_city": null,
            "address_country": null,
            "address_line1": null,
            "address_line1_check": null,
            "address_line2": null,
            "address_state": null,
            "address_zip": null,
            "address_zip_check": null,
            "brand": "Visa",
            "country": "US",
            "customer": null,
            "cvc_check": "pass",
            "dynamic_last4": null,
            "exp_month": 10,
            "exp_year": 2017,
            "funding": "credit",
            "last4": "4242",
            "metadata": {
            },
            "name": null,
            "tokenization_method": null
            },
            "source_transfer": null,
            "statement_descriptor": null,
            "status": "succeeded"
            }
             */
        } catch(StripeCardError $e)
        {
            // The card has been declined
            $success = FALSE;
        }

        return $success;
    }
}
