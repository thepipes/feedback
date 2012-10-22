<?php

include_once 'MetaBox.php';
include_once 'MediaAccess.php';

// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');

$wpalchemy_media_access = new WPAlchemy_MediaAccess();
/* eof */