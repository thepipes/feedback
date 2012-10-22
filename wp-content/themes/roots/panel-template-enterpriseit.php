<?php
/*
* TEMPLATE PART: product-template
* DESCRIPTION: reusable panel sections of product template using productfeatures metabox
*/


?>

<div class="row panel-container panel-last">

        <div class="panel-wrapper panel-wrapper-full grid12 raised">
            <div class="panel panel-full panel-top">
              <div class="row enterpriseit-content">
              <div class="grid8 case-studies-content">
                    <?php
                    if (have_posts()) : while (have_posts()) : the_post();
                        ?>
                           <?php the_content(); ?>
                        <?php endwhile; endif; ?>
                   
                </div>

                <div class="grid4">
                  <?php get_template_part( 'sidebar-enterpriseit' );           // sidebar quote template (sidebar-enterpriseit.php) ?>
                </div>

               </div>
               <div class="warp"></div>
            </div>
        </div>
</div>
