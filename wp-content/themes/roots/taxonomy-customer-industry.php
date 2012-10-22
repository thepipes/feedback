<?php
/*
Template: Case Studies Taxonomy Overview Template
Template Description: single page template for case study overview page
*/
get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php //check if the post has a featured thumbnail and set the main content area's background to it ?>


<?php
$current_term =	$wp_query->queried_object;
$post_slug = 'case-studies';
$args=array(
  'name' => $post_slug,
  'post_type' => 'page',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'caller_get_posts'=> 1
);
$my_query = null;
$my_query = new WP_Query($args);
$count = 0;
if( $my_query->have_posts() ) {
  while ($my_query->have_posts() && $count==0) : $my_query->the_post(); ?>
  <?php include_once( 'heading.php' );           // heading section (heading.php) ?>
  <?php
  $count++;
  endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
wp_reset_postdata();
?>

<?php roots_loop_before(); ?>

<?php
$taxonomy     = 'customer-industry';
$orderby      = 'name';
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';

$args = array(

  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical
);


$args = array( 'post_type' => 'casestudies', 'posts_per_page' => -1 );
$wp_query = new WP_Query( $args );
$myCounter = 0;
$term_array = array();
//$term_id = array();
while ( $wp_query->have_posts() ) : $wp_query->the_post();
$clientID = get_post_meta($post->ID, 'yam_client_id');
$term_id = get_the_terms($clientID[0], $taxonomy);
if (isset($term_id) && $term_id != '') {
  foreach ($term_id as $term){
    array_push($term_array,$term->term_id);
  }
}
$myCounter++;
endwhile;
wp_reset_query();
wp_reset_postdata();

$tax_args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'order'        => 'ASC',
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title,
  'hide_empty'   => true,
  'include'      => implode(',', $term_array)
);

$industry_dropdown = get_categories( $tax_args );
$current_industry = get_terms($taxonomy);

//$current_industry = $current_industry['industry'];
foreach ( $current_industry as $term ) {
  $industry_menu[] = $term->slug;
  $current_industry_title = $term->name;
}
$selected_industry = array();
for ($i=0; $i <count($industry_dropdown); $i++){
  if($industry_dropdown[$i]->slug == $industry_menu[0]){
    $selected_industry = $industry_dropdown[$i]->name;
  }
}

?>
<div class="yj-clearfix industry-filter-wrapper row">
  <div class="panel-wrapper panel-wrapper-full grid12 raised panel-last industry-filter-container">
<nav id="nav-main-industry-filter" role="navigation" class="primary casestudy nav-main-industry-filter">
    <ul id="menu-primary-navigation" class="menu">
      <li> <a href="#" class="industry-dropdown-title"><?php echo _e('Select Industry'); ?><span class="arrow-down"></span></a>
            <ul class="sub-menu">
              <li> <a href="<?php echo home_url()."/customers/case-studies/"; ?>"><?php _e('All Industries'); ?></a>
                <?php
                //print_r($industry_dropdown);
                foreach ($industry_dropdown as $industry ){
                    $selected_industry_class = ($current_term->name == $industry->name)? 'class="current-industry"' : '';
                    echo '<li '. $selected_industry_class .'><a href="'.get_term_link($industry->slug, $taxonomy).'">' .$industry->name . '</a></li>';
                }
                ?>
            </ul>
        </li>
    </ul>
  <div class="industry-filter-title"><?php echo $current_term->name;?></div>

</nav>
</div>
</div>
<?php
$args = array (
  'post_type' => 'clients',
  'orderby'   => 'customer-industry',
  'meta_key'  => $taxonomy
);
$query = new WP_Query(
  $args
);

while (have_posts() ) : the_post();
if(get_post_type( get_the_ID() ) == 'clients'):
        $args = array( 'post_type' => 'casestudies', 'posts_per_page' => -1, 'meta_query' => array ( array ('key' => 'yam_client_id', 'value' => $post->ID )) );
        $wp_query2 = new WP_Query( $args );
        $clients_array = array();
        while ( $wp_query2->have_posts() ) : $wp_query2->the_post(); ?>
        <?php include( 'panel-template-casestudy-overview.php' );          // reusable panel template (panel-template-overview.php) ?>
        <?php
        endwhile;
        wp_reset_query();
        wp_reset_postdata();
endif;
endwhile;
wp_reset_query();
?>

<?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>
<?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div>
<?php roots_content_after(); ?>
<?php get_footer(); ?>