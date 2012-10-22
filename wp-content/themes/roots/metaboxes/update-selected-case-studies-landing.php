<?php
require( '../../../../wp-load.php' );
$postID = '';
$selection = '';
if(isset($_POST['id']))
    $postID     = $_POST['id'];
if(isset($_POST['selection']))
    $selection  = $_POST['selection'];
if($postID != '' && $selection != ''){
    $before =  get_post_meta(get_the_ID(), "selected-case-studies-landing-footer", true);
    $update = update_post_meta($postID, "selected-case-studies-landing-footer", $selection);
    echo "Updated";
}
else {
    echo "error";
}
