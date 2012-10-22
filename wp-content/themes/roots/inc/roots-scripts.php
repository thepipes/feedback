<?php

function roots_scripts() {
  $template_uri = get_template_directory_uri();
  global $roots_options;
   

  wp_register_script('roots_jquery', ''.$template_uri.'/js/libs/jquery-1.7.1.min.js'. versionControl(), false, null, false);
  wp_register_script('roots_mustache', ''.$template_uri.'/js/mustache.js' . versionControl(), false, null, true);
  wp_register_script('roots_yammer', ''.$template_uri.'/js/script.js'. versionControl(), false, null, true);
  wp_register_script('roots_modal', ''.$template_uri.'/js/libs/jquery.reveal.js'. versionControl(), false, null, true);
  wp_register_script('roots_plugins', ''.$template_uri.'/js/plugins.js' . versionControl(), false, null, true);
  wp_register_script('argyle-social-crm', ''.$template_uri.'/js/argyle-crm-contact-min.js'. versionControl(), false, null, true);
  wp_register_script('roots_marketoMunchkin', 'https://munchkin.marketo.net/munchkin.js'. versionControl(), false, null, true);
  //landing-menu template specific
  //
  wp_register_script('roots_marketo', ''.$template_uri.'/js/marketo.js'. versionControl(), false, null, true);
  wp_register_script('roots_marketoForm', ''.$template_uri.'/js/mktFormSupport.js'. versionControl(), false, null, true);
  wp_register_script('lib-jquery-validate', ''.$template_uri.'/js/libs/jquery.validate.min.js'. versionControl(), false, null, true);
  wp_register_script('lib-jquery-form', ''.$template_uri.'/js/libs/jquery.form.js'. versionControl(), false, null, true);  

  wp_enqueue_script('roots_jquery');
  wp_enqueue_script('roots_mustache');
  wp_enqueue_script('roots_yammer');
  wp_enqueue_script('roots_modal');
  wp_enqueue_script('roots_plugins');
  wp_enqueue_script('argyle-social-crm');
  wp_enqueue_script('roots_marketoMunchkin');
  //landing-menu template specific
  if ( is_page_template('page-landing-menu.php') ) {
    wp_enqueue_script('roots_marketo');
    wp_enqueue_script('roots_marketoForm');
    wp_enqueue_script('lib-jquery-validate');
    wp_enqueue_script('lib-jquery-form');
  }

  if($roots_options['announcement_on'] == 'yes'){
    wp_register_script('lib-jquery-cookie', ''.$template_uri.'/js/libs/jquery.cookie.js'. versionControl(), false, null, true);
    wp_enqueue_script('lib-jquery-cookie');
  }

  if (roots_current_framework() === '1140') {
    wp_register_script('css3-mediaqueries', ''.$template_uri.'/js/libs/css3-mediaqueries.js', false, null, false);
    wp_enqueue_script('css3-mediaqueries');
  }

  if (roots_current_framework() === 'adapt') {
    wp_register_script('adapt', ''.$template_uri.'/js/libs/adapt.min.js', false, null, false);
    wp_enqueue_script('adapt');
  }

  if (roots_current_framework() === 'foundation') {
    wp_register_script('foundation-jquery-reveal', ''.$template_uri.'/js/foundation/jquery.reveal.js', false, null, false);
    wp_register_script('foundation-jquery-orbit', ''.$template_uri.'/js/foundation/jquery.orbit-1.3.0.js', false, null, false);
    wp_register_script('foundation-forms-jquery', ''.$template_uri.'/js/foundation/forms.jquery.js', false, null, false);
    wp_register_script('foundation-jquery-customforms', ''.$template_uri.'/js/foundation/jquery.customforms.js', false, null, false);
    wp_register_script('foundation-jquery-placeholder', ''.$template_uri.'/js/foundation/jquery.placeholder.min.js', false, null, false);
    wp_register_script('foundation-app', ''.$template_uri.'/js/foundation/app.js', false, null, false);

    wp_enqueue_script('foundation-jquery-reveal');
    wp_enqueue_script('foundation-jquery-orbit');
    wp_enqueue_script('foundation-forms-jquery');
    wp_enqueue_script('foundation-jquery-customforms');
    wp_enqueue_script('foundation-jquery-placeholder');
    wp_enqueue_script('foundation-app');
  }

  if (roots_current_framework() === 'bootstrap' || roots_current_framework() === 'bootstrap_less') {
    $roots_bootstrap_js = $roots_options['bootstrap_javascript'];
    $roots_bootstrap_less_js = $roots_options['bootstrap_less_javascript'];
    $template_uri = get_template_directory_uri();
    if (roots_current_framework() === 'bootstrap_less') {
      wp_register_script('bootstrap-less', ''.$template_uri.'/js/bootstrap/less-1.2.1.min.js', false, null, false);
      wp_enqueue_script('bootstrap-less');
    }
    if ($roots_bootstrap_js === true || $roots_bootstrap_less_js === true) {
      $roots_options['bootstrap_less_javascript'] = false;
      $roots_options['bootstrap_javascript'] = false;

      wp_register_script('bootstrap-transition', ''.$template_uri.'/js/bootstrap/bootstrap-transition.js', false, null, false);
      wp_register_script('bootstrap-alert', ''.$template_uri.'/js/bootstrap/bootstrap-alert.js', false, null, false);
      wp_register_script('bootstrap-modal', ''.$template_uri.'/js/bootstrap/bootstrap-modal.js', false, null, false);
      wp_register_script('bootstrap-dropdown', ''.$template_uri.'/js/bootstrap/bootstrap-dropdown.js', false, null, false);
      wp_register_script('bootstrap-scrollspy', ''.$template_uri.'/js/bootstrap/bootstrap-scrollspy.js', false, null, false);
      wp_register_script('bootstrap-tab', ''.$template_uri.'/js/bootstrap/bootstrap-tab.js', false, null, false);
      wp_register_script('bootstrap-tooltip', ''.$template_uri.'/js/bootstrap/bootstrap-tooltip.js', false, null, false);
      wp_register_script('bootstrap-popover', ''.$template_uri.'/js/bootstrap/bootstrap-popover.js', false, null, false);
      wp_register_script('bootstrap-button', ''.$template_uri.'/js/bootstrap/bootstrap-button.js', false, null, false);
      wp_register_script('bootstrap-collapse', ''.$template_uri.'/js/bootstrap/bootstrap-collapse.js', false, null, false);
      wp_register_script('bootstrap-carousel', ''.$template_uri.'/js/bootstrap/bootstrap-carousel.js', false, null, false);
      wp_register_script('bootstrap-typehead', ''.$template_uri.'/js/bootstrap/bootstrap-typehead.js', false, null, false);
      wp_enqueue_script('bootstrap-modal');
      wp_enqueue_script('bootstrap-alert');
      wp_enqueue_script('bootstrap-modal');
      wp_enqueue_script('bootstrap-dropdown');
      wp_enqueue_script('bootstrap-scrollspy');
      wp_enqueue_script('bootstrap-tab');
      wp_enqueue_script('bootstrap-tooltip');
      wp_enqueue_script('bootstrap-popover');
      wp_enqueue_script('bootstrap-button');
      wp_enqueue_script('bootstrap-collapse');
      wp_enqueue_script('bootstrap-carousel');
      wp_enqueue_script('bootstrap-typehead');
    }
  }
}

add_action('wp_enqueue_scripts', 'roots_scripts');

if (!is_admin()) {
  //add_action('wp_print_footer_scripts', 'roots_print_scripts');
}

function roots_print_scripts() {
  global $wp_scripts;
  $wp_scripts->all_deps($wp_scripts->queue);
  $scripts = array();
  
  foreach ($wp_scripts->queue as $key => $handle) {
    $skip_scripts = array('jquery', 'roots_script', 'roots_plugins');
  
    $src = $wp_scripts->registered[$handle]->src;
    unset($wp_scripts->queue[$key]);
    $wp_scripts->done[] = $handle;
  
    if (!in_array($handle, $skip_scripts)) {
      $scripts[] = '<script src="' . $src . '"></script>';
    }
  }
  
  echo "\t" . implode("\n\t", $scripts) . "\n";

  $wp_scripts->reset();
  return $wp_scripts->done;
}

?>