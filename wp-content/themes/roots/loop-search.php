<?php
/*
* TEMPLATE PART: loop-search
* DESCRIPTION: reusable panel section for listing search results
*/
?>
<div class="row panel-container full-width panel-last">
  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">
      <div class="row post-listing-content">
        <div class="inner-full-width">
          <?php
          if (have_posts()) : while (have_posts()) : the_post();
            ?>

            <article>
              <h3><a href="<?php the_permalink(); ?>"<?php echo (strpos(get_permalink(), get_option('siteurl')) === false) ? ' target="_blank"': ''; ?>><?php the_title(); ?></a></h3>
              <?php the_excerpt(); ?>
            </article>
            <?php endwhile;
            else: ?>
              <p><?php _e('No results found for your query. Check your spelling or try another term.', 'roots'); ?></p>
              <form class="search-form" role="search" method="get" action="<?php echo home_url('/about/search/'); ?>" onsubmit="return validateSearchForm(this)">
                <input class="search-input" placeholder="<?php _e('Search') ?>" type="text" value="" name="s" id="s404" />
                <input type="submit" class="button search-btn" value=""/>
              </form>
            <?php endif; ?>

          <?php /* Display navigation to next/previous pages when applicable */ ?>
          <div class="page-links">
            <?php
            global $wp_query;

            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
              'format' => '?paged=%#%',
              'prev_text'    => __('&lt; Previous'),
              'next_text'    => __('Next &gt;'),
              'current' => max( 1, get_query_var('paged') ),
              'total' => $wp_query->max_num_pages
            ) );
            ?>
          </div>
        </div>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>






