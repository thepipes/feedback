<?php

$features_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_features_meta',
	'title' => 'Features List',
	'template' => get_stylesheet_directory() . '/metaboxes/features-meta.php',
	'include_template' => array('page-feature-list.php'),
	'hide_editor' => true
));

/* eof */