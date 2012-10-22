<?php
/*
* TEMPLATE PART: signup-bottom
* DESCRIPTION: reusable bottom signup and CTA
*/
global $roots_options;
$ga3 ='';
if($roots_options['google_analytics_id'] != ''){
  $ga3 = '_gaq.push([\'_trackEvent\', \'CTA\', \'Sign Up\', \'bottom-cta-sign-up\']);';
}
?>
<div class="row signup-bottom">
  <div class="grid12">
    <?php _e('Learn more about how Yammer can change your business.'); ?>
    <?php echo yammer_contact_sales_link('yj-btn yj-btn-green', '', 'button') ?>
    <?php
    $url = home_url().'/signup';
    $anchor = '<a id="bottom-sign-up-link" href="'.$url.'" onClick="'.$ga3.'">';
    ?>
    <p class="second-line"><?php printf(__('Or %1$s sign up %2$s for a free Yammer account.'), $anchor , "</a>"); ?></p>
  </div>
</div>