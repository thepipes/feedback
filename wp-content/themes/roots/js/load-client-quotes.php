<?php
require( '../../../../wp-load.php' );

$client_id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
$quote_text = get_post_meta( $client_id, 'yam_quote_text', true);
if (isset($quote_text) && $quote_text != '')
$quote_text = array_values(array_filter($quote_text));

$i = 0;
$len = count($quote_text);

if (isset($quote_text) && $quote_text != ''):
  foreach ($quote_text as $key => $quote):
    if (strlen($quote) >= 1):
      $return_array[] = array("optionValue" => $key, "optionDisplay" => "$quote");
    endif;
  endforeach;
else:
  $return_array[] = array("optionValue" => -1, "optionDisplay" => "No Quotes, add one to this customer.");
endif;

echo json_encode($return_array);
?>
