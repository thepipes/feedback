<?php
/**
 * Widget admin template
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
?>
<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Quote Image:', $this->pluginDomain); ?></label>
  <?php
  $media_upload_iframe_src = "media-upload.php?type=image&widget_id=".$this->id; //NOTE #1: the widget id is added here to allow uploader to only return array if this is used with image widget so that all other uploads are not harmed.
  $image_upload_iframe_src = apply_filters('image_upload_iframe_src', "$media_upload_iframe_src");
  $image_title = __(($instance['image'] ? 'Change Image' : 'Add Image'), $this->pluginDomain);
  ?><br />
  <a href="<?php echo $image_upload_iframe_src; ?>&TB_iframe=true" id="add_image-<?php echo $this->get_field_id('image'); ?>" class="thickbox-quote-widget" title='<?php echo $image_title; ?>' onClick="set_active_widget('<?php echo $this->id; ?>');return false;" style="text-decoration:none"><img src='images/media-button-image.gif' alt='<?php echo $image_title; ?>' align="absmiddle" /> <?php echo $image_title; ?></a>
<div id="display-<?php echo $this->get_field_id('image'); ?>"><?php
  if ($instance['imageurl']) {
    echo "<img src=\"{$instance['imageurl']}\" alt=\"{$instance['quote_header']}\" />";
  }
  ?></div>
<br clear="all" />
<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="hidden" value="<?php echo $instance['image']; ?>" />
</p>
<?php
$args = array( 'post_type' => 'clients' );
$clients = get_posts( $args );
?>
<script>

  jQuery(document).ready(function() {
    jQuery('#<?php echo $this->get_field_id('client_id'); ?>').change(function(){
      if (jQuery(this).val() != -1) {
        jQuery.getJSON("/../../../../wp-content/themes/roots/js/load-client-quotes.php",{id: jQuery(this).val(), ajax: 'true'}, function(j){
          var options = buildSelect(j);
          jQuery('#<?php echo $this->get_field_id('quote_id'); ?>').html(options);
        })
      }
    });
    function buildSelect(options) {
      var options_html = '';
      options_html += '<option value="-1">Select Client</option>';

      for (var i = 0; i < options.length; i++) {
        options_html += '<option value="' + options[i].optionValue + '"'+ ((jQuery('#yam_selected_quote_id').val() == options[i].optionValue ) ? ' selected' : '') +'>' + options[i].optionDisplay + '</option>';
      }

      return options_html;
    }
  });
</script>
<p><label for="<?php echo $this->get_field_id('client_id'); ?>"><?php _e('Select Customer:', $this->pluginDomain); ?></label>
  <select id="<?php echo $this->get_field_id('client_id'); ?>" name="<?php echo $this->get_field_name('client_id'); ?>" class="widefat">
    <option value="-1">Client List</option>
    <?php foreach ($clients as $client): ?>
    <option value="<?php echo $client->ID; ?>"<?php  echo (esc_attr(strip_tags($instance['client_id'])) == $client->ID) ? ' selected' : ''; ?>><?php echo $client->post_title; ?></option>
    <?php endforeach; ?>
  </select>

<p id="<?php echo $this->get_field_id('quote_id_container'); ?>"><label for="<?php echo $this->get_field_id('quote_id'); ?>"><?php _e('Select Quote:', $this->pluginDomain); ?></label>
  <select id="<?php echo $this->get_field_id('quote_id'); ?>" name="<?php echo $this->get_field_name('quote_id'); ?>" class="widefat">
    <?php if (!empty($instance['client_id'])): ?>
    <?php $quote_text = get_post_meta( $instance['client_id'], 'yam_quote_text', true); ?>
    <option value="-1">Quote List</option>
    <?php foreach ($quote_text as $key => $quote): ?>
    <option value="<?php echo $key; ?>"<?php  echo (esc_attr(strip_tags($instance['quote_id'])) == $key) ? ' selected' : ''; ?>><?php echo $quote; ?></option>
    <?php endforeach; ?>
    <?php endif; ?>
  </select>