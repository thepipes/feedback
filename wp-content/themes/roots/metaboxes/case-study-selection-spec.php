<?php
$casestudy_selection_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_case_study_selection_meta',
    'title' => 'Case Study Selection',
    'template' => get_stylesheet_directory() . '/metaboxes/case-study-selection-meta.php',
    'include_template' => array('page-landing-menu.php'),
    'hide_editor' => false,
    'priority' => 'low'
));
?>