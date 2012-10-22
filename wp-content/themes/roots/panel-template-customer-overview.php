<?php
/*
* TEMPLATE PART: panel-template-customer-overview
* DESCRIPTION: reusable panel sections for customer overview page
*/
  $related_heading = get_post_meta( get_the_ID(), 'yam_customer_success_heading');
  $related_heading_image = get_image_urls( get_the_ID(), 'yam_customer_success_heading_image');
  $related_heading_link = get_post_meta( get_the_ID(), 'yam_customer_success_heading_link');
  $category_id = get_post_meta( get_the_ID(), 'yam_category_id', true);

  $count = 0;
?>
<div class="row panel-container">
  <div class="panel-wrapper grid12 raised">
    <div class="panel panel-related-case-studies-container panel-full">
      <?php if (count($related_heading) >=1 ) : ?>
        <div class="panel-overview">
          <div class="row">
            <div class="grid12 panel-headings">
              <h2><a href="<?php echo $related_heading_link[$count]; ?>"><?php echo $related_heading[$count] ?></a></h2>
              <?php if (!empty($related_heading_link[$count]) && $related_heading_link[$count] != ''): ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="yj-clearfix">
      <?php
        // The Query
        query_posts( array ( 'cat' => $category_id, 'posts_per_page' => 2) );

        // The Loop
        while ( have_posts() ) : the_post();
          echo '<div class="panel-related-case-studies grid4">';
          $permalink = get_permalink();
          $title = get_the_title();
          global $roots_options;
          $ga ='';
          if($roots_options['google_analytics_id'] != ''){
            $ga = "onClick=\"_gaq.push(['_trackEvent', 'Outbound', 'Related Case Studies', '". $title ."']);\"";
          }
          echo '<a href="'.$permalink.'"'.((strpos(get_permalink(), get_option('siteurl')) === false) ? ' target="_blank" ' . $ga : '').'><h2>'.$title.'</h2></a>';
          the_excerpt();
          echo '<a href="'.$permalink.'" class="cta"'.((strpos(get_permalink(), get_option('siteurl')) === false) ? ' target="_blank" ' . $ga : '').'>';
          _e('Read More');
          echo '<div class="arrow-right"></div></a>';
          echo '</div>';
        endwhile;

        // Reset Query
        wp_reset_query();

      ?>
      </div>
      <a class="cta" href="<?php echo $related_heading_link[$count]; ?>"><?php echo __('View all')." ".$related_heading[$count] ?><div class="arrow-right"></div></a>
    </div>
  </div>
</div>