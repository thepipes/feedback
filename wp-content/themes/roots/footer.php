    <?php

    roots_footer_before(); ?>

    <footer class="global-footer" role="contentinfo">
      <div class="container">
      <?php roots_footer_inside(); ?>
<p class="copy">&copy; <?php echo date('Y'); ?> Yammer</p>
              <ul id="menu-footer-navigation" class="menu">
<li><a href="http://blog.yammer.com">Blog</a></li>
<li><a href="https://www.yammer.com/about/terms/">Terms of Use</a></li>
<li><a href="https://www.yammer.com/about/privacy/">Privacy Policy</a></li>
<li><a href="https://help.yammer.com">Help Desk</a></li>
</ul>
        <?php if (wp_get_nav_menu_items('Footer Navigation')) { ?>
          <?php wp_nav_menu(array('theme_location' => 'footer_navigation')); ?>
        <?php } ?>
      </div>
      
    </footer>
    <?php
    global $social_tracking_mb;
    $socialhash = get_post_meta(get_the_ID(),$social_tracking_mb->get_the_id(), true);
    ?>
    <?php

    if( $socialhash['tracking-argyle'] != ""){
      echo '<img src="https://goals.ar.gy/bug.gif?hash=' . $socialhash['tracking-argyle'] . '"  style="width:0px;height:0px;display:none;">';
    }
    ?>
    <?php roots_footer_after(); ?>
  <?php wp_footer(); ?>
  <?php roots_footer(); ?>
    <div id="contact-sales" class="reveal-modal">
      <?php global $roots_options; ?>
      <?php
      if (class_exists(RGForms)):
        gravity_form($roots_options['contact_sales_form_id'], true, true, false);
      endif;  ?>
      <a class="close-reveal-modal">&#215;</a>
    </div>

  <?php
    if (class_exists(RGForms)):
      get_template_part( 'dynamic-gravity-form' ); // dynamic gravity forms. Set in Cutomize This Page in the WP admin.
    endif;

    if ($_POST['is_submit_1']): ?>
    <script>jQuery(document).ready(function() { jQuery('#header-contact-sales-link').trigger('click'); });</script>
    <?php endif;

    if ($_POST['is_submit_2']): ?>
    <script>jQuery(document).ready(function() { jQuery('#getting-started-btn').trigger('click'); });</script>
    <?php endif;
    ?>
    <script type="text/javascript">
      (function() {
        var didInit = false;
        function initMunchkin() {
          if(didInit === false) {
            didInit = true;
            Munchkin.init('635-GLP-906');
          }
        }
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = document.location.protocol + '//munchkin.marketo.net/munchkin.js';
        s.onreadystatechange = function() {
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
            initMunchkin();
          }
        };
        s.onload = initMunchkin;
        document.getElementsByTagName('head')[0].appendChild(s);
      })();
    </script>
    <?php printQuantcastTag(); ?>

</body>
</html>