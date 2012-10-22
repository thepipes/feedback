<?php
/*
* TEMPLATE PART: panel-template-featured-customers
* DESCRIPTION: reusable panel for featured-customers
*/
?>
<div class="row panel-container featured-customers-panel">

  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">

      <div class="row featured-customers-content">
        <div class="grid12">

            <?php get_template_part( 'panel-template', 'featured-clients-logo-list' );  // display the featured client logos from this template ?>
        </div>
      </div>
      <div class="warp"></div>

    </div>
  </div>

</div>

<div class="row panel-container panel-last">

    <div class="panel-wrapper panel-wrapper-full grid12 raised">
        <div class="panel panel-full">

            <div class="row featured-customers-content">
                <div class="grid12">
                    <h3><?php _e('Customer Library');?></h3>
                    <div class="row clients-list-container">
                    <?php
                        $industries = get_terms('customer-industry');
                        $count =0;
                        foreach ( $industries as $industry ) {

                            echo '<h3>'. $industry->name .'</h3>';

                            $args = array(
                                'post_type'     => 'clients',
                                'post_status'   => 'publish',
                                'customer-industry'      => $industry->slug,
                                'order'         => 'ASC',
                                'posts_per_page' => -1
                            );

                           query_posts($args);
                            echo '<div class="clients-list yj-clearfix">';
                           while ( have_posts() ) : the_post();
                               $case_study_id = get_post_meta($post->ID, 'yam_related_case_studies_ids', true);

                                echo '<div class="client-item">'; 
                                if ($case_study_id > 1 ){  echo '<a href="'. get_permalink($case_study_id) .'">' .get_the_title() . '</a>'; } else { echo get_the_title(); }
                               echo '</div>';
                           endwhile;
                            wp_reset_query();
                            echo '</div>';
                            if($count < (count($industries)-1)) { echo '<hr />'; }
                            $count++;
                        }

                    ?>
                    </div>
                </div>
            </div>
            <div class="warp"></div>

        </div>
    </div>

</div>