<?php
/*
* TEMPLATE PART: case-study
* DESCRIPTION: main content section of case studies
*/
?>
<div class="row panel-container panel-last">
  <div class="warp"></div>
  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">

      <div class="row case-studies-content">


        <div class="grid8">
          <?php // Get the main content information and display it if available
          $main_content = get_post_meta( get_the_ID(), 'yam_main_content', true );
          if (count($main_content) >= 1):
            ?>

            <?php echo $main_content; ?>

          <?php endif; ?>

          <?php // Get the benefits information and display it if available
          $benefits = get_post_meta( get_the_ID(), 'yam_results_and_benefits', true );
          $benefits_count = count($benefits) - 1;
          $count = 0;
          if ($benefits_count >= 1):
            ?>
              <h2><?php _e("Benefits")?></h2>
              <ul class="results-and-benefits">
                <?php // LOOP THROUGH BENEFITS
                while ($count <= $benefits_count) :
                  ?>
                  <li><?php echo $benefits[$count]; ?></li>
                  <?php
                  $count++;
                endwhile; ?>
              </ul>
            <?php endif; ?>



          <?php // Get the PDFs and display it if available
          $pdfs = get_posts(array(
            'numberposts' => -1,
            'post_type' => 'attachment',
            'post_parent' => get_the_ID(),
            'post_mime_type' => 'application/pdf', // get attached PDFs only
            'output' => ARRAY_A
          ));
          global $roots_options;
          if (count($pdfs) >= 1):
            $ga = "onClick=\"_gaq.push(['_trackEvent', 'Downloads', 'Case Study', '" . $pdfs[0]->post_name . "']);\"";
            ?>

            <p><a href="<?php echo $pdfs[0]->guid; ?>" <?php if($roots_options['google_analytics_id'] != ''){ echo $ga; } ?>><img src="<?php echo get_template_directory_uri(); ?>/img/icon-download.png"  alt="Download Case Study" class="icon"/>Download Case Study</a></p>


            <?php endif; ?>
        </div>


        <div class="grid4">

          <?php // Get client id and display available customer information

          $client_id = get_post_meta( get_the_ID(), 'yam_client_id', true );

          $image_id = get_post_thumbnail_id( $client_id );
          $image = wp_get_attachment_image_src($image_id, 'customer-logo-case-studies');
          if (count($image) > 2) {
            //$image_width = $image[1];
            $image_height = $image[2] / 2;
            $img_style = 'margin-top:0px';
            if($image_height < 50) {$img_style = 'margin-top:'. (50 - $image_height) .'px';}
          }
          $logo = get_the_post_thumbnail( $client_id, 'customer-logo-case-studies', array('class' => 'customer-logo', 'style' => $img_style));
          $company = get_the_title($client_id);
          $region = get_post_meta( $client_id, 'yam_region', true );
          $industries = get_the_terms( $client_id, 'customer-industry');
          $employees = get_post_meta( $client_id, 'yam_employees', true );
          $founded = get_post_meta( $client_id, 'yam_founded', true );
          $revenue = get_post_meta( $client_id, 'yam_revenue', true );

          ?>

          <div class="customer-info">
            <?php if (strlen($logo) >= 1): ?>
            <div class="client-wrapper-container grid4">
              <div class="client-wrapper">
                <div class="client-container">
                  <?php echo $logo; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <?php if (strlen($company) >= 1): ?>
            <p><?php _e("Company")?></p>
            <h3><?php echo $company; ?></h3>
            <?php endif; ?>

            <?php if (strlen($region) >= 1): ?>
            <p><?php _e("Region")?></p>
            <h3><?php echo $region; ?></h3>
            <?php endif; ?>

            <?php
            if (count($industries) >= 1 && $industries[0] != ''): ?>
            <p><?php _e("Industry")?></p>
            <h3><?php
              $industryCount = 1;
              foreach ( $industries as $industry ) {
              echo (count($industries) != $industryCount) ? $industry->name.", " : $industry->name;
              $industryCount++;
            } ?></h3>
            <?php endif; ?>

            <?php if (strlen($employees) >= 1): ?>
            <p><?php _e("Employees")?></p>
            <h3><?php echo $employees; ?></h3>
            <?php endif; ?>

            <?php if (strlen($founded) >= 1): ?>
            <p><?php _e("Founded")?></p>
            <h3><?php echo $founded; ?></h3>
            <?php endif; ?>

            <?php if (strlen($revenue) >= 1): ?>
            <p><?php _e("Revenue")?></p>
            <h3><?php echo $revenue; ?></h3>
            <?php endif; ?>
          </div>

          <?php get_template_part( 'quote-right' );           // sidebar quote template (quote-right.php) ?>

        </div>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>


