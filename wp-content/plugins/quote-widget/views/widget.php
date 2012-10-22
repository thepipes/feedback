<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
?>
<div class="row">
<?php
echo str_replace("{{panel}}", 'quote-right', $before_widget);
if ( !empty( $image ) ) {
	if ( $imageurl ) {
		echo '<img class="top-image" src="'.esc_url($imageurl).'" />';
	}
}
?>
  <div class="grid4 quote-container">

    <?php
    if ( !empty( $quote_header ) ) {
      echo '<p class="quote-header"><span class="bold">';
      echo $quote_header;
      echo '</span></p>';
    }
    ?>

    <?php
    if ( !empty( $quote_subheader ) ) {
      echo '<p class="quote-title">';
      echo $quote_subheader;
      echo "</p>";
    }
    ?>

    <?php if ($add_quotes == "YES") { ?>
    <img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/quotation-small.png" />
    <blockquote class="quote-text grid3"><?php echo $quote_text; ?><img class="quotation-image-end" src="<?php echo get_template_directory_uri(); ?>/img/quotation-small-end.png" /></blockquote>
    <?php } else { ?>
    <p class="quote-text grid3"><?php echo $quote_text; ?></p>
    <?php } ?>

    <?php
    if ( !empty( $bottom_link_text ) ) {
      echo '<p class="quote-link grid3">';
      echo '<a href="'.$bottom_link.'">';
      echo $bottom_link_text;
      echo '</a>';
      echo "</p>";
    }
    ?>
  </div>
<?php echo $after_widget; ?>

</div>