jQuery(document).ready(function() {

  if (jQuery('#yam_client_id_for_quote').val() != -1){
    jQuery.getJSON(templateUrl+scriptUrl,{id: jQuery('#yam_client_id_for_quote').val(), ajax: 'true'}, function(j){
      var options = buildSelect(j,'Select Quote');
      jQuery('#yam_quote_id').html(options);
    });
  }

  jQuery('#yam_client_id_for_quote').change(function(){
    if (jQuery(this).val() != -1) {
      jQuery.getJSON(templateUrl+scriptUrl,{id: jQuery(this).val(), ajax: 'true'}, function(j){
        var options = buildSelect(j,'Select Quote');
        jQuery('#yam_quote_id').html(options);
        jQuery('#yam_quote_id option[value=-1]').attr('selected', 'selected');
      })
    }
  });

  jQuery('#yam_quote_id').change(function(){
    jQuery('#yam_selected_quote_id').val(jQuery('#yam_quote_id').val());
  });

  function buildSelect(options, title) {
    var options_html = '';
    options_html += '<option value="-1">'+title+'</option>';

    for (var i = 0; i < options.length; i++) {
      options_html += '<option value="' + options[i].optionValue + '"'+ ((jQuery('#yam_selected_quote_id').val() == options[i].optionValue ) ? ' selected' : '') +'>' + options[i].optionDisplay + '</option>';
    }

    return options_html;
  }
});

var maxAllowed = 8;
var site_url = templateUrl + "/metaboxes/update-selected-case-studies-landing.php";
var currentValues = [];
jQuery("#move-case-study-to-right").click(function(){

    var items = [];
    var values = [];
    var currentItems = jQuery("#yam-selected-case-studies-landing option").length;

    jQuery('#current-case-studies :selected').each(function(i, selected){
        items[i] = jQuery(selected).text();
        values[i]= jQuery(selected).val();
    });

    if(items.length > maxAllowed || items.length > (maxAllowed - currentItems)){
        alert('Sorry, there is a maximum of ' + maxAllowed + ' case studies you can display at the same time. Please remove some case studies until you have ' + maxAllowed + ' or less.');
    }
    else {
        for (i = 0; i < items.length; i++) {
            jQuery("#yam-selected-case-studies-landing").append("<option value='" + values[i]+ "'>" + items[i] + "</option>");
        }

        jQuery("#yam-selected-case-studies-landing option").each(function(i, selected){
            currentValues[i]= jQuery(selected).val();
        });
        var selected_items = 'selection=' + currentValues + '&id=' + postID;
        jQuery.post(site_url, selected_items, function(theResponse){
            jQuery("#contentRight").html(theResponse);
        });
    }

});


jQuery("#move-case-study-to-left").click(function(){

    jQuery('#yam-selected-case-studies-landing :selected').remove();
    jQuery("#yam-selected-case-studies-landing option").each(function(i, selected){
        currentValues[i]= jQuery(selected).val();
    });
    var selected_items = 'selection=' + currentValues + '&id=' + postID;
    jQuery.post(site_url, selected_items, function(theResponse){
        jQuery("#contentRight").html(theResponse);
    });
});
