<?php
$pricing_plan_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_pricing_plan_meta',
    'title' => 'Pricing Plans',
    'template' => get_stylesheet_directory() . '/metaboxes/pricing-plans-meta.php',
    'include_template' => array('page-pricing.php'),
    'hide_editor' => true
));
?>