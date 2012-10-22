<?php
/*
* TEMPLATE PART: product-feature-highlights
* DESCRIPTION: reusable section of product template using productfeatures metabox listing out features
*/
$related_heading = get_post_meta( get_the_ID(), 'yam_featured_client_image_heading');
$related_heading_image = get_image_urls( get_the_ID(), 'yam_featured_client_heading_image');
$related_heading_link = get_post_meta( get_the_ID(), 'yam_featured_client_heading_link');
$infographic= get_image_urls( get_the_ID(), 'yam_featured_clients_infographic');
/*




$m = new Mustache;
$images = get_image_urls( get_the_ID(), 'yam_featured_clients_images');
$count = 0;

// Templates
$item_template = <<<TPL
  <li class="{{^count}} first{{/count}}">
    <div>
      {{#image}}<img class="icon" src="{{image}}" />{{/image}}
    </div>
  </li>
TPL;

*/
?>
<?php
//LOOP FOR FEATURES
?>
<?php //if (count($images) >=1 ) : ?>
<div class="row panel-container panel-last">
  <div class="panel-wrapper grid12 raised">
    <div class="panel panel-related-case-studies-container panel-full">
      <?php // if (count($related_heading) >=1 ) : ?>
        <div class="panel-overview">
          <div class="row">
            <div class="grid12 panel-headings">
              <h2><?php echo $related_heading[0]; ?></h2>
            <?php  /* <a class="cta" href="<?php echo $related_heading_link[0]; ?>"><?php echo _e('View More'); ?><div class="arrow-right"></div></a> */ ?>
            </div>
          </div>
        </div>
      <?php// endif; ?>
      <div class="featured-clients">
        <ul class="grid11">
          <?php /* while ($count < (count($images))) :
            echo $m->render($item_template, array(
              'count' => $count,
              'image' => $images[$count]
            ));
            $count++;
            endwhile;
         */ ?>
            <?php get_template_part( 'panel-template', 'featured-clients-logo-list' );  // display the featured client logos from this template ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php // endif; ?>