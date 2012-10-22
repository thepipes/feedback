<?php
global $wpalchemy_media_access;
?>
<fieldset>
    <?php $metabox->the_field('number-features'); ?>
    <label>Number of Features</label>
    <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
    <span>Enter the number of features and then update/save this post.</span>
</fieldset>
<div class="custom-meta">
<?php
    $numer_of_features = $metabox->get_the_value('number-features');
    if($numer_of_features < 1) {$numer_of_features = 1;}
    for ($i = 1; $i <= $numer_of_features; $i++ ) { ?>
    <h4>Feature</h4>
    <div class="row cf">
        <div class="col left">
            <label>Feature Title</label>
                <?php $metabox->the_field('title'.$i); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                <span>(e.g. "Enterprise Social Networking Features")</span>
        </div>
        <div class="col right">
            <label>Level</label>
            <?php $metabox->the_field('level'.$i); ?>
            <?php $selected = ' selected="selected"'; ?>
            <select name="<?php $metabox->the_name(); ?>">
                <option value="0"> Select Level </option>
                <option value="1"<?php if ($metabox->get_the_value() == '1') echo $selected; ?>>1 - Basic</option>
                <option value="2"<?php if ($metabox->get_the_value() == '2') echo $selected; ?>>2 - Premium Groups</option>
                <option value="3"<?php if ($metabox->get_the_value() == '3') echo $selected; ?>>3 - Business</option>
                <option value="4"<?php if ($metabox->get_the_value() == '4') echo $selected; ?>>4 - Enterprise</option>
                <option value="5"<?php if ($metabox->get_the_value() == '5') echo $selected; ?>>Text Columns</option>
            </select>
            <span>(e.g. "1 for Basic, 2 for Premium Groups, 3 for Business, and 4 for Enterprise")</span>
        </div>
        <fieldset class="row">
            <div class="col left">
                <?php while($metabox->have_fields_and_multi('features'.$i)): ?>
                <?php $metabox->the_group_open(); ?>
                <label>Subfeature</label>
                <?php $metabox->the_field('sub-feature-title'.$i); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                <?php $metabox->the_group_close(); ?>
                <?php endwhile; ?>
                <p><a href="#" class="docopy-features<?php echo $i; ?> button">Add Subfeature</a></p>
            </div>
        </fieldset>
    </div>
    <?php } ?>
</div>
