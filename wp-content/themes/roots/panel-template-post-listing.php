<?php
/*
* TEMPLATE PART: panel-template-jobs
* DESCRIPTION: reusable panel section of job listings
*/

$cat_ids = get_post_meta( get_the_ID(), 'yam_category_ids');
if (is_array($cat_ids[0])) {
  $cat_ids = implode(',',$cat_ids[0]);
} else {
  $cat_ids = implode(',',$cat_ids);
}
$cat_name = get_cat_name($cat_ids);

$grid = (is_sidebar_active(strtolower(str_replace(' ','_',$cat_name )).'_sidebar')) ? 'grid8' : 'grid12';
?>
<div class="row panel-container panel-last">

  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">

      <div class="row post-listing-content">
        <div class="<?php echo $grid; ?>">
          <?php
          $events_page = get_post_meta( get_the_ID(), 'yam_events_page', true);
          if ($events_page == "YES"):
            $sidebar = "Events Sidebar";
          else:
            $sidebar = $cat_name.' Sidebar';
          endif;
          query_posts( array ( 'cat' => $cat_ids, 'posts_per_page' => 10, 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ) ) );
          if (have_posts()) : while (have_posts()) : the_post();
          ?>

          <article class="yj-clearfix">
            <?php if (has_post_thumbnail($post->ID)): ?>
            <div class="thumbnail_container">
            <?php the_post_thumbnail('post-listing-thumbnail'); ?>
            </div>
            <?php endif; ?>
            <?php
            global $roots_options;
            $ga ='';
             if($roots_options['google_analytics_id'] != ''){
             $ga = "onClick=\"_gaq.push(['_trackEvent', 'Outbound', 'Customer Blog', '". get_the_title() ."']);\"";
             }
            ?>
            <div class="post-listing">
              <h4><a href="<?php the_permalink(); ?>"<?php echo (strpos(get_permalink(), get_option('siteurl')) === false) ? ' target="_blank" ' . $ga : ''; ?>><?php the_title(); ?></a></h4>
              <p class="post-date"><?php the_time("F d, Y"); ?></p>
              <?php the_excerpt(); ?>
            </div>
          </article>

          <?php endwhile; endif; ?>
            <div class="page-links">
            <?php
            global $wp_query;

            $big = 999999999; // need an unlikely integer

            $next_arrow= '<img src="'. get_template_directory_uri() . '/img/arrow_right.png" alt="'. __('Next ') .'" />';
            $previous_arrow= '<img src="'. get_template_directory_uri() . '/img/arrow_left.png" alt="'. __('Previous ') .'" />';
            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
              'format' => '?paged=%#%',
              'prev_text'    => $previous_arrow . __(' Previous'),
              'next_text'    => __('Next ') . $next_arrow,
              'current' => max( 1, get_query_var('paged') ),
              'total' => $wp_query->max_num_pages
            ) );
            ?>
            </div>
          <?php wp_reset_query(); // Reset the query back to the original page so that we can get any other page specific meta data. ?>
        </div>

        <?php if (is_sidebar_active(strtolower(str_replace(' ','_',$cat_name )).'_sidebar')): ?>
        <div class="grid4">
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)): ?>
            <?php if (!dynamic_sidebar('Sidebar')): ?>

            <?php endif; ?>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>