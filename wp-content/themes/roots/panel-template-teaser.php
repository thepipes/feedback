<?php
/*
* TEMPLATE PART: panel-template-teaser
* DESCRIPTION: reusable panel section of a teaser (uses overview metabox)
*/
$headings = get_post_meta( get_the_ID(), 'yam_overview_teaser_heading', true );
$images = get_image_urls( get_the_ID(), 'yam_overview_teaser_images');
$captions = get_post_meta( get_the_ID(), 'yam_overview_teaser_caption', false );
$display_lightbox = get_post_meta( get_the_ID(), 'yam_display_lightbox', true);
$lightbox_button_text = get_post_meta( get_the_ID(), 'yam_lightbox_button_text', true);
$lightbox_title = get_post_meta( get_the_ID(), 'yam_lightbox_title', true);
?>

<?php if (isset($headings) && $headings != '') : ?>
<div class="row yj-clearfix panel-container">
  <?php
  //check if first panel, add css class if so
  ?>
  <div class="panel-wrapper panel-wrapper-full grid12 raised panel1">
    <div class="panel panel-full">

      <div class="row">
        <div class="grid12 teaser-headings">
          <h2><?php echo $headings;  ?></h2>
          <p><?php echo  $captions[0]; ?></p>
        </div>
        <div class="grid12 centered">
          <img src="<?php echo ($images[0]); ?>" class="teaser-image" />
          <?php if ($display_lightbox == 'YES'): ?>
            <a class="dynamic-lightbox-button" data-reveal-id="dynamic-lightbox" title="<?php echo $lightbox_title; ?>"><?php echo $lightbox_button_text; ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>
<?php
endif; ?>