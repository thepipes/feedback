<?php
/*
* TEMPLATE PART: product-feature-clients-logo-list
* DESCRIPTION: reusable section to list client logos. 5 clients per row.
*/
$args = array(
    'post_type'     => 'clients',
    'post_status'   => 'publish',
    'meta_key'=>'_thumbnail_id',
    'posts_per_page' => 30,
    'meta_query'    => array ( array ('key' => 'yam_featured_customer', 'value' => 'YES' )),
    'orderby'       => 'menu_order',
    'order'         => 'ASC'
);
query_posts($args);

?>


<div class="featured-logo-list-container">
 <ul>
    <?php while ( have_posts() ) : the_post();
    $image_id = get_post_thumbnail_id( $post->ID );
    $image = wp_get_attachment_image_src($image_id, 'customer-logo-featured-list');
    $case_study_url = get_post_meta($post->ID, 'yam_url_to_client_case_study');
   if (count($image) > 2) {
        //$image_width = $image[1];
        $image_height = $image[2] / 2;
       $img_style = 'margin-top:0px';
       if($image_height < 42) {$img_style = 'margin-top:'. (42 - $image_height) .'px';}
   }
    global $post;
    ?>
      <li id="customer_<?php echo $post->ID; ?>">
          <?php echo get_the_post_thumbnail($post->ID, 'customer-logo-featured-list', array('class' => 'featured-client-logo-img', 'style' => $img_style)); ?>
      </li>



    <?php endwhile;
    wp_reset_query();
    ?>
</ul>
 <div id="contentRight"></div>
</div>


<script type="text/javascript">
    var site_url = templateUrl + "/metaboxes/update-featured-client-order.php";
    jQuery(document).ready(function(){

        jQuery(function() {
            jQuery(".featured-logo-list-container ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                var order = jQuery(this).sortable("serialize") + '&action=updateCustomerLogosOrder';
                jQuery.post(site_url, order, function(theResponse){
                    jQuery("#contentRight").html(theResponse);
                });
            }
            });
        });

    });




</script>