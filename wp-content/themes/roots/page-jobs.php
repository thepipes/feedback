<?php
/*
Template Name: Jobs Template
Template Description: single page template for jobs pages
*/
$jvi = $_GET['jvi'];
get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php //check if the post has a featured thumbnail and set the main content area's background to it ?>

<?php get_template_part( 'heading' );           // heading section (heading.php) ?>

<?php roots_loop_before(); ?>
<?php if (empty($jvi)): ?>
<?php get_template_part( 'panel-template', 'jobs' );           // reusable jobs template (panel-template-jobs.php) ?>
<?php else: ?>
<?php get_template_part( 'panel-template', 'job-description' ); ?>
<?php endif; ?>

<?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>

<?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div>
<?php roots_content_after(); ?>
<?php get_footer(); ?>
