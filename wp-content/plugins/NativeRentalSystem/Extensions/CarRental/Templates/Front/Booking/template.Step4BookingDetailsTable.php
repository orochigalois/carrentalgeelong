<?php
defined( 'ABSPATH' ) or die( 'No script kiddies, please!' );
// Scripts
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-validate');
wp_enqueue_script('car-rental-frontend');

// Styles
wp_enqueue_style('car-rental-frontend');
if($newBooking == TRUE && $objSettings->getSetting('conf_universal_analytics_enhanced_ecommerce') == 1):
    include('partial.Step4.EnhancedEcommerce.php');
endif;
?>
<div class="car-rental-wrapper car-rental-booking-details">
<h2 class="car-rental-page-title"><?php print($pageLabel); ?></h2>
<table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="#FFFFFF">
<tbody>
<?php include('partial.BookingSummary.php'); ?>
</tbody>
</table>

<?php if($newBooking && $boolEmailRequired): ?>
    <h2 class="search-label top-padded"><?php print($objLang->getText('NRS_EXISTING_CUSTOMER_DETAILS_TEXT')); ?></h2>
    <div class="<?php print($boolBirthdateRequired ? 'form-row-wide': 'form-row'); ?>">
        <div class="email-search">
            <input type="text" name="search_email_address" class="search-email-address" value="<?php print($objLang->getText('NRS_EMAIL_ADDRESS_TEXT')); ?>"
                   onfocus="if(this.value == '<?php print($objLang->getText('NRS_EMAIL_ADDRESS_TEXT')); ?>') {this.value=''}"
                   onblur="if(this.value == ''){this.value ='<?php print($objLang->getText('NRS_EMAIL_ADDRESS_TEXT')); ?>'}"
            />
        </div>
        <?php if($boolBirthdateRequired): ?>
            <div class="birth-search">
                <select name="search_birth_year" class="search-birth-year">
                    <?php print($birthYearSearchDropDownOptions); ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="customer-lookup-button">
            <button type="submit" name="customer_lookup" class="customer-lookup"><?php print($objLang->getText('NRS_FETCH_CUSTOMER_DETAILS_TEXT')); ?></button>
        </div>
    </div>
    <div class="ajax-loader">&nbsp;</div>
    <div class="clear">&nbsp;</div>
    <h2 class="search-label"><?php print($objLang->getText('NRS_OR_ENTER_NEW_DETAILS_TEXT')); ?></h2>
<?php else: ?>
    <h2 class="search-label top-padded"><?php print($objLang->getText('NRS_EXISTING_CUSTOMER_DETAILS_TEXT')); ?></h2>
<?php endif; ?>
<form name="customer_form" method="post" action="" class="car-rental-customer-form">
    <?php if($titleVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_TITLE_TEXT')); ?>:<span class="dynamic-text-item<?php print($titleRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <select name="title" class="title<?php print($titleRequired); ?>">
                <?php print($titleDropDownOptions); ?>
            </select>
        </div>
    </div>
    <?php endif; ?>
    <?php if($firstNameVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_FIRST_NAME_TEXT')); ?>:<span class="dynamic-text-item<?php print($firstNameRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="first_name" value="<?php print($firstName); ?>" class="first-name<?php print($firstNameRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($lastNameVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_LAST_NAME_TEXT')); ?>:<span class="dynamic-text-item<?php print($lastNameRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="last_name" value="<?php print($lastName); ?>" class="last-name<?php print($lastNameRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($birthdateVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_DATE_OF_BIRTH_TEXT')); ?>:<span class="dynamic-text-item<?php print($birthdateRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input customer-birthday-select">
            <select name="birth_year" class="birth-year<?php print($birthdateRequired); ?>"><?php print($birthYearDropDownOptions); ?></select>
            <select name="birth_month" class="birth-month<?php print($birthdateRequired); ?>"><?php print($birthMonthDropDownOptions); ?></select>
            <select name="birth_day" class="birth-day<?php print($birthdateRequired); ?>"><?php print($birthDayDropDownOptions); ?></select>
        </div>
    </div>
    <?php endif; ?>
    <?php if($streetAddressVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_ADDRESS_TEXT')); ?>:<span class="dynamic-text-item<?php print($streetAddressRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="street_address" value="<?php print($streetAddress); ?>" class="street-address<?php print($streetAddressRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($cityVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_CITY_TEXT')); ?>:<span class="dynamic-text-item<?php print($cityRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="city" value="<?php print($city); ?>" class="city<?php print($cityRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($stateVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_STATE_TEXT')); ?>:<span class="dynamic-text-item<?php print($stateRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="state" value="<?php print($state); ?>" class="state<?php print($stateRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($zipCodeVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
          <strong><?php print($objLang->getText('NRS_ZIP_CODE_TEXT')); ?>:<span class="dynamic-text-item<?php print($zipCodeRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="zip_code" value="<?php print($zipCode); ?>" class="zip-code<?php print($zipCodeRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($countryVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_COUNTRY_TEXT')); ?>:<span class="dynamic-text-item<?php print($countryRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="country" value="<?php print($country); ?>" class="country<?php print($countryRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($phoneVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_PHONE_TEXT')); ?>:<span class="dynamic-text-item<?php print($phoneRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="phone" value="<?php print($phone); ?>" class="phone<?php print($phoneRequired); ?>" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($emailVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_EMAIL_TEXT')); ?>:<span class="dynamic-text-item<?php print($emailRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input">
            <input type="text" name="email" value="<?php print($email); ?>" class="email<?php print($emailRequired); ?> email" />
        </div>
    </div>
    <?php endif; ?>
    <?php if($commentsVisible): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_ADDITIONAL_COMMENTS_TEXT')); ?>:<span class="dynamic-text-item<?php print($commentsRequired); ?>">*</span></strong>
        </div>
        <div class="customer-data-input customer-textarea">
            <textarea name="comments" class="comments<?php print($commentsRequired); ?>"><?php print($comments); ?></textarea>
        </div>
    </div>
    <?php endif; ?>
    <?php if($prepaymentsEnabled && sizeof($paymentMethods) > 0): ?>
    <div class="form-row">
        <div class="customer-data-label">
            <strong><?php print($objLang->getText('NRS_PAY_BY_SHORT_TEXT')); ?>:<span class="item-required">*</span></strong>
        </div>
        <div class="customer-data-input">
            <?php
            if($newBooking == FALSE):
                // only 1 payment method
                if($selectedPaymentMethodName != ""):
                    print('<div class="payment-method-name">'.$selectedPaymentMethodName.'</div>');
                    if($selectedPaymentMethodDescription != ""):
                        print('<div class="payment-method-description">'.$selectedPaymentMethodDescription.'</div>');
                    endif;
                endif;
            else:
                if(sizeof($paymentMethods) > 1):
                    foreach($paymentMethods AS $paymentMethod):
                        print('<div class="payment-method-name">');
                        print('<input type="radio" name="payment_method_id" value="'.$paymentMethod['payment_method_id'].'"'.$paymentMethod['print_checked'].' class="required" />');
                        print($paymentMethod['payment_method_name']);
                        print('</div>');
                        if($paymentMethod['payment_method_description_html'] != ""):
                            print('<div class="padded-payment-method-description">'.$paymentMethod['payment_method_description_html'].'</div>');
                        endif;
                    endforeach;
                elseif(sizeof($paymentMethods) == 1):
                    // only 1 payment method
                    foreach($paymentMethods AS $paymentMethod):
                        print('<div class="payment-method-name">');
                        print('<input type="hidden" name="payment_method_code" value="'.$paymentMethod['payment_method_code'].'" />');
                        print($paymentMethod['payment_method_name']);
                        print('</div>');
                        if($paymentMethod['payment_method_description_html'] != ""):
                            print('<div class="payment-method-description">'.$paymentMethod['payment_method_description_html'].'</div>');
                        endif;
                    endforeach;
                endif;
            endif;
            ?>
            <label class="error" generated="true" for="payment_method_code" style="display:none;"><?php print($objLang->getText('NRS_FIELD_REQUIRED_TEXT')); ?>.</label>
        </div>
    </div>
    <?php endif; ?>

    <?php if($newBooking && $showReCaptcha): ?>
        <div class="form-row">
            <div class="customer-data-label">&nbsp;</div>
            <div class="customer-data-input">
                <div class="g-recaptcha" data-sitekey="<?php print($reCaptchaSiteKey); ?>"></div>
                <script type="text/javascript"
                    src="https://www.google.com/recaptcha/api.js?hl=<?php print($reCaptchaLanguage) ?>">
                </script>
            </div>
        </div>
    <?php endif; ?>

    <?php if($objSettings->getSetting('conf_terms_and_conditions_page_id') != "" && $objSettings->getSetting('conf_terms_and_conditions_page_id') != 0): ?>
        <div class="form-row">
            <div class="customer-data-label">&nbsp;</div>
            <div class="customer-data-input">
                <?php
                if($newBooking == FALSE):
                    print('<input type="checkbox" name="terms_and_conditions" value="" checked="checked" style="width:15px !important" class="terms-and-conditions required" />');
                    print('&nbsp; <a href="'.get_permalink($objSettings->getSetting('conf_terms_and_conditions_page_id')).'" target="_blank">'.$objLang->getText('NRS_I_AGREE_WITH_TERMS_AND_CONDITIONS_TEXT').'</a>');
                else:

                    print('<input type="checkbox" name="terms_and_conditions" value="" class="terms-and-conditions required" />');
                    print('&nbsp; <a href="'.get_permalink($objSettings->getSetting('conf_terms_and_conditions_page_id')).'" target="_blank">'.$objLang->getText('NRS_I_AGREE_WITH_TERMS_AND_CONDITIONS_TEXT').'</a>');
                endif;
                ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="customer-buttons">
        <?php
        if($newBooking):
            if($objSettings->getSetting('conf_universal_analytics_events_tracking') == 1):
                // Note: Do not translate events to track well inter-language events
                $onClick = "ga('send', 'event', 'Car Rental', 'Click', '4. Confirm reservation');";
                print('<button type="submit" name="car_rental_do_search4" class="register-button" onClick="'.esc_js($onClick).'">'.$objLang->getText('NRS_CONFIRM_TEXT').'</button>');
            else:
                print('<button type="submit" name="car_rental_do_search4" class="register-button">'.$objLang->getText('NRS_CONFIRM_TEXT').'</button>');
            endif;
        else:
            print('<input type="submit" name="car_rental_cancel_booking" value="'.$objLang->getText('NRS_CANCEL_BOOKING_TEXT').'" />');
            print('<input type="submit" name="car_rental_do_search0" value="'.$objLang->getText('NRS_CHANGE_BOOKING_DATE_TIME_AND_LOCATION_TEXT').'" />');
            print('<input type="submit" name="car_rental_do_search" value="'.$objLang->getText('NRS_CHANGE_BOOKED_ITEMS_TEXT').'" />');
            print('<input type="submit" name="car_rental_do_search2" value="'.$objLang->getText('NRS_CHANGE_RENTAL_OPTIONS_TEXT').'" />');
            print('<button name="car_rental_do_search4" class="register-button" type="submit">'.$objLang->getText('NRS_UPDATE_BOOKING_TEXT').'</button>');
        endif;
        ?>
    </div>
</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery.extend(jQuery.validator.messages, {
        required: "<?php print($objLang->getText('NRS_REQUIRED_TEXT')); ?>"
    });
    jQuery('.car-rental-customer-form').validate();
    jQuery('.car-rental-booking-details .customer-lookup').click(function()
    {
        var objCustomerEmailAddress = jQuery('.car-rental-booking-details .search-email-address');
        var objCustomerYearOfBirth = jQuery('.car-rental-booking-details .search-birth-year');
        var customerEmailAddress = "SKIP";
        var customerYearOfBirth = "SKIP";

        <?php if($boolEmailRequired): ?>
            if(objCustomerEmailAddress.length)
            {
                customerEmailAddress = objCustomerEmailAddress.val();
            }
        <?php endif; ?>

        <?php if($boolBirthdateRequired): ?>
            if(objCustomerEmailAddress.length)
            {
                customerYearOfBirth = objCustomerYearOfBirth.val();
            }
        <?php endif; ?>

        //console.log(customerEmailAddress);
        jQuery('.car-rental-booking-details .ajax-loader').html("<img src='<?php print($objConf->getExtensionFrontImagesURL('AjaxLoader.gif')); ?>' border='0'>");
        carRentalCustomerDetailsLookup(
            '<?php print($extensionFolder); ?>',
            '<?php print($ajaxSecurityNonce); ?>',
            '<?php print($siteURL); ?>',
            customerEmailAddress,
            customerYearOfBirth
        );
    });
});
</script>