<?php
/*
* TEMPLATE PART: related-item-case-studies
* DESCRIPTION: reusable related case studies code
*/
function stripBlank($var)
{
  return !in_array($var, array('-1'));
}

$related_ids = get_post_meta( get_the_ID(), 'yam_related_case_studies_ids' , true);
// Stripping NULL values from array to get valid count.
$related_ids = array_filter($related_ids, 'strlen');
$related_ids = array_filter($related_ids, "stripBlank");

$logos = get_image_urls( get_the_ID(), 'yam_related_case_study_image', true);
$count = 0;
?>
<?php if (count($related_ids) >=1 && $related_ids[0] != -1) : ?>
<div class="row section-title">
  <h3 class="grid12"><?php _e('Related Case Studies'); ?></h3>
</div>


<?php while($count < count($related_ids) && $related_ids[$count] != -1) : ?>
<?php

  $client_id = get_post_meta( $related_ids[$count], 'yam_client_id_for_quote', true );
  $quote_id = get_post_meta( $related_ids[$count], 'yam_selected_quote_id', true);
  $quote_header = get_post_meta( $client_id, 'yam_quote_header', true);
  $quote_subheader = get_post_meta( $client_id, 'yam_quote_subheader', true);
  $quote_text = get_post_meta( $client_id, 'yam_quote_text', true);
  $add_quotes = get_post_meta( $client_id, 'yam_add_quotes', true);
  $bottom_text = get_post_meta( $client_id, 'yam_bottom_text', true);
  $bottom_link = get_post_meta( $client_id, 'yam_bottom_link', true);


    if ($related_ids[$count] != -1):
      $client_link = get_permalink( $related_ids[$count]);
    else:
      $video_title = get_post_meta( $client_id, 'yam_client_video_title', true );
      $video_link = get_post_meta( $client_id, 'yam_client_video_link', true );
      if ($video_link != ''):
        $video_link = parse_video_link($video_link);
      endif;
    endif;

?>
<?php if($count % 2 == 0): ?>
<div class="row panel-container">
<?php endif; ?>
    <div class="warp"></div>
  <div class="panel-wrapper panel-wrapper-related-content grid6 raised">
    <?php
    $has_link = (isset($client_link) && $client_link != '');
    ?>
    <div class="panel panel-related-case-studies-container<?php echo ($has_link) ? ' panel-clickable' : "" ?>"<?php echo ($has_link) ? ' data-module="clickable" data-url="'.$client_link.'"' : "" ?>>
      <div class="row">
          <?php if (!empty($logos[$count])): ?>
            <img src="<?php echo $logos[$count];?>" class="related-image" />
          <?php endif; ?>
        <div class="panel-related-case-studies grid4">
          <h5><?php echo $quote_header[$quote_id]; ?></h5>
          <p><?php echo $quote_subheader[$quote_id]; ?></p>
          <?php if(isset($quote_text[$quote_id]) && $quote_text[$quote_id] != ''): ?>
            <div class="related-case-studies-quote yj-clearfix">
              <blockquote class="quote-text"><img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/related-quotation.png" /><?php echo $quote_text[$quote_id]; ?>"</blockquote>
            </div>
          <?php endif; ?>
          <?php if(isset($bottom_link[$quote_id]) && $bottom_link[$quote_id] != ''): ?>
          <a class="related-content-link" href="<?php echo $bottom_link[$quote_id]; ?>"><?php echo $bottom_text[$quote_id]; ?></a>
          <?php endif; ?>
          <div class="bottom-links">
            <?php if(isset($client_link) && $client_link != ''): ?>
            <a class="cta related-content-link" href="<?php echo $client_link; ?>"><?php echo get_call_to_action_text('read'); ?></a>
            <?php endif; ?>
            <?php if(isset($video_link) && $video_link != ''): ?>
            <a data-module="video" class="cta related-content-link" title="<?php echo $video_title; ?>" href="<?php echo $video_link; ?>" target="_blank"><?php echo get_call_to_action_text('video'); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php
    if($count%2 != 0 || count($related_ids)-1 == $count): ?>
</div>
<?php endif; ?>
<?php $count++; endwhile; ?>
<?php endif; ?>