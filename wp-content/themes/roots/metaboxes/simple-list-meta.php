<?php
global $wpalchemy_media_access;
?>
<div class="custom-meta">
    <h4>Items List</h4>
    <div class="row cf">
        <div class="col left">
    <label>List Title</label>
    <?php $metabox->the_field('list-title'); ?>
    <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
        </div>
    </div>
        <div class="row cf">
            <div class="col left">
                <?php while($metabox->have_fields_and_multi('items')): ?>
                <?php $metabox->the_group_open(); ?>
                <label>Feature</label>
                <?php $metabox->the_field('item-title'); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                <?php $metabox->the_group_close(); ?>
                <?php endwhile; ?>
                <p><a href="#" class="docopy-items button">Add Feature</a></p>
            </div>
        </div>
</div>
