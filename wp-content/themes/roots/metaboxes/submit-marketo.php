<?php
$file = '';
if(isset($_GET['file'])){
    $file = $_GET['file'];
    header('Content-disposition: attachment; filename='.$file);
    header('Content-type: application/pdf');
    readfile($file);
}
?>