<?php
/*
* TEMPLATE PART: panel-template-jobs
* DESCRIPTION: reusable panel section of job listings
*/
global $sidebar, $cat_names;
$slug = $post->post_name;
$count = 1;

$grid = (is_sidebar_active( 'events_sidebar' )) ? 'grid8' : 'grid12';
?>
<div class="row panel-container panel-last">

  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">

      <div class="row post-listing-content events">
        <div class="<?php echo $grid; ?>">
          <?php
          // Get categories to display on page.
          $cat_ids = get_post_meta( get_the_ID(), 'yam_category_ids');
          $cat_links = get_post_meta( get_the_ID(), 'yam_cat_link_page');
          asort($cat_ids);
          $sidebar = 'Events Sidebar';

          $cat_count = count($cat_ids[0]);
          ?>
          <?php foreach ($cat_ids[0] as $cat_id): ?>
          <?php $category = get_category($cat_id); ?>
          <?php
          $limit = ($slug != "events") ? 10 : 2;
          query_posts( array ( 'cat' => $cat_id, 'posts_per_page' => $limit, 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ) ) );
          $i = 0;
          if (have_posts()) : while (have_posts()) : the_post();

            $event_start_date = date_create(get_post_meta( get_the_ID(), 'yam_event_start_date', true));
            $event_end_date = get_post_meta( get_the_ID(), 'yam_event_end_date', true);
            if (!empty($event_end_date)):
              $event_end_date = date_create($event_end_date);
            endif;
            $registration_link = get_post_meta( get_the_ID(), 'yam_registration_link', true);
            $event_location = get_post_meta( get_the_ID(), 'yam_event_location', true);
          ?>
          <?php if ($i == 0) { ?>
              <h3><?php echo get_cat_name( $cat_id); ?></h3>
          <?php } ?>
          <article>

            <?php $imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
            <?php if (!empty($imageURL)): ?>
              <img src="<?php echo $imageURL[0]; ?>" class="post-thumbnail" />
              <div class="post-listing">
            <?php endif; ?>

            <h4><?php the_title(); ?></h4>

            <p class="post-date"><?php echo date_format($event_start_date, "F d, Y"); ?><?php echo ($event_end_date) ? ' - '.date_format($event_end_date, "F d, Y") : ''; ?></p>

            <?php if (!empty($registration_link)): ?>
            <p class="registration-link"><a href="<?php echo $registration_link; ?>" >Register</a></p>
            <?php endif; ?>

            <?php if (!empty($event_location)): ?>
            <p class="event-location"><?php echo nl2br($event_location); ?></p>
            <?php endif; ?>


            <?php the_content(); ?>

            <?php if (!empty($imageURL)): ?>
            </div>
            <?php endif; ?>
          </article>

              <?php

          $i++;
          $current_categories = get_the_category();
          endwhile; endif; ?>

          <?php

          if ($slug != "events"): ?>
            <div class="page-links">
              <?php
              global $wp_query;

              $big = 999999999; // need an unlikely integer

              echo paginate_links( array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'prev_text'    => __('&lt; Previous'),
                'next_text'    => __('Next &gt;'),
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages
              ) );
              ?>
            </div>

    <?php
          else:
          ?>
          <div class="view-all-link<?php echo ($i != 2) ? ' no-link' : ''; echo ($cat_count == $count) ? ' no-border' : '' ?>">
            <?php
            if ($i == 2):
              $view_all_link = get_permalink($cat_links[0][$count-1]);
              ?>
              <a href="<?php echo $view_all_link; ?>">View All</a>
              <?php
                $i = 0;
                endif;
            ?>
          </div>
              <?php
          endif;
          ?>

          <?php if (count($cat_ids) > $count): ?>
          <hr noshade size="1" />
          <?php endif; ?>

          <?php $count++; ?>
          <?php endforeach; ?>

          <?php wp_reset_query(); // Reset the query back to the original page so that we can get any other page specific meta data. ?>
        </div>

        <?php if (is_sidebar_active( 'events_sidebar' )): ?>
        <div class="grid4">
          <?php
          if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>
          no widgets
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>
