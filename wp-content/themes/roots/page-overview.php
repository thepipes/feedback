<?php
/*
Template Name: Overview Template
Template Description: single page template for standard overview pages
*/
get_header(); ?>
<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php //check if the post has a featured thumbnail and set the main content area's background to it ?>

<?php get_template_part( 'heading' );           // heading section (heading.php) ?>

<?php roots_loop_before(); ?>

<?php get_template_part( 'panel-template', 'teaser' );           // reusable panel template (panel-template-teaser.php) ?>

<?php
  $panelsHeading = get_post_meta( get_the_ID(), 'yam_overview_panels_heading', true );
  if(isset($panelsHeading) && $panelsHeading != ''): ?>
    <div class="row">
      <div class="grid12">
        <h3 class="panels-heading"><?php echo $panelsHeading; ?></h3>
      </div>
    </div>
  <?php endif; ?>


<?php get_template_part( 'panel-template', 'overview' );           // reusable panel template (panel-template-overview.php) ?>

<?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>

<?php get_template_part( 'bottom-cta' ); // dynamic bottom cta section (bottom-cta.php) ?>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div>
<?php roots_content_after(); ?>
<?php get_footer(); ?>
