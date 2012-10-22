<?php
/*
* TEMPLATE PART: related-panels
* DESCRIPTION: reusable related panels code on bottom of page
*/
/*
$images = get_image_urls( get_the_ID(), 'yam_related_image');
$titles = get_post_meta( get_the_ID(), 'yam_related_content_title', true );
// Stripping NULL values from array to get valid count.
$titles = array_filter($titles, 'strlen');
$content = get_post_meta( get_the_ID(), 'yam_related_content', true );
$links = get_post_meta( get_the_ID(), 'yam_related_content_link', true );
$quotes = get_post_meta( get_the_ID(), 'yam_quote_id_related_pages', true );
$linkTitles = get_post_meta( get_the_ID(), 'yam_related_content_link_title', true );
$count = 0;

?>
<?php if (count($titles) >=1 ) : ?>
<div class="row section-title">
  <h3 class="grid12"><?php _e('Customer Success'); ?></h3>
</div>
<?php endif; ?>

<?php /* //while($count < count($titles)) : ?>
<?php // if($count % 2 == 0): ?>
<div class="row panel-container">
<?php // endif;  ?>
<div class="row panel-container">
  <div class="panel-wrapper panel-wrapper-related-content grid6">
    <div class="panel panel-related-content-container">
      <div class="row">
        <img class="grid2" src="<?php echo $images[0];?>" />
        <div class="panel-related-content grid4">
          <h5><?php echo $titles[0]; ?></h5>
          <p><?php echo $content[0]; ?></p>
          <?php // if(isset($quotes[$count]) && $quotes[$count] != ''): ?>
            <div class="related-content-quote yj-clearfix">
              <img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/related-quotation.png" />
              <blockquote class="quote-text"><?php echo $quote_text[0]; ?>"</blockquote>
            </div>
          <?php // endif; ?>
          <?php if(isset($links[$count]) && $links[$count] != ''): ?>
            <a class="related-content-link" href="<?php echo $links[$count]; ?>"><?php echo $linkTitles[$count]; ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /* //if($count%2 != 0 || count($titles) == $count+1): ?>
</div>
<?php //endif; ?>
<?php // $count++; endwhile; */
?>

<?php
    $client_id = get_post_meta( get_the_ID(), 'yam_client_id_for_quote_related_pages', true );
    $featured_case_study = get_post_meta( $client_id, 'yam_related_case_studies_ids', true);
    $quote_id = get_post_meta( get_the_ID(), 'yam_selected_quote_id_related_pages', true);
    $quote_header = get_post_meta( $client_id, 'yam_quote_header', true);
    $quote_subheader = get_post_meta( $client_id, 'yam_quote_subheader', true);
    $quote_text = get_post_meta( $client_id, 'yam_quote_text', true);
    $add_quotes = get_post_meta( $client_id, 'yam_add_quotes', true);
    $bottom_text = get_post_meta( $client_id, 'yam_bottom_text', true);
    $bottom_link = get_post_meta( $client_id, 'yam_bottom_link', true);
    $quote_image = get_image_urls( get_the_ID(), 'yam_quote_image_related_pages', true);

    if ($featured_case_study != -1):
      $client_link = get_permalink( $featured_case_study);
    else:
      $video_title = get_post_meta( $client_id, 'yam_client_video_title', true );
      $video_link = get_post_meta( $client_id, 'yam_client_video_link', true );
      if ($video_link != ''):
        $video_link = parse_video_link($video_link);
      endif;
    endif;
    //Second quote
    $client_id_2 = get_post_meta( get_the_ID(), 'yam_client_id_for_quote_related_pages_2', true );
    $featured_case_study_2 = get_post_meta( $client_id_2, 'yam_related_case_studies_ids', true);
    $quote_id_2 = get_post_meta( get_the_ID(), 'yam_selected_quote_id_related_pages_2', true);
    $quote_header_2 = get_post_meta( $client_id_2, 'yam_quote_header', true);
    $quote_subheader_2 = get_post_meta( $client_id_2, 'yam_quote_subheader', true);
    $quote_text_2 = get_post_meta( $client_id_2, 'yam_quote_text', true);
    $add_quotes_2 = get_post_meta( $client_id_2, 'yam_add_quotes', true);
    $bottom_text_2 = get_post_meta( $client_id_2, 'yam_bottom_text', true);
    $bottom_link_2 = get_post_meta( $client_id_2, 'yam_bottom_link', true);
    $quote_image_2 = get_image_urls(get_the_ID(), 'yam_quote_image_related_pages_2', true);

if ($featured_case_study_2 != -1):
  $client_link_2 = get_permalink( $featured_case_study_2);
else:
  $video_title_2 = get_post_meta( $client_id_2, 'yam_client_video_title', true );
  $video_link_2 = get_post_meta( $client_id_2, 'yam_client_video_link', true );
  if ($video_link_2 != ''):
    $video_link_2 = parse_video_link($video_link_2);
  endif;
endif;
?>
<!-- Start Related Panels -->
<?php if ($quote_id != -1 ) : ?>
<div class="row section-title">
    <h3 class="grid12"><?php _e('Customer Success'); ?></h3>
</div>
<?php endif; ?>
<?php if ($quote_id != -1) : ?>
<div class="row panel-container">
    <div class="panel-wrapper panel-wrapper-related-content grid6 raised">
      <div class="warp"></div>
      <?php
        $has_link = (isset($client_link) && $client_link != '');
        ?>
        <div class="panel panel-related-case-studies-container<?php echo ($has_link) ? ' panel-clickable' : "" ?>"<?php echo ($has_link) ? ' data-module="clickable" data-url="'.$client_link.'"' : "" ?>>
            <div class="row">
                <?php if (!empty($quote_image[0])): ?>
                <div class="grid2">
                <img src="<?php echo $quote_image[0];?>" class="related-image" />
                </div>
                <?php endif; ?>
                <div class="panel-related-case-studies push2 grid4">
                    <h5><?php echo $quote_header[$quote_id]; ?></h5>
                    <p><?php echo $quote_subheader[$quote_id]; ?></p>
                    <?php if(isset($quote_text[$quote_id]) && $quote_text[$quote_id] != ''): ?>
                    <div class="related-case-studies-quote yj-clearfix">
                        <blockquote class="quote-text"><img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/related-quotation.png" /><?php echo truncateString($quote_text[$quote_id]); ?>"</blockquote>
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
    <?php if ($client_id_2 == -1 || $quote_id_2 == -1) { // close panel for quote 1 if there is no quote 2. else print the second panel and close the first one at the end.?>
    <?php }
    else {

      ?>

    <div class="panel-wrapper panel-wrapper-related-content grid6 raised">
      <div class="warp"></div>
      <?php
      $has_link_2 = (isset($client_link_2) && $client_link_2 != '');
      ?>
        <div class="panel panel-related-case-studies-container<?php echo ($has_link_2) ? ' panel-clickable' : "" ?>"<?php echo ($has_link_2) ? ' data-module="clickable" data-url="'.$client_link_2.'"' : "" ?>>
            <div class="row">
                <?php if (!empty($quote_image_2[0])): ?>
                <div class="grid2">
                  <img src="<?php echo $quote_image_2[0];?>" class="related-image" />
                </div>
                <?php endif; ?>
                <div class="panel-related-case-studies push2 grid4">
                    <h5><?php echo $quote_header_2[$quote_id_2]; ?></h5>
                    <p><?php echo $quote_subheader_2[$quote_id_2]; ?></p>
                    <?php if(isset($quote_text_2[$quote_id_2]) && $quote_text_2[$quote_id_2] != ''): ?>
                    <div class="related-case-studies-quote yj-clearfix">
                        <blockquote class="quote-text"><img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/related-quotation.png" /><?php echo truncateString($quote_text_2[$quote_id_2]); ?>"</blockquote>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($bottom_link_2[$quote_id_2]) && $bottom_link_2[$quote_id_2] != ''): ?>
                    <a class="related-content-link" href="<?php echo $bottom_link_2[$quote_id_2]; ?>"><?php echo $bottom_text_2[$quote_id_2]; ?></a>
                    <?php endif; ?>
                  <div class="bottom-links">
                    <?php if(isset($client_link_2) && $client_link_2 != ''): ?>
                    <a class="cta related-content-link" href="<?php echo $client_link_2; ?>"><?php echo get_call_to_action_text('read'); ?></a>
                    <?php endif; ?>
                    <?php if(isset($video_link_2) && $video_link_2 != ''): ?>
                    <a data-module="video" class="cta related-content-link" title="<?php echo $video_title_2; ?>" href="<?php echo $video_link_2; ?>" target="_blank"><?php echo get_call_to_action_text('video'); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
            </div>
           
        </div>
    </div>

<?php } ?>
</div>
<?php endif; ?>
<!-- End Related Panels -->