<?php

$args2 = array(
    'post_type'     => 'casestudies',
    'post_status'   => 'publish',
    'meta_key'=>'_thumbnail_id',
    'order'         => 'ASC',
    'posts_per_page' => -1,
    'post__in' => explode(",", get_post_meta(get_the_ID(), 'selected-case-studies-landing-footer', true))

);
$the_query = new WP_Query( $args2 );
$allposts = $the_query->get_posts();

//$wp_query = new WP_Query($args2);
//print_r(query_posts($args2));
global $marketo_form_mb;
$global_companies = $marketo_form_mb->get_the_value('page-global-companies-title');
$global_companies_link = $marketo_form_mb->get_the_value('page-global-companies-link');
if($global_companies =="")
  $global_companies = __("Global Leading Companies Use Yammer", "roots");
if($global_companies_link =="")
  $global_companies_link = __("View Case Studies", "roots");
?>

<div class="case-studies-logo-container">
    <div class="case-studies-logo-title"><?php echo $global_companies; ?> | <a href="/customers/case-studies/"><?php echo $global_companies_link; ?></a></div>

    <div class="case-studies-logo curved-bottom-shadow">
        <div>
<?php
          foreach ($allposts as $thepost){
            $clientID = get_post_meta($thepost->ID, 'yam_client_id');
            $image_id = get_post_thumbnail_id( $clientID );
            echo '<a alt="'. get_the_title($thepost->ID) .'" href="' . get_permalink($thepost->ID) . '">' . get_the_post_thumbnail($clientID[0], 'case-study-overview') . '</a>';
          }
          wp_reset_postdata();
?>
        </div>
    </div>
</div>