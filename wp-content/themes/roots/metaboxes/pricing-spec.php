<?php
$pricing_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_pricing_meta',
    'title' => 'Pricing Details',
    'template' => get_stylesheet_directory() . '/metaboxes/pricing-meta.php',
    'include_template' => array('page-pricing.php'),
    'hide_editor' => true
));
?>