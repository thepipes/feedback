<?php
echo '<script type="text/javascript">var postID = '. $_GET['post'] .'; </script> ';
$args = array(
    'post_type'     => 'casestudies',
    'post_status'   => 'publish',
    'meta_key'=>'_thumbnail_id',
    'meta_query'    => array ( array ('key' => 'yam_client_id', 'value' => '0', 'compare' => '>' )),
    'orderby'       => 'menu_order',
    'order'         => 'ASC',
    'posts_per_page' => -1
);
?>
<div class="custom-meta case-studies-selection-container">
    <div>
        <select id="current-case-studies" multiple size="10">
            <?php
              $the_query = new WP_Query( $args );
              $allposts = $the_query->get_posts();
              foreach ($allposts as $thepost){  ?>
                <option value="<?php echo $thepost->ID; ?>">
                  <?php echo ($thepost->post_title); ?>
                </option>
              <?php }
              wp_reset_postdata();
            ?>
        </select>

    </div>
    <div>
        <input type="button" name="add" id="move-case-study-to-left" value="<< Remove"/>
        <input type="button" name="add" id="move-case-study-to-right" value="Add >> "/> </div>
    <div>
        <select id="yam-selected-case-studies-landing"  multiple size="10">
            <?php
            $args2 = array(
                'post_type'     => 'casestudies',
                'post_status'   => 'publish',
                'meta_key'=>'_thumbnail_id',
                'order'         => 'ASC',
                'posts_per_page' => -1,
                'post__in' => explode(",", get_post_meta($_GET['post'], 'selected-case-studies-landing-footer', true))

            );
          $the_query2 = new WP_Query( $args2 );
          $allposts2 = $the_query2->get_posts();

          foreach ($allposts2 as $thepost2){  ?>
            <option value="<?php echo $thepost2->ID; ?>">
              <?php echo ($thepost2->post_title); ?>
            </option>
            <?php }
            wp_reset_postdata();
            ?>
        </select>
    </div>
    <p id="contentRight"></p>
    <div>There is a maximum of 8 case studies that can be displayed. Select the case studies you wish to display from the list of the left, then click "add >>" to move them to the list on the right. Then update the page.</div>
</div>