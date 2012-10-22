<?php
 /*
  * TEMPLATE PART: case-study-heading
  * DESCRIPTION: heading section for case study pages
  */
?>
<?php $imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<?php if (has_post_thumbnail( $post->ID )) : ?>

  <div id="content" style="margin-top: -29px; padding-top: 29px; background: url('<?php echo $imageURL[0]; ?>') transparent top center no-repeat;">

<?php else : ?>
  <div id="content">
<?php endif ?>

<?php
  $color = get_post_meta( get_the_ID(), 'yam_headingcolor', true );
  $style = '';
  if ($color != '' || $color != '#')
    $style = " style='color:".$color."';";
?>


<div id="main" role="main" class="main">
  <div class="row">
      <div class="grid12">

          <div class="row case-study-heading">

              <div class="grid6">
                  <div class="heading-wrapper">
                      <h2<?php echo $style; ?>><?php echo get_post_meta( get_the_ID(), 'yam_heading', true ); ?></h2>
                  </div>
              </div>
              <div class="grid4">
                  <?php // Get video link and generate embed code for display
                  $video = get_post_meta( get_the_ID(), 'yam_video_link', true );
                  if (count($video) >= 1):
                  ?>
                      <?php $video_embed = wp_oembed_get( $video, array('width'=>300));   ?>
                      <?php echo $video_embed; ?>
                  <?php endif; ?>

              </div>
              <div class="grid2">
                  <div class="row">
                      <?php // Get the logo and display it if available
                      $logos = get_image_urls( get_the_ID(), 'yam_logo');
                      if (count($logos) >= 1):
                      ?>
                        <img src="<?php echo $logos[0]; ?>" class="case-study-logo" />
                      <?php endif; ?>
                  </div>
                  <div class="row">
                      <?php // Get the award and display it if available
                      $awards = get_image_urls( get_the_ID(), 'yam_award');
                      if (count($awards) >= 1):
                          ?>
                          <img src="<?php echo $awards[0]; ?>" class="case-study-award" />
                          <?php endif; ?>
                  </div>
              </div>

          </div>
      </div>
  </div>