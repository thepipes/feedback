<?php
/*
* TEMPLATE PART: product-feature-clients-logo-list
* DESCRIPTION: reusable section to list client logos. 5 clients per row.
*/
$args = array(
    'post_type'     => 'clients',
    'post_status'   => 'publish',
    'meta_key'=>'_thumbnail_id',
    'posts_per_page' => 15,
    'meta_query'    => array ( array ('key' => 'yam_featured_customer', 'value' => 'YES' )),
    'orderby'       => 'menu_order',
    'order'         => 'ASC'
);
query_posts($args);

?>
<div class="featured-list-container">
    <?php while ( have_posts() ) : the_post();
    $image_id = get_post_thumbnail_id( $post->ID );
    $image = wp_get_attachment_image_src($image_id, 'customer-logo-featured-list');
    $case_study_url = get_post_meta($post->ID, 'yam_related_case_studies_ids');
  
   if (count($image) > 2) {
        //$image_width = $image[1];
        $image_height = $image[2] / 2;
       $img_style = 'margin-top:0px';
       if($image_height < 42) {$img_style = 'margin-top:'. (42 - $image_height) .'px';}
   }
    ?>
  <div class="client-wrapper-container">
  <div class="client-wrapper">
    <div class="client-container<?php echo ($case_study_url[0] > 0 )?   '-clickable" data-module="clickable" data-url="' . get_permalink($case_study_url[0]) . '"' : '"'; ?>>

      <?php echo get_the_post_thumbnail($post->ID, 'customer-logo-featured-list', array('class' => 'featured-client-logo-img', 'style' => $img_style)); ?>
    </div>
      <?php echo ($case_study_url[0] > 0 )? '<div class="triangle"></div>' : ''; ?>
  </div>
 </div>
    <?php endwhile;
    wp_reset_query();
    ?>
</div>