<form class="search-form" role="search" method="get" action="<?php echo home_url('/about/search/'); ?>" onsubmit="return validateSearchForm(this)">
  <input class="search-input" placeholder="<?php _e('Search') ?>" type="text" value="" name="s" id="s" />
  <input type="submit" class="button search-btn" value=""/>
</form>
