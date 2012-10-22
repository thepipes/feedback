<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

$is_featured_client = get_post_meta( $client_id, 'yam_is_featured_client', true);
$quote_header = get_post_meta( $client_id, 'yam_quote_header', true);
$quote_subheader = get_post_meta( $client_id, 'yam_quote_subheader', true);
$quote_text = get_post_meta( $client_id, 'yam_quote_text', true);
$add_quotes = get_post_meta( $client_id, 'yam_add_quotes', true);
$bottom_text = get_post_meta( $client_id, 'yam_bottom_text', true);
$bottom_link = get_post_meta( $client_id, 'yam_bottom_link', true);

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
    if ( !empty( $quote_header[$quote_id] ) ) {
      echo '<p class="quote-header"><span class="bold">';
      echo $quote_header[$quote_id];
      echo '</span></p>';
    }
    ?>

    <?php
    if ( !empty( $quote_subheader[$quote_id] ) ) {
      echo '<p class="quote-title">';
      echo $quote_subheader[$quote_id];
      echo "</p>";
    }
    ?>

    <?php if ($add_quotes[$quote_id] == "YES") { ?>
    <img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/quotation-small.png" />
    <blockquote class="quote-text grid3"><?php echo $quote_text[$quote_id]; ?><img class="quotation-image-end" src="<?php echo get_template_directory_uri(); ?>/img/quotation-small-end.png" /></blockquote>
    <?php } else { ?>
    <p class="quote-text grid3"><?php echo $quote_text[$quote_id]; ?></p>
    <?php } ?>

    <?php
    if ( !empty( $bottom_text[$quote_id] ) ) {
      echo '<p class="quote-link grid3">';
      echo '<a href="'.$bottom_link[$quote_id].'">';
      echo $bottom_text[$quote_id];
      echo '</a>';
      echo "</p>";
    }
    ?>
  </div>
<?php echo $after_widget; ?>

</div>