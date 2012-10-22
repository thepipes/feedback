<?php if("solutions" == get_post_type() || "productfeatures" == get_post_type()): ?>
<div class="row next-section">
  <div class="grid12">
    <h4><?php if(get_adjacent_post(false, '', false)) { echo __('Next Section') . ': '; next_post_link('%link'); }?></h4>
  </div>
</div>
<?php endif; ?>