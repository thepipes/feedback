<?php get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php //check if the post has a featured thumbnail and set the main content area's background to it ?>

<?php get_template_part( 'heading-search' );           // heading section (heading.php) ?>

<?php roots_loop_before(); ?>

<?php get_template_part( 'loop', 'search' );           // case study template (panel-template-case-studies.php) ?>
<?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>
<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->

<?php roots_main_after(); ?>

</div>
<?php roots_content_after(); ?>
<?php get_footer(); ?>
