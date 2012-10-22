<?php

$management_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_management_meta',
	'title' => 'Management List',
	'template' => get_stylesheet_directory() . '/metaboxes/management-meta.php',
	'include_template' => array('page-management.php'),
	'hide_editor' => true
));

/* eof */