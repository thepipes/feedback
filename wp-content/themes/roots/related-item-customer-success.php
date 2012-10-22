<?php
/*
* TEMPLATE PART: related-item-customer-success
*/

$heading_1_image = get_image_urls(get_the_ID(), 'yam_heading_1_image');
$case_study_images = get_image_urls( get_the_ID(), 'yam_case_study_images', 'customer-logo-customer-success');
$case_study_1 = get_post_meta(get_the_ID(), 'yam_case_study_1', true);
$case_study_2 = get_post_meta(get_the_ID(), 'yam_case_study_2', true);
$related_ids = array($case_study_1, $case_study_2);
$count = 0;
$top_link_text = get_post_meta(get_the_ID(), 'yam_heading_1_link_text', true);
$top_link = get_post_meta(get_the_ID(), 'yam_heading_1_link', true);
$videoImages = get_image_urls(get_the_ID(), 'yam_customer_success_case_study_video_images');
$videoText = get_post_meta(get_the_ID(), 'yam_customer_success_case_study_video_text', true);
$videoURL = get_post_meta(get_the_ID(), 'yam_customer_success_case_study_video_url', true);
$videoTitle = get_post_meta(get_the_ID(), 'yam_customer_success_case_study_video_title', true);
?>

<div class="row panel-container">
  <div class="panel-wrapper grid12 raised">
    <div class="panel panel-related-case-studies-container panel-full">
        <div class="panel-overview">
          <div class="row">
            <div class="grid12 panel-headings">
              <h2><a href="<?php echo $top_link; ?>"><?php echo get_post_meta(get_the_ID(), 'yam_heading_1_text', true); ?></a></h2>
            </div>
          </div>
        </div>

      <div class="videos-container yj-clearfix">
      <?php
      /*
       * case study videos
       */
      while($count < count($videoImages)):
      ?>
      <div class="video-container">
        <a data-module="video" class="cta" href="<?php echo parse_video_link($videoURL[$count]); ?>" title="<?php echo $videoTitle[$count]; ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Videos', 'Watch Video', '<?php echo $videoTitle[$count]; ?>']);"><img src="<?php echo $videoImages[$count]; ?>" /></a>
        <p><?php echo $videoText[$count]; ?></p>
      </div>
      <?php
      $count++;
      endwhile;
      ?>
      </div>

      <hr>

      <?php
      /*
       * case study quotes
       * */
      $count = 0;
      while($count < count($related_ids)) :

      $client_id = get_post_meta( $related_ids[$count], 'yam_client_id_for_quote', true);
      $quote_id = get_post_meta( $related_ids[$count], 'yam_selected_quote_id', true);
      $quote_header = get_post_meta( $client_id, 'yam_quote_header', true);
      $quote_subheader = get_post_meta( $client_id, 'yam_quote_subheader', true);
      $quote_text = get_post_meta( $client_id, 'yam_quote_text', true);

      $link= get_permalink($related_ids[$count]);

      ?>
      <div class="panel-related-case-studies grid3 <?php if($count == 0): ?> first <?php endif; ?>">
        <?php if(isset($case_study_images[$count]) && $case_study_images[$count] != ''): ?>
        <div class="thumbnail">
          <img src="<?php echo $case_study_images[$count];?>" />
        </div>
        <?php endif; ?>
        <div class="quote-content">
          <blockquote class="quote-text"><img src="<?php echo get_template_directory_uri(); ?>/img/quotation.png" /><?php echo $quote_text[$quote_id]; ?></blockquote>
          <h5><?php echo $quote_header[$quote_id]; ?></h5>
          <p><?php echo $quote_subheader[$quote_id]; ?></p>
          <?php if(isset($quote_text[$quote_id]) && $quote_text[$quote_id] != ''): ?>
            <div class="related-case-studies-quote yj-clearfix">
              <?php if(isset($link) && $link != ''): ?>
                <a class="related-content-link" href="<?php echo $link; ?>"><?php echo get_call_to_action_text('read'); ?></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php $count++; endwhile; ?>
      <a class="cta case-studies-cta" href="<?php echo $top_link; ?>"><?php echo __('View More')." ".get_post_meta(get_the_ID(), 'yam_heading_1_text', true); ?><div class="arrow-right"></div></a>
    </div>
  </div>
</div>