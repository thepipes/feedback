<?php
global $wpalchemy_media_access;
?>
<div class="custom-meta">
    <?php
    for ($i = 1; $i <= 4; $i++ ) { ?>
        <h4>Pricing Plan <?php echo $i;?></h4>
        <div class="row cf">
            <div class="col left">
                <label>Pricing Name</label>
                <?php $metabox->the_field('plan-name'.$i); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                <br />
                <span>(e.g. "Basic, Business, Enterprise, etc.")</span>
            </div>

            <div class="col left">
                <label>Price</label>
                <?php $metabox->the_field('plan-price'.$i); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                <br />
                <span>(e.g. "$5")</span>
                <br />
                <?php $metabox->the_field('bold-uppercase-price'.$i); ?>
                <input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/> Make <strong>Bold</strong> and UPPERCASE <span>(e.g. <strong>FREE</strong>)</span>
                <br />
                <?php $metabox->the_field('pricing-phone-number'.$i); ?>
                <input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/> Phone number <span>(e.g. '888-926-7377', outputs 'Call 888-926-7377 for pricing')</span>
            </div>
            <div class="col right">
                <label>Price tagline</label>
                <?php $metabox->the_field('plan-price-tagline'.$i); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                <br />
                <span>(e.g. "Per user/month.")</span>
            </div>
            <div class="col right">
                <label>Price description</label>
                <?php $metabox->the_field('plan-description'.$i); ?>
                <textarea name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>
                <br />
                <span>(e.g. "Enterprise social networking with on-the-go access.")</span>
            </div>
            <div class="col right">
                <label>Call to Action Button</label>
                <?php $selected = ' selected="selected"'; ?>
                <?php $metabox->the_field('plan-cta'.$i); ?>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">-- Select One --</option>
                    <option value="sign_up"<?php if ($metabox->get_the_value() == 'sign_up') echo $selected; ?>>Sign Up</option>
                    <option value="contact_sales"<?php if ($metabox->get_the_value() == 'contact_sales') echo $selected; ?>>Contact Sales</option>
                </select>
            </div>
        </div>
        <?php } ?>
</div>
