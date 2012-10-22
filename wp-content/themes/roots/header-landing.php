<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />

  <title><?php wp_title(''); ?></title>

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php roots_stylesheets(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

  <?php roots_head(); ?>
  <?php wp_head(); ?>

</head>

<body id="top" <?php body_class(roots_body_class()); ?> role="document">

  <?php roots_wrap_before();?>
  <?php roots_header_before(); ?>
    <header class="global-header landing-header" class="<?php global $roots_options; ?>" role="banner">
      <div class="container">
      <?php roots_header_inside(); ?>
      <div class="row">
        <div class="grid5">
          <a href="<?php echo home_url(); ?>/">
            <img src="<?php echo get_template_directory_uri(); ?>/img/yammer-logo.png" class="yammer-logo" alt="<?php bloginfo('name'); ?>">
          </a>

        </div>
        <div class="grid7">
           <nav id="nav-main" role="navigation" class="row primary">
              <ul class="cta">
                <?php
                global $roots_options;
                $ga ='';
                if($roots_options['google_analytics_id'] != ''){
                  $ga = '_gaq.push([\'_trackEvent\', \'CTA\', \'Sign Up\', \'header-landing\']);';
                }
                ?>
                <li><a id="header-sign-up-button" class="yj-btn yj-btn-orange" href="<?php echo home_url()."/signup"; ?>" onClick="<?php echo $ga; ?>"><?php _e('Sign Up') ?></a></li>
                <li class="last-item"><a class="login-link" href="<?php echo home_url()."/login"; ?>"><?php _e('Log In'); ?></a></li>
              </ul>
            </nav>
        </div>
      </div>
     
      </div>
    </header>
    <?php
      $show_breadcrumbs = get_post_meta( get_the_ID(), 'yam_show_breadrcrumbs', true );
      if(function_exists('bcn_display')):
    ?>
    <?php if ($show_breadcrumbs != 'NO'): ?>
      <div class="breadcrumbs-bg"></div>
    <?php endif; ?>
    <div class="breadcrumbs">
      <div class="container">
        <div class="breadcrumbs-container">
          <?php if ($show_breadcrumbs != 'NO'): ?>
          <?php bcn_display(); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <? endif; ?>
    
  <?php roots_header_after(); ?>