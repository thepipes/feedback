<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />

  <title><?php wp_title(''); ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php roots_stylesheets(); ?>
  <?php roots_head(); ?>
  <?php wp_head(); ?>
  <script src="//cdn.optimizely.com/js/62787045.js"></script>
</head>

<body id="top" <?php body_class(roots_body_class()); ?> role="document">
  <?php roots_wrap_before();?>
  <?php roots_header_before(); ?>
  <?php 
    global $roots_options;
    if($roots_options['announcement_on'] == 'yes'){
   ?>
    <?php } ?>
    <header class="global-header" class="<?php global $roots_options; ?>" role="banner">
      <div class="container">
      <?php roots_header_inside(); ?>
      <div class="row">
        <div class="grid5">
          <a href="/">
            <img src="<?php echo get_template_directory_uri(); ?>/img/feedback_logo.jpg" alt="<?php bloginfo('name'); ?>">
          </a>
        </div>
        <div class="grid7">
          <div class="search-header">
            <ul class="menu">
              <li class="login" style="margin-right: 0px;"><a href="https://help.yammer.com"><?php _e("Help Center");?></a></li>
              <li class="signup left-divider"><a href="https://www.yammer.com/"><?php _e("Yammer.com");?></a></li>
            </ul>
          </div>
        </div>
      </div>
      </div>
      <?php
      $emailQueryVar = get_email_queryvars();
      ?>
      <img id="yamalytics" width="0" height="0" class="yj-hide" src="/images/public-site-spacer.gif<?php echo (isset($emailQueryVar) && $emailQueryVar != '') ? "?m=".$emailQueryVar."&v=".time() : "?v=" . time();?>" />
    </header>
    <?php
      $show_breadcrumbs = get_post_meta( get_the_ID(), 'yam_show_breadrcrumbs', true );
      if(function_exists('bcn_yammer_display')):
    ?>
    <?php if ($show_breadcrumbs != 'NO'): ?>
    <div class="breadcrumbs-bg"></div>
    <?php endif; ?>
          <?php if ($show_breadcrumbs != 'NO'): ?>
    <div class="breadcrumbs">
      <div class="container">
        <div class="breadcrumbs-container">

          <?php bcn_yammer_display(); ?>

        </div>
      </div>
    </div>
          <?php endif; ?>
    <? endif; ?>
  <?php roots_header_after(); ?>