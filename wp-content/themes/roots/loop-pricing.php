<?php
global $pricing_mb, $pricing_plan_mb, $list_mb, $list_no_title_mb, $roots_options;
$pricing_mb->the_meta(); // get the meta data for the current post
$pricing_plan_mb->the_meta(); // get the meta data for the current post
$list_mb->the_meta(); // get the meta data for the current post
$list_no_title_mb->the_meta(); // get the meta data for the current post
$m = new Mustache;
$premium_groups_on = $roots_options['premium_groups_apr24'];

$item_template = <<<TPL
      <div class="panel-wrapper panel-wrapper-pricing-plan grid3 raised">
        <div class="panel panel-pricing-container">
          <div class="pricing-plan-info pricing-title">
            {{title}}
          </div>
          <div class="pricing-plan-info pricing-price {{#free}}pricing-free{{/free}} {{#phone}}pricing-phone{{/phone}}">
            {{{price}}}
          </div>
          <div class="pricing-plan-info pricing-price-tagline">
            {{tagline}}
          </div>
          <div class="pricing-plan-info pricing-description">
            {{description}}
          </div>
          <div class="pricing-plan-info pricing-cta">
            {{{cta_html}}}
          </div>
          <div class="warp"></div>
        </div>
      </div>
TPL;
$feature_item_template = <<<TPL
      <div class="pricing-feature clearfix {{row-class}}">
        <div class="pricing-column">
          <div class="arrow arrow-right" {{^arrow}}style="visibility:hidden;"{{/arrow}}></div> <a class="pricing-feature-link" href="javascript://" title="">{{title}}</a>
        </div>
        {{{checkmarks}}}
      </div>
TPL;
$subfeature_item_template = <<<TPL
      <li class="pricing-subfeature-item">
        {{{checkmarks}}}
        <span class="pricing-subfeature-item-text">{{sub-feature-title}}</span>
      </li>
TPL;
$list_item_template = <<<TPL
      <li class="pricing-list-item">
        <span class="pricing-list-item-text">{{list-item-text}}</span>
      </li>
TPL;
$list_item_no_title_template = <<<TPL
      <li class="pricing-list-no-title-item">
        <span class="pricing-list-no-title-item-text">{{list-item-text}}</span>
      </li>
TPL;
?>
<div class="pricing-plans-wrap">
  <div class="panel-container pricing-plans">
    <?php
    $pricing_plan_count = $premium_groups_on ? 4 : 3;
    for ($i = 1; $i <= $pricing_plan_count; $i++) {
      $planName = $pricing_plan_mb->get_the_value('plan-name'.$i);
      $cta = $pricing_plan_mb->get_the_value('plan-cta'.$i);
      $cta_html = '';
      if ($cta == 'contact_sales') {
        $cta_html = '<a class="yj-btn yj-btn-green" href="/about/contact-sales" data-reveal-id="contact-sales">'.__('Contact Sales').'</a>';
      } else {
        $ga_pricing ='';
        if ($roots_options['google_analytics_id'] != '') {
          if (strstr($planName, 'Basic')) {
            $ga_pricing = '_gaq.push([\'_trackEvent\', \'CTA\', \'Sign Up\', \'pricing_basic\']);';
          } else if (strstr($planName, 'Premium')) {
            $ga_pricing = '_gaq.push([\'_trackEvent\', \'CTA\', \'Sign Up\', \'pricing_premium\']);';
          }
        }
        $cta_html = '<a class="yj-btn yj-btn-orange" href="/signup" onClick="'.$ga_pricing.'">'.__('Sign Up').'</a>';
      }
      $phone = $pricing_plan_mb->get_the_value('pricing-phone-number'.$i);
      $price = $phone ?
          sprintf(__('Call <span class="pricing-phone-number">%s</span><br />for pricing'), $pricing_plan_mb->get_the_value('plan-price'.$i)) :
          $pricing_plan_mb->get_the_value('plan-price'.$i);
      echo $m->render($item_template, array(
        'title' => $planName,
        'price' => $price,
        'tagline' => $pricing_plan_mb->get_the_value('plan-price-tagline'.$i),
        'description' => $pricing_plan_mb->get_the_value('plan-description'.$i),
        'cta_html' => $cta_html,
        'free' => $pricing_plan_mb->get_the_value('bold-uppercase-price'.$i),
        'phone' => $phone
      ));
    }
    ?>
  </div>
</div>

<div class="panel-wrapper raised clearfix">
  <div class="panel panel-container pricing-features-container">
    <div class="pricing-features-header clearfix">
      <div class="pricing-header-column"><?php _e('Enterprise') ?></div>
      <div class="pricing-header-column"><?php _e('Business') ?></div>
      <?php if ($premium_groups_on): ?>
        <div class="pricing-header-column"><?php _e('Premium Groups') ?></div>
      <?php endif; ?>
      <div class="pricing-header-column"><?php _e('Basic') ?></div>
    </div>
    <div class="pricing-features-content">
      <?php
      $number_of_features = $pricing_mb->get_the_value('number-features');
      for ($i = 1; $i <= $number_of_features; $i++) {
        if ($pricing_mb->get_the_value('title'.$i) != '') {
          $row_class = '';
          $level = $pricing_mb->get_the_value('level'.$i);
          if ($level == 5) {
            $row_class = 'pricing-single-row';
            $checkmarks = '<span class="pricing-text-wrap">';
            $ii = 0;
            while ($pricing_mb->have_fields_and_multi('features'.$i)) {
              if (!$premium_groups_on && $ii == 1) {
                $ii++;
                continue;
              }
              $checkmarks.='<span class="pricing-column pricing-text-column">'.$pricing_mb->get_the_value('sub-feature-title'.$i).'</span>';
              $ii++;
            }
            $checkmarks.='</span>';
          } else {
            if (!$pricing_mb->get_the_value('features'.$i)) {
              $row_class = 'pricing-single-row';
            }
            if (!$premium_groups_on) {
              if ($level == 2) {
                continue;
              } else if ($level > 2) {
                $level--;
              }
            }
            $level_cap = $premium_groups_on ? 5 : 4;
            $checkmarks = str_repeat('<span class="pricing-column checkmark-column"></span>', $level_cap - $level);
          }
          echo "<div class=\"pricing-features\">";
            echo $m->render($feature_item_template, array(
              'title' => $pricing_mb->get_the_value('title'.$i),
              'row-class' => $row_class,
              'checkmarks' => $checkmarks,
              'arrow' => ($level != 5) && $pricing_mb->get_the_value('features'.$i)
            ));
            if ($level != 5) {
              echo "<ul class=\"pricing-subfeatures\">";
                while($pricing_mb->have_fields_and_multi('features'.$i)) {
                  echo $m->render($subfeature_item_template, array(
                    'sub-feature-title' => $pricing_mb->get_the_value('sub-feature-title'.$i),
                    'checkmarks' => $checkmarks
                  ));
                }
              echo "</ul>";
            }
          echo "</div>";
        }
      }
      ?>
    </div>
  </div>

  <div class="pricing-list-items-container">
    <?php
      echo '<h4>'.$list_mb->get_the_value('list-title').'</h4>';
      echo "<ul class=\"pricing-list-items clearfix\">";
        while($list_mb->have_fields_and_multi('items')) {
          echo $m->render($list_item_template, array(
            'list-item-text' => $list_mb->get_the_value('item-title'),
          ));
        }
      echo "</ul>";
    ?>
  </div>
  <div class="warp"></div>

  <div class="pricing-list-items-container">
    <?php
      echo "<ul class=\"pricing-list-items-no-title clearfix\">";
        while($list_no_title_mb->have_fields_and_multi('items')) {
          echo $m->render($list_item_no_title_template, array(
            'list-item-text' => $list_no_title_mb->get_the_value('item-title'),
          ));
        }
      echo "</ul>";
    ?>
  </div>
  <div class="warp"></div>
</div>

