<?php
 /*
  * TEMPLATE PART: heading
  * DESCRIPTION: heading section for each page
  */
?>
<?php
$grid = get_post_meta( get_the_ID(), 'yam_heading_grid', true );
if (empty($grid)):
  $grid = "grid6";
endif;
$imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$subheading = get_post_meta( get_the_ID(), 'yam_subheading', true );
$isJobs = is_page('Jobs');
$videoLink = '';
if (get_post_type() == 'casestudies'):
  $client_id = get_post_meta( get_the_ID(), 'yam_client_id', true);
  $videoTitle = get_post_meta( $client_id, 'yam_client_video_title', true);
  $videoLink = get_post_meta( $client_id, 'yam_client_video_link', true);
  $videoThumbnail = get_image_urls( $client_id, 'yam_client_video_thumbnail', 'video-link-thumbnail');
else:
  $videoTitle = get_post_meta( get_the_ID(), 'yam_video_title', true);
  $videoLink = get_post_meta( get_the_ID(), 'yam_video_link', true);
  $videoThumbnail = get_image_urls( get_the_ID(), 'yam_video_thumbnail', 'video-link-thumbnail');
endif;
$h1 = get_post_meta( get_the_ID(), 'yam_heading', true );
$color = get_post_meta( get_the_ID(), 'yam_headingcolor', true );
$isLanding = is_page_template('page-landing.php');
$isLandingMenu = is_page_template('page-landing-menu.php');
($isLanding || $isLandingMenu) ? $subheadingColor = get_post_meta( get_the_ID(), 'yam_subheadingcolor', true) : '';
$style = '';
$substyle = '';
($color != '' || $color != '#') ? $style = " style='color:".$color.";'" : '';
($subheadingColor != '' && $subheadingColor != '#' ) ? $substyle = " style='color:".$subheadingColor.";'" : $substyle = " style='color:".$color.";'";
$videoCaption = get_post_meta( get_the_ID(), 'yam_video_caption', true );
$headingBullets = get_post_meta( get_the_ID(), 'yam_customer_success_heading_bullet_text', true );
$headingBulletImages = get_image_urls( get_the_ID(), 'yam_customer_success_heading_bullet_images' );
$count = 0;
$bullets = array();
foreach ($headingBulletImages as $image)
{
  $bullets[$count]['text'] = $headingBullets[$count];
  $bullets[$count]['image'] = $image;
  $count++;
}
$hasHeadingBullets = (isset($headingBullets) && isset($headingBullets[0]) && $headingBullets[0] != '') ? true : false;
$template_file = get_post_meta(get_the_ID(),'_wp_page_template',TRUE);
$extraLargeTemplates = array(
  'page-customer-overview.php',
  'page-landing.php'
);
if ( in_array($template_file, $extraLargeTemplates) ):
  $cssClass = 'extra-large';
elseif ((get_post_type() == 'casestudies' || is_page("case-studies") || (isset($post_slug) && $post_slug == "case-studies")) && empty($videoLink)):
  $cssClass = 'no-height';
  $grid = 'grid12';
elseif (has_post_thumbnail( $post->ID ) && (!(get_post_type() == 'post' && is_single())) || (!(empty($videoLink)))):
  $cssClass = 'large';
elseif ($subheading != ''):
  $cssClass = 'medium';
else:
  $cssClass = 'small';
endif;
?>

<?php if (has_post_thumbnail( $post->ID ) && (!(get_post_type() == 'post' && is_single()))) : ?>
    <div id="content" class="splash-image" style="background-image: url('<?php echo $imageURL[0]; ?>');">

<?php else : ?>
  <div id="content" class="no-image<?php if (is_page_template('page-terms.php')) {echo ' terms';}?>">
<?php endif ?>

<?php
global $roots_options;
$ga ='';
if($roots_options['google_analytics_id'] != ''){
    $ga = '_gaq.push([\'_trackEvent\', \'Videos\', \'Watch Video\', \'' . $videoTitle . '\']);';
}
?>

<?php
  
  $m = new Mustache;
  $template = <<<TPL
  <div class="row">
    <div class="{{grid}}">
      <div class="heading-wrapper {{cssClass}}{{#landing}} landing{{/landing}}">
        {{#h1}}<h1{{style}}>{{&h1}}</h1>{{/h1}}
        {{#subheading}}<p{{substyle}}>{{&subheading}}</p>{{/subheading}}
        {{#hasHeadingBullets}}<ul>{{#headingBullets}}<li><img src="{{image}}"/><p>{{{text}}}</p></li>{{/headingBullets}}</ul>{{/hasHeadingBullets}}
        {{#isJobs}}
          <a class="cta yj-btn" href="http://www.microsoft-careers.com/go/yammer/357062/#search-wrapper">View Jobs</a>
        {{/isJobs}}
        {{^isJobs}}
          {{#videoLink}}{{^videoThumbnail}}<a data-module="video" class="cta yj-btn {{landingBtn}}" href="{{videoLink}}"{{#videoTitle}} title="{{videoTitle}}"{{/videoTitle}} target="_blank" onClick="{{ga}}">{{#landing}}<span class="arrow-right"></span>{{/landing}}Watch Video</a>{{/videoThumbnail}}{{/videoLink}}
        {{/isJobs}}
      </div>
    </div>
    {{#videoLink}}{{#videoThumbnail}}<div class="push1 grid5">
      <div class="heading-video">
        <a data-module="video" class="cta" href="{{videoLink}}"{{#videoTitle}} title="{{videoTitle}}"{{/videoTitle}} target="_blank" onClick="{{ga}}"><img src="{{videoThumbnail}}" alt="{{videoTitle}}" /></a>
        {{#videoCaption}}<p class="caption">{{{videoCaption}}}</p>{{/videoCaption}}
      </div>
    </div>{{/videoThumbnail}}{{/videoLink}}
  </div>
TPL;
?>
<div id="main" role="main" class="main container">
  <?php if (!empty($h1) || !empty($subheader)) {
    echo $m->render($template, array(
      'grid' => $grid,
      'video' => !empty($videoLink),
      'h1' => $h1,
      'style' => $style,
      'subheading' => $subheading,
      'substyle' => $substyle,
      'videoLink' => empty($videoLink) ? '' : parse_video_link($videoLink),
      'videoTitle' => $videoTitle,
      'videoThumbnail' => empty($videoThumbnail) ? '' : $videoThumbnail[0],
      'landing' => ($isLanding) ? 'landing' : '',
      'landingBtn' => ($isLanding) ? 'yj-btn-alt landing-btn' : '',
      'cssClass' => $cssClass,
      'ga' => $ga,
      'isJobs' => $isJobs,
      'hasHeadingBullets' => $hasHeadingBullets,
      'videoCaption' => $videoCaption,
      'headingBullets' => $bullets
    ));
  } ?>
