<?php get_header(); ?>
  <?php roots_content_before(); ?>
    <div id="content" class="<?php echo $roots_options['container_class']; ?> container">
    <?php roots_main_before(); ?>
      <div id="main" class="container" role="main">
        <div class="grid12">
          <h1><?php _e('Latest Posts', 'roots');?></h1>
          <?php get_template_part('loop', 'index'); ?>
        </div>
      </div><!-- /#main -->
    <?php roots_main_after(); ?>
    <?php roots_sidebar_before(); ?>
      <aside id="sidebar" class="<?php echo $roots_options['sidebar_class']; ?>" role="complementary">
      <?php roots_sidebar_inside_before(); ?>
        <div class="container">
          <?php get_sidebar(); ?>
        </div>
      <?php roots_sidebar_inside_after(); ?>
      </aside><!-- /#sidebar -->
    <?php roots_sidebar_after(); ?>
    </div><!-- /#content -->
  <?php roots_content_after(); ?>
<?php get_footer(); ?>