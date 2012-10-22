<?php
/*
* TEMPLATE PART: overview-template
* DESCRIPTION: reusable panel sections of overview template using overview metabox
*/

//get the custom field values and prepare to iterate thru to create the panels
$headings = get_post_meta( get_the_ID(), 'yam_overview_heading', true );
// Stripping NULL values from array to get valid count.
$headings = array_filter($headings, 'strlen');
$images = get_image_urls( get_the_ID(), 'yam_overview_images');
$captions = get_post_meta( get_the_ID(), 'yam_overview_captions', true );
$headingsCount = count($headings) - 1;
$count = 0;
$popout = get_post_meta( get_the_ID(), 'yam_overview_pop_out', true );
$links = get_post_meta( get_the_ID(), 'yam_overview_links', true );

?>
<?php
//LOOP FOR PANELS
while ($count <= $headingsCount) :

?>
<div class="row yj-clearfix panel-container reduced-margin <?php  echo ($count == $headingsCount)? 'panel-last' : ''; ?>">
  <?php
 /* //check if first panel, add css class if so */
  ?>
  <div class="warp"></div>
  <div class="panel-wrapper panel-wrapper-full grid12 raised ">
    <div class="panel panel-full panel-overview<?php echo (isset($links[$count]) && $links[$count] != '') ? ' panel-clickable' : ''; ?>" <?php echo (isset($links[$count]) && $links[$count] != '') ? 'data-module="clickable" data-url="'.$links[$count].'"' : ''; ?>>

      <div class="row">
        <div class="push2 grid9 panel-headings overview">
          <h4><?php echo (isset($links[$count])  && $links[$count] != '') ? "<a href='".$links[$count]."'>".$headings[$count]."</a>" : $headings[$count];  ?></h4>
          <p><?php echo  $captions[$count]; ?></p>
          <?php if (isset($links[$count]) && $links[$count] != ''): ?>
          <a class="cta" href="<?php echo $links[$count]; ?>"><?php echo get_call_to_action_text('learn'); ?></a>
          <?php endif; ?>
        </div>
        <img <?php echo ($popout == "YES") ? "class='popout-top'" : "class='shadow-bottom'"; ?> src="<?php echo ($images[$count]); ?>" />
      </div>


    </div>
  </div>
</div>
<?php

  $count++;
endwhile; ?>