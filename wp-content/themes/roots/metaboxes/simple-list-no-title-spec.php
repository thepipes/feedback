<?php
$list_no_title_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_simple_list_no_title_meta',
    'title' => 'List Items',
    'template' => get_stylesheet_directory() . '/metaboxes/simple-list-no-title-meta.php',
    'include_template' => array('page-pricing.php'),
    'hide_editor' => true,
    'priority' => 'low'
));
?>
