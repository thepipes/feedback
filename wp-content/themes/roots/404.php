<?php
get_header(); ?>

<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<div id="content" class="no-image">
  <div id="main" role="main" class="main container">
    <div class="row">
      <div class="grid12">
        <div class="heading-wrapper">
          <h1 style="color: #666;"><?php echo _e('Page Not Found'); ?></h1>
        </div>
      </div>
    </div>

<?php roots_loop_before(); ?>

<div class="row panel-container">
  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-404">
      <p><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'roots'); ?></p>
      <p><?php _e('Please try the following:', 'roots'); ?></p>
      <ul class="bulleted">
          <li><?php _e('Check your spelling', 'roots'); ?></li>
          <li><?php printf(__('Return to the <a href="%s">home page</a>', 'roots'), home_url()); ?></li>
          <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'roots'); ?></li>
        </ul>
        <form class="search-form" role="search" method="get" action="<?php echo home_url('/about/search/'); ?>" onsubmit="return validateSearchForm(this)">
          <input class="search-input" placeholder="<?php _e('Search') ?>" type="text" value="" name="s404" id="s404" />
          <input type="submit" class="button search-btn" value=""/>
        </form>
    </div>
  </div>
</div>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div><!-- /#content, closing of heading -->
<?php roots_content_after(); ?>
<?php get_footer(); ?>