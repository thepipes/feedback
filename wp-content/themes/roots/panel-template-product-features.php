<?php
/*
* TEMPLATE PART: product-template
* DESCRIPTION: reusable panel sections of product template using productfeatures metabox
*/

//get the custom field values and prepare to iterate thru to create the panels
$headings = get_post_meta( get_the_ID(), 'yam_feature_heading', true );
// Stripping NULL values from array to get valid count.
$headings = array_filter($headings, 'strlen');
$images = get_image_urls( get_the_ID(), 'yam_images');
$videos = get_post_meta( get_the_ID(), 'yam_videos', true);
$captions = get_post_meta( get_the_ID(), 'yam_caption', true );
$headingsCount = count($headings) - 1;
$count = 0;
$popout = get_post_meta( get_the_ID(), 'yam_pop_out', false );
?>
<?php
//LOOP FOR PANELS
while ($count <= $headingsCount) :
    ?>
<div class="row panel-container reduced-margin <?php echo ($count == $headingsCount)? 'panel-last' : '';?>">
        <?php
        //check if odd or even and use this to style the panels (text left or right)
        $even = ($count % 2 == 0);
        //check if first panel, add css class if so
        ?>
        <div class="panel-wrapper panel-wrapper-full grid12 raised <?php echo $headingsCount==1 ?  "panel1" :  ""; ?>">
            <div class="panel panel-full product-features">

                <?php if ($even) :?>

                <div class="grid4 panel-headings">
                  <div class="panel-headings-inner">
                    <h2><?php echo $headings[$count];  ?></h2>
                    <p><?php echo  $captions[$count]; ?></p>
                  </div>
                </div>
                <?php
                if(empty($videos[$count])):
                ?>
                    <img <?php echo ($count==0 && $popout[0] == "YES") ? "style='right:-30px;'" : ""; ?> src="<?php echo ($images[$count]); ?>" class="panel-image" />
                    <img src="<?php echo get_template_directory_uri();?>/img/fade-right-100px.png" class="<?php echo ($count==0 && $popout[0] == "YES") ? "popout" : ""; ?> fade-right">
                <?php
                else:
                $videoLink = parse_video_link($videos[$count]);
                ?>
                    <a href="<?php echo $videoLink; ?>" data-module="inline-video" data-attr="video-right"><img class="play-overlay-right" src="<?php echo get_template_directory_uri();?>/img/play-button.png"><img <?php echo ($count==0 && $popout[0] == "YES") ? "style='right:-30px;'" : ""; ?> src="<?php echo ($images[$count]); ?>" class="panel-image" /><img src="<?php echo get_template_directory_uri();?>/img/fade-right-100px.png" class="<?php echo ($count==0 && $popout[0] == "YES") ? "popout" : ""; ?> fade-right"></a>
                <?php
                endif;
                ?>
                <?php else : ?>

                <?php
                if(empty($videos[$count])):
                ?>
                    <img style="left:0px;" src="<?php echo ($images[$count]); ?>" class="panel-image" />
                    <img src="<?php echo get_template_directory_uri();?>/img/fade-left-100px.png" class="fade-left">
                <?php
                else:
                $videoLink = parse_video_link($videos[$count]);
                ?>
                    <a href="<?php echo $videoLink; ?>" data-module="inline-video" data-attr="video-left"><img class="play-overlay-left" src="<?php echo get_template_directory_uri();?>/img/play-button.png"><img style="left:0px;" src="<?php echo ($images[$count]); ?>" class="panel-image" /><img src="<?php echo get_template_directory_uri();?>/img/fade-left-100px.png" class="fade-left"></a>
                <?php
                endif;
                ?>

                <div class="grid4 push8 panel-headings panel-headings-right">
                  <div class="panel-headings-inner">
                    <h2><?php echo $headings[$count];  ?></h2>
                    <p><?php echo  $captions[$count]; ?></p>
                  </div>
                </div>


                <?php endif; ?>


                <div class="warp"></div>
            </div>
        </div>
</div>
<?php
    $count++;
endwhile; ?>