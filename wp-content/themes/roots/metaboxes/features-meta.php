<?php global $wpalchemy_media_access; ?>
<div class="custom-meta">
  <div class="row cf">
    <div class="col">
    <label>Number of Features <span>(e.g. 7)</span></label>
    <?php $metabox->the_field('number-features'); ?>
    <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
    </div>
  </div>
  <div id="feature-section-parent">
<?php
  $number_features = $metabox->get_the_value('number-features');
  if($number_features == '' || $number_features < 0){
    $number_features = 7; // Default number of features to 7 for backward compatibility with production.
  }
    $order_array = array();
    $new_order_array = array();
    for ($i=1; $i <= $number_features; $i++){
      $current_order = $metabox->get_the_value('meta-number'.$i);
      $index_number  = $metabox->get_the_value('index-order'.$i);

      if($current_order == ""){
        $current_order = $i;
      }
      if($index_number == ""){
        $index_number = $i;
      }

      $order_array[$index_number] = $current_order;
    }

    arsort($order_array, SORT_NUMERIC);

  for ($i = 1; $i <= count($order_array); $i++ ) { ?>

  <div class="feature-section">
    <a href="#" class="feature-toggle"><h4>Feature List <?php echo $order_array[$i]; ?></h4></a>
    <div class="feature-section-content">

  <div class="row cf">
    <div class="col left">
      <label>Title <span>(e.g. "Have Fewer Meetings, Increase Productivity")</span></label>
        <?php $metabox->the_field('title'.$order_array[$i]); ?>
        <input class="feature-section-title" type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>

      <label><p>Link <span>(optional, include http/https)</span></p></label>
        <?php $metabox->the_field('title_link'.$order_array[$i]); ?>
        <input type="text" class="feature-section-title-link" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>

    </div>
    <div class="col right">
      <label><p>Section Icon</p></label>
        <?php $metabox->the_field('section'.$order_array[$i].'icon'); ?>
        <?php $wpalchemy_media_access->setGroupName('simg'.$order_array[$i])->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'feature-section-icon')); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
      <br />
      <?php $val = $mb->get_the_value(); ?>
      <?php if(!empty($val)) { ?>
      <img class="icon-preview" src="<?php echo $val; ?>" />
      <?php } ?>
    </div>
  </div>
  <h5>Section <?php echo $order_array[$i]; ?> Features</h5>
  <fieldset class="cf">
  <?php while($metabox->have_fields_and_multi('features'.$order_array[$i], array('length' => 1))): ?>
  <?php $metabox->the_group_open(); ?>
    <h5>Feature <?php echo 1 + $metabox->get_the_index(); ?>
      <?php if(!$metabox->is_first()) { ?>
      <span>[<a href="#" class="dodelete">Delete</a>]</span>
      <?php } else { ?>
      <span><a href="#" class="dodelete-features<?php echo $order_array[$i]; ?> button delete-feature-button">Remove All</a>
      <?php }?>
    </h5>
    <div class="row cf">
      <div class="col left">
        <!-- Name -->
        <?php $metabox->the_field('name'); ?>
        <label><p>Name</p></label>
        <input class="feature-item-name" type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />

        <!-- Link -->
        <?php $metabox->the_field('link'); ?>
        <label><p>Link <span>(optional, include http/https)</span></p></label>
        <input class="feature-item-link" type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />

        <label class="checkbox"><?php $mb->the_field('external'); ?></label>
        <input class="feature-item-external" type="checkbox" name="<?php $mb->the_name(); ?>" value="external"<?php $mb->the_checkbox_state('external'); ?>/> External Link? <span>(any non-yammer.com link)</span>

        <!-- Description -->
        <label><p>Description</p></label>
          <?php $metabox->the_field('description'); ?>
          <textarea class="feature-item-description" name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>

      </div>
      <div class="col right">
        <?php $metabox->the_field('icon'); ?>
        <?php $wpalchemy_media_access->setGroupName('img'.$order_array[$i].'-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'feature-item-icon')); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
        <?php $val = $mb->get_the_value(); ?>
        <?php if(!empty($val)) { ?>
        <img class="icon-preview" src="<?php echo $val; ?>" />
        <?php } ?>
      </div>
    </div>
    <div class="row cf">
    </div>
  <?php $metabox->the_group_close(); ?>
  <?php endwhile; ?>
  <p class="add-group"><a href="#" class="add-group-link docopy-features<?php echo $order_array[$i]; ?> button">Add Feature</a></p>
  </fieldset>
      </div>
    <?php $metabox->the_field('index-order'.$order_array[$i]); ?>
    <input class="index-order" type="hidden" name="<?php $metabox->the_name(); ?>" value="<?php echo ($metabox->get_the_value() == "")? $order_array[$i] : $metabox->get_the_value(); ?>"/>

    <?php $metabox->the_field('meta-number'.$order_array[$i]); ?>
    <input class="meta-number" type="hidden" name="<?php $metabox->the_name(); ?>" value="<?php echo ($metabox->get_the_value() == "")? $order_array[$i] : $metabox->get_the_value(); ?>"/>

  </div>

  <?php } ?>
</div>
</div>

<script type="text/javascript">
  var num_features = <?php echo $number_features; ?>;
  jQuery(document).ready(function() {
    jQuery(".feature-section-content").hide();
    //toggle the componenet with class msg_body
    jQuery(".feature-toggle").click(function()
    {
      jQuery(this).next('.feature-section-content').slideToggle(500);

    });
    jQuery("#feature-section-parent").sortable({
      stop: function(event, ui) {
        jQuery(".index-order").each(function(i, domEle){
             jQuery(domEle).val(i + 1);
        });
      }
    });
  var element
  <?php for ($i = 1; $i <= $number_features; $i++ ) { ?>
      element = "#wpa_loop-features" + <?php echo $i; ?>;
      jQuery(element).sortable();
    <?php } ?>
  });
</script>