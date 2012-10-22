<?php
/*
Template Name: Marketo Lead Landing
Description: Landing page with marketo form.
*/
get_header();
?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php get_template_part( 'heading' );           // heading section (heading.php) ?>

<?php roots_loop_before(); ?>

<?php get_template_part( 'panel-template', 'landing-menu' );           // reusable product template (panel-template-product-features.php) ?>

<?php get_template_part( 'case-studies-landing' );  ?>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div>
<?php roots_content_after(); ?>
<?php get_template_part( 'landing-menu-tracking-scripts' );
?>
<?php get_footer(); ?>