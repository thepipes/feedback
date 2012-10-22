<?php
/*
* TEMPLATE PART: dynamic-gravity-form
* DESCRIPTION: reusable section to display selected gravity form.
*/
$gf_id = get_post_meta( get_the_ID(), 'yam_gf_id');
$display_lightbox = get_post_meta( get_the_ID(), 'yam_display_lightbox', true);
$lightbox_button_text = get_post_meta( get_the_ID(), 'yam_lightbox_button_text', true);
$lightbox_title = get_post_meta( get_the_ID(), 'yam_lightbox_title', true);
$lightbox_content = get_post_meta( get_the_ID(), 'yam_lightbox_content', true);
if ($gf_id[0] != -1):
  $gf = RGFormsModel::get_form($gf_id[0]);
  ?>
  <div id="dynamic-gf" class="reveal-modal" title="<?php echo $gf->title?>">
    <?php echo do_shortcode('[gravityform id="'.$gf->id.'" name="'.$gf->title.'"]');?>
    <a class="close-reveal-modal">&#215;</a>
  </div>
<?php elseif ($display_lightbox == 'YES'): ?>
  <div id="dynamic-lightbox" class="reveal-modal">
    <?php echo $lightbox_content; ?>
    <a class="close-reveal-modal">&#215;</a>
  </div>
<?php endif; ?>