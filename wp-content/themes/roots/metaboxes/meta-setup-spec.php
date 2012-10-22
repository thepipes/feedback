<?php
$marketo_form_mb = new WPAlchemy_MetaBox(array
(
  'id' => '_marketo_form_meta',
  'title' => 'Marketo Form Display Text',
  'template' => get_stylesheet_directory() . '/metaboxes/marketo-form-meta.php',
  'include_template' => array('page-landing-menu.php'),
  'priority' => 'low'
));

$social_tracking_mb = new WPAlchemy_MetaBox(array
(
  'id' => '_social_tracking_meta',
  'title' => 'Social Tracking Meta',
  'types' => array('page', 'post', 'enterpriseit', 'productfeatures', 'solutions', 'casestudies'),
  'template' => get_stylesheet_directory() . '/metaboxes/social-tracking-meta.php',
  'priority' => 'low'
));
?>