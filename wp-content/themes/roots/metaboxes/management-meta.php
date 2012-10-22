<?php global $wpalchemy_media_access; ?>
<div class="custom-meta">
<?php for ($i = 1; $i <= 2; $i++ ) { ?>
  <h4><?php echo ($i == 1) ? 'Executives' : "Board"; ?></h4>
  <div class="row cf">
    <label>Name <span>(optional, e.g. "Board of Directors")</span>
      <?php $metabox->the_field('name'.$i); ?>
      <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
    </label>
  </div>
  <?php 
    $field = 'management'.$i;
    $people = $metabox->meta[$field];
    $people_output = array();
    foreach($people as $person) {
      $fname = array_shift(explode(' ', $person['name']));
      $people_output[$person['order'].$fname] = $person;
    }
    if(ksort($people_output)) {
      $metabox->meta[$field] = array_values($people_output);
    };
   ?>
  <h5><?php echo ($i == 1) ? 'Executives' : "Board"; ?> Members</h5>
  <fieldset class="cf">
  <?php while($metabox->have_fields_and_multi($field, array('length' => 1))): ?>
  <?php $metabox->the_group_open(); ?>
    <h5>Member <?php echo 1 + $metabox->get_the_index(); ?>
      <?php if(!$metabox->is_first()) { ?>
      <span>[<a href="#" class="dodelete">Delete</a>]</span>
      <?php } else { ?>
      <span><a href="#" class="dodelete-<?php echo $field; ?> button">Remove All</a>
      <?php }?>
    </h5>
    <div class="row cf">
      <div class="col left">
        <!-- Name -->
        <?php $metabox->the_field('name'); ?>
        <label><p>Name</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
        </label>
        <!-- Title -->
        <?php $metabox->the_field('title'); ?>
        <label><p>Title</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
        </label>
        <!-- Bio -->
        <label><p>Bio</p>
          <?php $metabox->the_field('bio'); ?>
          <textarea name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>
        </label>  
        <!-- Order -->
        <label><p>Order</p>
          <?php $metabox->the_field('order'); ?>
          <input type="text" name="<?php $metabox->the_name(); ?>" class="small-text" value="<?php $metabox->the_value(); ?>" />
        </label>
        
      </div>
      <div class="col right">
        <?php $metabox->the_field('mugshot'); ?>
        <?php $wpalchemy_media_access->setGroupName('img'.$i.'-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
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
  <p class="add-group"><a href="#" class="docopy-<?php echo $field; ?> button">Add Member</a></p>
  </fieldset>
  
  <?php } ?>

</div>