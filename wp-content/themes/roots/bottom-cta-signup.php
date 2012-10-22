<?php
/*
* TEMPLATE PART: signup-bottom
* DESCRIPTION: reusable bottom signup and CTA
*/
global $roots_options;
$ga_signup ="";
if($roots_options['google_analytics_id'] != ''){
  $ga_signup = '_gaq.push([\'_trackEvent\', \'CTA\', \'Sign Up\', \'bottom-cta-signup\']);';
}
?>

<div class="row signup-bottom">
  <div class="grid12">
    <span class="cta"><?php _e("Join your company's social network for free."); ?></span>
    <a href="<?php echo home_url()."/signup"; ?>" id="bottom-sign-up-button" class="yj-btn yj-btn-orange" onClick="<?php echo $ga_signup; ?>" ><?php _e('Sign Up'); ?></a>
    <p class="second-line"><?php printf(__('Or %1$s'), yammer_contact_sales_link()); ?></p>
  </div>
</div>