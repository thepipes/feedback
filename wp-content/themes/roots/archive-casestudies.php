<?php
/*
Template Name: Case Studies Overview Template
Template Description: single page template for case study overview page
*/
get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php //check if the post has a featured thumbnail and set the main content area's background to it ?>

<?php get_template_part( 'heading' );           // heading section (heading.php) ?>

<?php roots_loop_before(); ?>

<?php
$taxonomy     = 'customer-industry';
$orderby      = 'name';
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';

$args = array( 'post_type' => 'casestudies', 'posts_per_page' => -1 );
$wp_query = new WP_Query($args);
/*
$myCounter = 0;
foreach( $case_studies as $case ) :	setup_postdata($case);
	  $selected_client = get_post_meta( $case->ID, 'yam_client_id', true);
      $term_id = get_the_terms($selected_client, $taxonomy);
      //$clients_industry_ids_array[$myCounter] = $term_id;
		print_r($term_id);
	$myCounter++;
endforeach;
wp_reset_postdata();
print_r($clients_industry_ids_array);
*/

$myCounter = 0;
$clients_industry_ids_array = array();
while ( $wp_query->have_posts() ) : $wp_query->the_post();
  $clientID = get_post_meta($post->ID, 'yam_client_id');

  if ($clientID[0] != -1){
      $term_id = get_the_terms($clientID[0], $taxonomy);

      $clients_industry_ids_array[] = $term_id[0]->term_id;
  }
  $myCounter++;
endwhile;
wp_reset_query();
//wp_reset_postdata();

?>
<div class="yj-clearfix industry-filter-wrapper row">
  <div class="panel-wrapper panel-wrapper-full grid12 raised panel-last industry-filter-container">
    <nav id="nav-main-industry-filter" role="navigation" class="primary casestudy nav-main-industry-filter">
    <ul id="menu-primary-navigation" class="menu">
        <li> <a href="#" class="industry-dropdown-title"><?php _e('Select Industry'); ?><span class="arrow-down"></span></a>
            <ul class="sub-menu">
              <li class="current-industry"> <a href="<?php echo home_url()."/customers/case-studies/"; ?>"><?php _e('All Industries'); ?></a>
                <?php
                $tax_args = array(
                    'taxonomy'     => $taxonomy,
                    'orderby'      => $orderby,
                    'order'        => 'ASC',
                    'show_count'   => $show_count,
                    'pad_counts'   => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li'     => $title,
                    'hide_empty'   => true,
                    'include'      => implode(',', $clients_industry_ids_array)
                );

                wp_list_categories( $tax_args ); ?>
            </ul>
        </li>
    </ul>
</nav>
</div>
</div>
<?php
$args = array( 'post_type' => 'casestudies', 'posts_per_page' => -1 );
$wp_query = new WP_Query( $args );
$myCounter = 0;
while ( $wp_query->have_posts() ) : $wp_query->the_post();
  include( 'panel-template-casestudy-overview.php' );           // reusable panel template (panel-template-overview.php)
  $myCounter++;
endwhile;
wp_reset_query();
// Reset Post Data
wp_reset_postdata();

?>
<?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>
<?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div>
<?php roots_content_after(); ?>
<?php get_footer(); ?>
