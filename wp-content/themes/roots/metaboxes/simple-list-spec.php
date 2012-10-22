<?php
$list_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_simple_list_meta',
    'title' => 'List Items with Title',
    'template' => get_stylesheet_directory() . '/metaboxes/simple-list-meta.php',
    'include_template' => array('page-pricing.php'),
    'hide_editor' => true,
    'priority' => 'low'
));
?>
