<?php
/*
* TEMPLATE PART: overview-template
* DESCRIPTION: reusable panel sections of overview template using overview metabox
*/
    
//get the custom field values and prepare to iterate thru to create the panels
$clientID_CSO = get_post_meta( get_the_ID(), 'yam_client_id', true);
$videoTitle = get_post_meta( $clientID_CSO, 'yam_video_title', true);
$videoLink = get_post_meta( $clientID_CSO, 'yam_video_link', true);
$headings = get_post_meta( get_the_ID(), 'yam_overview_heading', true );
$images = wp_get_attachment_image_src( get_post_thumbnail_id( $clientID_CSO ), array('width' => '115') );
$industries = get_the_terms( $clientID_CSO, 'customer-industry');
$popout = get_post_meta( get_the_ID(), 'yam_overview_pop_out', true );
$links = get_post_meta( get_the_ID(), 'yam_overview_links', true );
$quoteArr = get_case_study_quote( get_the_ID());

$image_id = get_post_thumbnail_id( $clientID_CSO );
$image = wp_get_attachment_image_src($image_id, 'case-study-overview');
if (count($image) > 2) {
  //$image_width = $image[1];
  $image_height = $image[2] / 2;
  $img_style = 'margin-top:0px';
  if($image_height < 50) {$img_style = 'margin-top:'. (50 - $image_height) .'px';}
}
$logo = get_the_post_thumbnail( $clientID_CSO, 'case-study-overview', array('class' => 'customer-logo', 'style' => $img_style));
?>
<div class="row yj-clearfix panel-container <?php echo ($wp_query->post_count == ($wp_query->current_post +1))? 'panel-last': '';?>">
  <?php
  //check if first panel, add css class if so
  ?>
  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="warp"></div>
    <div class="panel panel-full panel-overview panel-clickable case-study-overview" data-module="clickable" data-url="<?php echo get_permalink(); ?>">

      <div class="row">
        <div class="grid9 panel-headings ">
          <div class="yj-clearfix">
            <h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
            <p class="casestudy-overview-industry">
              <?php
              $industryCount = 1;
              if (isset($industries) && $industries != '') {
                foreach ( $industries as $industry ) {
                  echo (count($industries) != $industryCount) ? $industry->name.", " : $industry->name;
                  $industryCount++;
                }
              }?>
            </p>
          </div>
          <p><?php echo "\"".$quoteArr['text']."\""; ?></p>
          <p class="attribution"> <?php echo "<b>".$quoteArr['header']."</b>, ".$quoteArr['subheader']; ?></p>
          <a class="cta" href="<?php echo get_permalink(); ?>"><?php echo get_call_to_action_text('read'); ?></a>
          <?php if(isset($videoLink) && $videoLink != ''): ?>
          <?php
          global $roots_options;
          $ga ='';
          if($roots_options['google_analytics_id'] != ''){
            $ga = '_gaq.push([\'_trackEvent\', \'Videos\', \'Watch Video\', \'' . $videoTitle . '\']);';
          }
          ?>
            <a data-module="video" class="cta" href="<?php echo parse_video_link($videoLink); ?>" title="<?php echo $videoTitle; ?>" target="_blank" onClick="<?php echo $ga; ?>"><?php echo get_call_to_action_text('video'); ?></a>
          <?php endif; ?>
        </div>
        <?php if ($images[0] != ''): ?>
        <div class="case-study-logo-container grid4">
          <div class="client-wrapper">
            <div class="client-container">
              <?php echo $logo; ?>
            </div>
          </div>
        </div>

        <?php endif; ?>
      </div>

    </div>
  </div>
</div>