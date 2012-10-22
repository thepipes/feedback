<?php
/*
Template Description: single page template for solutions post type,
uses much of the same template parts as product features
*/
get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php //check if the post has a featured thumbnail and set the main content area's background to it ?>


  <?php get_template_part( 'heading' );           // heading section (heading.php) ?>

  <?php get_template_part( 'quote', 'top' );           // top quote (quote-top.php) ?>

  <?php roots_loop_before(); ?>

  <?php get_template_part( 'panel-template', 'product-features' );           // reusable product template (panel-template-product-features.php) ?>

  <?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>

  <?php get_template_part( 'related-panels' );           // reusable related panels (related-panels.php) ?>

  <?php get_template_part( 'related-item', 'resources' );           // reusable product feature highlights (related-item-resources.php) ?>

  <?php get_template_part( 'next', 'section' );           // reusable template for next section navigation. ?>

  <?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>

  <?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div><!-- /#content, closing of heading -->
<?php roots_content_after(); ?>
<?php get_footer(); ?>
