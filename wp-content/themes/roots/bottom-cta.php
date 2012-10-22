<?php
/*
* TEMPLATE PART: bottom-cta
* DESCRIPTION: reusable bottom signup and CTA
*/

$cta = get_post_meta( get_the_ID(), 'yam_bottom_cta', true );
switch ($cta)
{
  case "Contact Sales":
    get_template_part( 'bottom-cta', 'sales' );
    break;
  case "Sign Up":
    get_template_part( 'bottom-cta', 'signup' );
    break;
  default:
    break;
}
?>
