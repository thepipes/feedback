<?php
/*
* TEMPLATE PART: quote-right
* DESCRIPTION: reusable quote code on top of page
*/

$client_id = get_post_meta( get_the_ID(), 'yam_client_id_for_quote', true);
$quote_id = get_post_meta( get_the_ID(), 'yam_selected_quote_id', true);
$images = get_image_urls( get_the_ID(), 'yam_quote_image');
$quote_header = get_post_meta( $client_id, 'yam_quote_header', true);
$quote_subheader = get_post_meta( $client_id, 'yam_quote_subheader', true);
$quote_text = get_post_meta( $client_id, 'yam_quote_text', true);
$add_quotes = get_post_meta( $client_id, 'yam_add_quotes', true);
$bottom_text = get_post_meta( $client_id, 'yam_bottom_text', true);
$bottom_link = get_post_meta( $client_id, 'yam_bottom_link', true);
?>
<div class="row">
  <div class="grid4 quote-right">
      <?php echo (count($images) > 0)? '<img class="top-image" src="'. $images[0] .'" />' : '' ; ?>
    <div class="grid4 quote-container">

      <?php
      if ( !empty( $quote_header[$quote_id] ) ) {
        echo '<p class="quote-header grid3"><span class="bold">';
        echo $quote_header[$quote_id];
        echo '</span></p>';
      }
      ?>

      <?php
      if ( !empty( $quote_subheader[$quote_id] ) ) {
        echo '<p class="quote-title grid3">';
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
        if ( !empty( $bottom_link[$quote_id] ) ) {
          echo '<a href="'.$bottom_link[$quote_id].'">';
        }
        echo $bottom_text[$quote_id];
        if ( !empty( $bottom_link[$quote_id] ) ) {
          echo '</a>';
        }
        echo "</p>";
      }
      ?>
    </div>
  </div>
</div>

