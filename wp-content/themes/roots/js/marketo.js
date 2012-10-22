function fieldValidate(field) {
    /* call Mkto.setError(field, message) and return false to mark a field value invalid */
    /* return 'skip' to bypass the built-in validations */
    return true;
}
function getRequiredFieldMessage(domElement, label) {
    return "This field is required";
}
function getTelephoneInvalidMessage(domElement, label) {
    return "Please enter a valid telephone number";
}
function getEmailInvalidMessage(domElement, label) {
    return "Please enter a valid email address";
}
function mktoGetForm() {
    return document.getElementById('mktForm_1040');
}
function formSubmit(elt) {
    return Mkto.formSubmit(elt);
}
function formReset(elt) {
    return Mkto.formReset(elt);
}
var mktVisitorToken = 'VISITOR_MKTTOK_REPLACE';
mktoMunchkin('635-GLP-906', {customName: 'ForresterWave2012LandingPage', wsInfo: 'j1RR'});

var submit_button_str = jQuery('#submit-button-str').val();
var missing_fields1_str = jQuery('#missing-fields1-str').val();
var missing_fields_str = jQuery('#missing-fields-str').val();

jQuery('#mktFrmSubmit').click(function(){
    if(jQuery("#mktForm_1040").valid()) {
        jQuery('#mktFrmSubmit').disable;
        jQuery('#mktFrmSubmit').addClass("yj-btn-disabled");
        jQuery('#mktFrmSubmit').text(submit_button_str);
        jQuery("#mktForm_1040").submit();
    }
    else {
        return false;
    }
});
jQuery("#mktForm_1040 input").blur(function (){
    var numberOfRequiredFields = jQuery(".required").length;
    var count = 0;
    jQuery(".required").each(function( i, val ) {
        if(jQuery(this).val() !=''){
            count++;
        }
    });
    if(count == numberOfRequiredFields) {
        jQuery("#mktFrmSubmit").removeClass("yj-btn-disabled");
    }
});
jQuery(document).ready(function(){
if(jQuery("#mktForm_1040").length){
    jQuery("#mktForm_1040").validate({
        messages: {
            required:""
        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? missing_fields1_str
                    : missing_fields_str.replace('%n', errors);
                jQuery("div.error span").html(message);
                jQuery("div.error").show();
            } else {
                jQuery("div.error").hide();
            }
        }
    });
    jQuery.validator.messages.required = '';
    jQuery.validator.messages.email = '';
    jQuery(document).keypress(function(e) {
        if(e.which == 13) {
            if(jQuery("#mktForm_1040").valid()) {
                jQuery('#mktFrmSubmit').disable;
                jQuery('#mktFrmSubmit').addClass("yj-btn-disabled");
                jQuery('#mktFrmSubmit').text(submit_button_str);
                jQuery("#mktForm_1040").submit();
            }
            else {
                return false;
            }
        }
    });
}   if(getURLParameter('ym') == 'mkt'){        
        if(jQuery('#form-report-pdf').exists() == true) {
            var file = jQuery('#form-report-pdf').attr("href");
            window.location = '/wp-content/themes/roots/metaboxes/submit-marketo.php?file='+file;
        }
    }

});
jQuery.fn.exists = function () {
    return this.length !== 0;
}
function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}