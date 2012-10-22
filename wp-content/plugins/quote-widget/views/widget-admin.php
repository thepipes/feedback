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

<p><label for="<?php echo $this->get_field_id('quote_header'); ?>"><?php _e('Quote Header:', $this->pluginDomain); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('quote_header'); ?>" name="<?php echo $this->get_field_name('quote_header'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['quote_header'])); ?>" /></p>

<p><label for="<?php echo $this->get_field_id('quote_subheader'); ?>"><?php _e('Quote Sub-Header:', $this->pluginDomain); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('quote_subheader'); ?>" name="<?php echo $this->get_field_name('quote_subheader'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['quote_subheader'])); ?>" /></p>

<p><label for="<?php echo $this->get_field_id('quote_text'); ?>"><?php _e('Quote Text:', $this->pluginDomain); ?></label>
  <textarea rows="8" class="widefat" id="<?php echo $this->get_field_id('quote_text'); ?>" name="<?php echo $this->get_field_name('quote_text'); ?>"><?php echo format_to_edit($instance['quote_text']); ?></textarea></p>

<p><label for="<?php echo $this->get_field_id('add_quotes'); ?>"><?php _e('Display Quotes:', $this->pluginDomain); ?></label>
  <select id="<?php echo $this->get_field_id('add_quotes'); ?>" name="<?php echo $this->get_field_name('add_quotes'); ?>">
    <option value="YES"<?php echo (esc_attr(strip_tags($instance['add_quotes'])) == "YES") ? " selected" : ""; ?>>Yes</option>
    <option value="NO"<?php echo (esc_attr(strip_tags($instance['add_quotes'])) == "NO") ? " selected" : ""; ?>>No</option>
  </select></p>

<p><label for="<?php echo $this->get_field_id('bottom_link'); ?>"><?php _e('Bottom Link:', $this->pluginDomain); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('bottom_link'); ?>" name="<?php echo $this->get_field_name('bottom_link'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['bottom_link'])); ?>" /></p>

<p><label for="<?php echo $this->get_field_id('bottom_link_text'); ?>"><?php _e('Bottom Link Text:', $this->pluginDomain); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('bottom_link_text'); ?>" name="<?php echo $this->get_field_name('bottom_link_text'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['bottom_link_text'])); ?>" /></p>
