<?php global $wpalchemy_media_access; ?>
<div class="custom-meta">
  <div class="row cf">
    <div class="col left">
      <?php $metabox->the_field('form-title'); ?>
      <label><p>Form Title</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="get the report now"/>
      </label>

      <?php $metabox->the_field('form-first-name'); ?>
      <label><p>Form First Name Tag</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="First Name"/>
      </label>

      <?php $metabox->the_field('form-email'); ?>
      <label><p>Form Email</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Email Address"/>
      </label>

      <?php $metabox->the_field('form-company'); ?>
      <label><p>Form Company</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Company Name"/>
      </label>

      <?php $metabox->the_field('form-country'); ?>
      <label><p>Form Country</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Country"/>
      </label>

      <?php $metabox->the_field('form-phone'); ?>
      <label><p>Form Phone</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Phone Number"/>
      </label>


      <?php $metabox->the_field('form-submit-button'); ?>
      <label><p>Form Submit Button Text</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Download Free Report"/>
      </label>

      <?php $metabox->the_field('form-error-single'); ?>
      <label><p>Form Error Message 1 Field</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="You missed 1 field. It has been highlighted."/>
      </label>

      <?php $metabox->the_field('form-thankyou-title'); ?>
      <label><p>Form Thank You Title</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Thank you"/>
      </label>

      <?php $metabox->the_field('form-footer-teaser'); ?>
      <label><p>Form Footer Teaser</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Not on Yammer Yet?"/>
      </label>
      <?php $metabox->the_field('form-footer-signup-text'); ?>
      <label><p>Form Footer Signup Text</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Sing up today."/>
      </label>
      <?php $metabox->the_field('page-global-companies-title'); ?>
      <label><p>Global Companies using Yammer</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Global Leading Companies Use Yammer"/>
      </label>

    </div>
    <div class="col left">
      <?php $metabox->the_field('form-subtitle'); ?>
      <label><p>Form Subtitle</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Fill out the form below to download the report"/>
      </label>
      <?php $metabox->the_field('form-last-name'); ?>
      <label><p>Form Last Name</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Last Name"/>
      </label>
      <?php $metabox->the_field('form-email-placeholder'); ?>
      <label><p>Form Email Placeholder</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="user@email.com"/>
      </label>
      <?php $metabox->the_field('form-company-placeholder'); ?>
      <label><p>Form Company Placeholder</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="XYZ Company"/>
      </label>
      <?php $metabox->the_field('form-country-placeholder'); ?>
      <label><p>Form Country Placeholder</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="United States"/>
      </label>
      <?php $metabox->the_field('form-phone-placeholder'); ?>
      <label><p>Form Phone Placeholder</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="444-222-1111"/>
      </label>
      <?php $metabox->the_field('form-submit-wait'); ?>
      <label><p>Form Submit Button Wait Message</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Please Wait..."/>
      </label>
      <?php $metabox->the_field('form-error'); ?>
      <label><p>Form Error Message</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="You missed %n fields. They have been highlighted."/>
      </label>
      <?php $metabox->the_field('form-thankyou-description'); ?>
      <label><p>Form Thank You Description</p>
        <textarea name="<?php $metabox->the_name(); ?>" rows="3" placeholder="We have received your information. Your copy of the Forrester Wave report is now downloading. %a Click here %b if the download has not started."><?php $metabox->the_value(); ?></textarea>
      </label>
      <?php $metabox->the_field('form-required-fields'); ?>
      <label><p>Form Required Fields Title</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="Required Fields" />
      </label>
      <?php $metabox->the_field('page-global-companies-link'); ?>
      <label><p>View Case Studies Link Text</p>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" placeholder="View Case Studies"/>
      </label>

    </div>
  </div>
  <div class="row cf">
      <?php $metabox->the_field('page-tracking-scripts');
            $val = $metabox->get_the_value('page-tracking-scripts');
    ?>

      <label><p>Tracking Scripts</p>
        <textarea name="<?php $metabox->the_name(); ?>" rows="10"><?php echo $val; ?></textarea>
      </label>

  </div>
</div>