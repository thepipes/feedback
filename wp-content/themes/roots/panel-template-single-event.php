<?php
$event_start_date = date_create(get_post_meta( get_the_ID(), 'yam_event_start_date', true));
$event_end_date = get_post_meta( get_the_ID(), 'yam_event_end_date', true);
if (!empty($event_end_date)):
  $event_end_date = date_create($event_end_date);
endif;
$registration_link = get_post_meta( get_the_ID(), 'yam_registration_link', true);
$event_location = get_post_meta( get_the_ID(), 'yam_event_location', true);
?>
<article>

  <?php $imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
  <?php if (!empty($imageURL)): ?>
  <img src="<?php echo $imageURL[0]; ?>" class="post-thumbnail" />
              <div class="post-listing">
            <?php endif; ?>

  <h4><?php the_title(); ?></h4>

  <p class="post-date"><?php echo date_format($event_start_date, "F d, Y"); ?><?php echo ($event_end_date) ? ' - '.date_format($event_end_date, "F d, Y") : ''; ?></p>

  <?php if (!empty($registration_link)): ?>
  <p class="registration-link"><a href="<?php echo $registration_link; ?>" >Register</a></p>
  <?php endif; ?>

  <?php if (!empty($event_location)): ?>
  <p class="event-location"><?php echo nl2br($event_location); ?></p>
  <?php endif; ?>


  <?php the_content(); ?>

  <?php if (!empty($imageURL)): ?>
            </div>
            <?php endif; ?>
</article>