<?php
/*
Template Name: Pricing Page Template
Template Description: pricing page template
*/
?>
<?php get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>
<?php get_template_part( 'heading' );           // heading section (heading.php) ?>
    <?php roots_loop_before(); ?>
    <?php get_template_part('loop', 'pricing'); ?>
    <?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>
    <?php roots_loop_after(); ?>
  </div><!-- /#main, closing of heading -->
  <?php roots_main_after(); ?>
</div><!-- /#content, closing of heading -->
<?php roots_content_after(); ?>
<?php get_footer(); ?>
