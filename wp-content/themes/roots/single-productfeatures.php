<?php
/*
Template Description: single page template for product features post type
*/
get_header(); ?>
  <?php roots_content_before(); ?>
    <?php roots_main_before(); ?>

    <?php //check if the post has a featured thumbnail and set the main content area's background to it ?>

        <?php get_template_part( 'heading' );           // heading section (heading.php) ?>

            <?php roots_loop_before(); ?>

            <?php get_template_part( 'panel-template', 'product-features' );           // reusable product template (panel-template-product-features.php) ?>

            <?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>

            <?php get_template_part( 'related-item', 'feature-highlights' );           // reusable product feature highlights (related-item-feature-highlights.php) ?>

            <?php get_template_part( 'next', 'section' );           // reusable template for next section navigation. ?>

            <?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>

            <?php roots_loop_after(); ?>

        </div><!-- /#main, closing of heading -->
        <?php roots_main_after(); ?>

    </div>
  <?php roots_content_after(); ?>
<?php get_footer(); ?>