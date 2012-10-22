<?php
/*
Template Name: Feature List Template
*/
?>
<?php get_header(); ?>
  <?php roots_content_before(); ?>
    <?php roots_main_before(); ?>

      <?php get_template_part( 'heading' );           // heading section (heading.php) ?>

      <?php roots_loop_before(); ?>

      <?php get_template_part('panel-template', 'feature-list');  //reusable template panel-template-featured-customers.php ?>

      <?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>

      <?php get_template_part( 'bottom-cta' );  // dynamic bottom cta section (bottom-cta.php) ?>

      <?php roots_loop_after(); ?>

    </div><!-- /#main, closing of heading -->

    <?php roots_main_after(); ?>
    </div><!-- /#content -->
  <?php roots_content_after(); ?>
<?php get_footer(); ?>
