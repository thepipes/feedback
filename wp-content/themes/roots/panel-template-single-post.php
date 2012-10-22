<?php
/*
* TEMPLATE PART: panel-template-single-post
* DESCRIPTION: reusable panel section for listing posts from a specific category
*/

?>
<div class="row panel-container">

  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">

      <div class="row post-listing-content">
        <div class="grid8">
          <?php
          $post_cats = get_the_category();
          $cat_name = $post_cats[0]->cat_name;
          $sidebar = $cat_name.' Sidebar';
          if (have_posts()) : while (have_posts()) : the_post();

          $category_to_check = get_term_by( 'name', 'Yammer Events', 'category' );

          if ( post_is_in_descendant_category($category_to_check->term_id)):
            get_template_part( 'panel-template', 'single-event' );
          else:
          ?>


          <article>
            <h3><?php the_title(); ?></h3>
            <p class="post-date"><?php the_time("F d, Y"); ?></p>
            <?php the_content(); ?>
          </article>
          <?php endif; endwhile; endif; ?>
        </div>

        <div class="grid4">
          <?php
          if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>

          <?php endif; ?>
        </div>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>