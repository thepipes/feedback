jQuery(document).ready(function() {

    if (jQuery('#yam_client_id_for_quote_related_pages').val() != -1){
        jQuery.getJSON(templateUrl+scriptUrl,{id: jQuery('#yam_client_id_for_quote_related_pages').val(), ajax: 'true'}, function(j){
            var options = buildSelect(j,'Select Quote','yam_selected_quote_id_related_pages');
            jQuery('#yam_quote_id_related_pages').html(options);
        });
    }

    jQuery('#yam_client_id_for_quote_related_pages').change(function(){
        if (jQuery(this).val() != -1) {
            jQuery.getJSON(templateUrl+scriptUrl,{id: jQuery(this).val(), ajax: 'true'}, function(j){
                var options = buildSelect(j,'Select Quote', 'yam_selected_quote_id_related_pages');
                jQuery('#yam_quote_id_related_pages').html(options);
                jQuery('#yam_quote_id_related_pages option[value=-1]').attr('selected', 'selected');
            })
        }
    });

    jQuery('#yam_quote_id_related_pages').change(function(){
        jQuery('#yam_selected_quote_id_related_pages').val(jQuery('#yam_quote_id_related_pages').val());
    });



    //temporary
    if (jQuery('#yam_client_id_for_quote_related_pages_2').val() != -1){
        jQuery.getJSON(templateUrl+scriptUrl,{id: jQuery('#yam_client_id_for_quote_related_pages_2').val(), ajax: 'true'}, function(j){
            var options = buildSelect(j,'Select Quote', 'yam_selected_quote_id_related_pages_2');
            jQuery('#yam_quote_id_related_pages_2').html(options);
        });
    }

    //temporary
    jQuery('#yam_client_id_for_quote_related_pages_2').change(function(){
        if (jQuery(this).val() != -1) {
            jQuery.getJSON(templateUrl+scriptUrl,{id: jQuery(this).val(), ajax: 'true'}, function(j){
                var options = buildSelect(j,'Select Quote', 'yam_selected_quote_id_related_pages_2');
                jQuery('#yam_quote_id_related_pages_2').html(options);
                jQuery('#yam_quote_id_related_pages_2 option[value=-1]').attr('selected', 'selected');
            })
        }
    });

    //temporary
    jQuery('#yam_quote_id_related_pages_2').change(function(){
        jQuery('#yam_selected_quote_id_related_pages_2').val(jQuery('#yam_quote_id_related_pages_2').val());
    });



  function buildSelect(options, title, jQueryObjId) {
    var options_html = '';
    options_html += '<option value="-1">'+title+'</option>';

    for (var i = 0; i < options.length; i++) {
      options_html += '<option value="' + options[i].optionValue + '"'+ ((jQuery('#'+jQueryObjId).val() == options[i].optionValue ) ? ' selected' : '') +'>' + options[i].optionDisplay + '</option>';
    }

    return options_html;
  }
});