<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jcloralt
 * Date: 3/25/12
 * Time: 6:21 PM
 * To change this template use File | Settings | File Templates.
 */
require( '../../../../wp-load.php' );

$action                 = $_POST['action'];
$updateCustomersArray     = $_POST['customer'];

//passing an action as a parameter to ensure this happens only when the action is valid.
if ($action == "updateCustomerLogosOrder"){

   for ($i = 0; $i < count($updateCustomersArray); $i++) {
       $my_post = array();
       $my_post['ID'] = $updateCustomersArray[$i];
       $my_post['menu_order'] = $i;
       wp_update_post( $my_post );
    }

    echo 'Order Updated';
}

?>