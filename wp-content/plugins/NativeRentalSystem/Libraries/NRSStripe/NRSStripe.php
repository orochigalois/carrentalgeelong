<?php
/**
 * PayPal process class
 * Final class cannot be inherited anymore. We use them when creating new instances
 * @package NRS
 * @author Kestutis Matuliauskas
 * @copyright Kestutis Matuliauskas
 * See Licensing/README_License.txt for copyright notices and details.
 */
use NativeRentalSystem\Models\Configuration\ExtensionConfiguration;
use NativeRentalSystem\Models\Logging\Log;
use NativeRentalSystem\Models\Validation\StaticValidator;
use NativeRentalSystem\Models\PaymentMethod\PaymentMethod;
use NativeRentalSystem\Models\PaymentResource\iPaymentResource;
use NativeRentalSystem\Models\Language\Language;

class NRSStripe implements iPaymentResource
{
    protected $conf 	                = NULL;
    protected $lang 		            = NULL;
    protected $debugMode 	            = 0;
    protected $settings                 = array();

    // Array holds the fields to submit to PayPal
    protected $fields                   = array();
    protected $use_ssl                  = TRUE;

    protected $businessEmail            = "";
    protected $useSandbox               = FALSE;
    protected $currencySymbol	        = '$';
    protected $currencyCode		        = 'USD';
    protected $companyName              = "";
    protected $confirmationPageId       = 0;
    protected $cancelledPaymentPageId   = 0;
    protected $publicKey                = '';
    protected $privateKey               = '';

    protected $bookingCode              = "";
    protected $totalPayNow              = 0.00;

    /**
     * NRSStripe constructor.
     * @param ExtensionConfiguration &$paramConf
     * @param Language &$paramLang
     * @param array $paramSettings
     * @param int $paramPaymentMethodId
     */
    public function __construct(ExtensionConfiguration &$paramConf, Language &$paramLang, array $paramSettings, $paramPaymentMethodId)
    {
        // Set class settings
        $this->conf = $paramConf;
        // Already sanitized before in it's constructor. Too much sanitation will kill the system speed
        $this->lang = $paramLang;
        $this->settings = $paramSettings;

        $objPaymentMethod = new PaymentMethod($this->conf, $this->lang, $paramSettings, $paramPaymentMethodId);
        $paymentMethodDetails = $objPaymentMethod->getDetails();
        $this->businessEmail = isset($paymentMethodDetails['payment_method_email']) ? sanitize_email($paymentMethodDetails['payment_method_email']) : "";
        $this->useSandbox = !empty($paymentMethodDetails['sandbox_mode']) ? TRUE : FALSE;
        $this->publicKey = !empty($paymentMethodDetails['public_key']) ? sanitize_text_field($paymentMethodDetails['public_key']) : '';
        $this->privateKey = !empty($paymentMethodDetails['private_key']) ? sanitize_text_field($paymentMethodDetails['private_key']) : '';
        // Process to PayPal order page
        $this->currencySymbol = StaticValidator::getValidSetting($paramSettings, 'conf_currency_symbol', "textval", "$");
        $this->currencyCode = StaticValidator::getValidSetting($paramSettings, 'conf_conf_currency_code', "textval", "USD");
        $this->companyName = StaticValidator::getValidSetting($paramSettings, 'conf_company_name', "textval", "");
        $this->confirmationPageId = StaticValidator::getValidSetting($paramSettings, 'conf_confirmation_page_id', 'positive_integer', 0);
        $this->cancelledPaymentPageId = StaticValidator::getValidSetting($paramSettings, 'conf_cancelled_payment_page_id', 'positive_integer', 0);
    }

    public function inDebug()
    {
        return ($this->debugMode >= 1 ? TRUE : FALSE);
    }

    /******************************************************************************************/
    /* Default methods                                                                        */
    /******************************************************************************************/

    /**
     * Based on https://stripe.com/docs/checkout#integration-custom
     * @param $paramCurrentDescription
     * @param $paramTotalPayNow = '0.00'
     * @return string
     */
    public function getDescriptionHTML($paramCurrentDescription, $paramTotalPayNow = '0.00')
    {
        $validAmountInCents = $paramTotalPayNow > 0 ? round(floatval($paramTotalPayNow), 2) * 100 : 0;
        $ret = '
            <script src="https://checkout.stripe.com/checkout.js"></script>
            <button id="customButton">'.$this->lang->getText('NRS_PAY_NOW_TEXT').'</button>
            <script>
            var handler = StripeCheckout.configure({
              key: \''.$this->publicKey.'\',
              image: \'https://stripe.com/img/documentation/checkout/marketplace.png\',
              locale: \'auto\',
              token: function(token) {
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
              }
            });
            
            document.getElementById(\'customButton\').addEventListener(\'click\', function(e) {
              // Open Checkout with further options:
              handler.open({
                name: \'Stripe.com\',
                description: \''.$this->conf->getExtensionName().' widgets\',
                zipCode: true,
                amount: \''.$validAmountInCents.'\'
              });
              e.preventDefault();
            });
            // Close Checkout on page navigation:
            window.addEventListener(\'popstate\', function() {
              handler.close();
            });
            </script>';

        return $ret;
    }

    public function setProcessingPage($paramBookingCode, $paramTotalPayNow = '0.00')
    {
        $this->bookingCode = sanitize_text_field($paramBookingCode);
        $this->totalPayNow = floatval($paramTotalPayNow);
        // Stripe does not uses form feature
    }

    public function getProcessingPageContent()
    {
        $errorMessage = '';
        $debugLog = '';

        require_once ('NRSStripeProcessor.php');
        $objStripeAPI = new \NRSStripeProcessor($this->conf, $this->lang, $this->settings);
        // Process API
        $succeeded = $objStripeAPI->process($this->privateKey, $this->bookingCode, $this->totalPayNow);
        // Stripe does not uses processing page content feature
        $ret = '';

        // TODO: GET REAL STRIPE CUSTOMER EMAIL AND TRANSACTION ID
        $paramPayerEmail = "stripe.customer@stripe.com";
        $transactionId = "DEMO_TRANSACTION_ID";
        $isFailed = $succeeded == FALSE;

        if($succeeded)
        {
            $objEMailsObserver = new \NativeRentalSystem\Models\EMail\EMailsObserver($this->conf, $this->lang, $this->settings);
            $objBookingsObserver = new \NativeRentalSystem\Models\Booking\BookingsObserver($this->conf, $this->lang, $this->settings);
            $objBooking = new \NativeRentalSystem\Models\Booking\Booking(
                $this->conf, $this->lang, $this->settings, $objBookingsObserver->getIdByCode($this->bookingCode)
            );
            $objInvoice = new \NativeRentalSystem\Models\Booking\Invoice($this->conf, $this->lang, $this->settings, $objBooking->getId());

            $printPayerEmail = esc_html(sanitize_text_field($paramPayerEmail));
            $printTransactionId = esc_html(sanitize_text_field($transactionId));

            $payPalHtmlToAppend = '<!-- PAYPAL PAYMENT DETAILS -->
<br /><br />
<table style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background-color:#eeeeee; width:840px; border:none;" cellpadding="4" cellspacing="1">
<tr>
<td align="left" width="30%" style="font-weight:bold; font-variant:small-caps; background-color:#ffffff; padding-left:5px;">'.$this->lang->getText('NRS_PAYER_EMAIL_TEXT').'</td>
<td align="left" style="background-color:#ffffff; padding-left:5px;">'.$printPayerEmail.'</td>
</tr>
<tr>
<td align="left" style="font-weight:bold; font-variant:small-caps; background-color:#ffffff; padding-left:5px;">'.$this->lang->getText('NRS_TRANSACTION_ID_TEXT').'</td>
<td align="left" style="background-color:#ffffff; padding-left:5px;">'.$printTransactionId.'</td>
</tr>
</table>';
            $appended = $objInvoice->append($payPalHtmlToAppend);
            $markedAsPaid = $objBooking->markPaid($transactionId, $paramPayerEmail);
            $emailProcessed = $objEMailsObserver->sendBookingConfirmationEmail($objBooking->getId(), TRUE);
            $errorMessage = '';
            $debugLog = '';
            if($markedAsPaid && $emailProcessed === FALSE)
            {
                $errorMessage .= 'Failed: Reservation was marked as paid, but system was unable to send the confirmation email!';
            } else if($markedAsPaid === FALSE)
            {
                $errorMessage .= 'Failed: Reservation was not marked as paid!';
            } else if($appended === FALSE)
            {
                $errorMessage .= 'Failed: Transaction data was not appended to invoice!';
            }
        }

        // Save log
        $objLog = new Log($this->conf, $this->lang, $this->settings, 0);
        $objLog->save('payment-callback', $paramPayerEmail, '', '', $isFailed, $errorMessage, $debugLog);

        return $ret;
    }

    public function processAPI()
    {
        // Stripe does not use API callback process
    }
    /******************************************************************************************/
}
 
