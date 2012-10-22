<?php
/*
* TEMPLATE PART: quote-right
* DESCRIPTION: reusable quote code on top of page
*/

$quote_header = get_post_meta( get_the_ID(), 'yam_quote_header', true);
$quote_header = array_filter($quote_header, 'strlen');
$quote_subheader = get_post_meta( get_the_ID(), 'yam_quote_subheader', true);
$quote_text = get_post_meta( get_the_ID(), 'yam_quote_text', true);
$quote_text = array_filter($quote_text, 'strlen');
$add_quotes = get_post_meta( get_the_ID(), 'yam_add_quotes', true);
$bottom_text = get_post_meta( get_the_ID(), 'yam_bottom_text', true);
$bottom_link = get_post_meta( get_the_ID(), 'yam_bottom_link', true);
$count = 0;
?>

<div class="row">
  <?php while (count($quote_text)-1 >= $count): ?>
  <div class="grid4 quote-right">
    <div class="grid4 quote-container">

      <?php if ($add_quotes[$count] == "YES") { ?>
      <img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/quotation-small.png" />
      <blockquote class="quote-text grid3"><?php echo $quote_text[$count]; ?><img class="quotation-image-end" src="<?php echo get_template_directory_uri(); ?>/img/quotation-small-end.png" /></blockquote>
      <?php } else { ?>
      <p class="quote-text grid3"><?php echo $quote_text[$count]; ?></p>
      <?php } ?>

      <?php
      if ( !empty( $bottom_text[$count] ) ) {
        echo '<p class="quote-link grid3">';
        if ( !empty( $bottom_link[$count] ) ) {
          echo '<a href="'.$bottom_link[$count].'">';
        }
        echo $bottom_text[$count];
        if ( !empty( $bottom_link[$count] ) ) {
          echo '</a>';
        }
        echo "</p>";
      }
      ?>

      <?php
      if ( !empty( $quote_header[$count] ) ) {
        echo '<p class="quote-header grid3"><span class="bold">';
        echo $quote_header[$count];
        echo '</span></p>';
      }
      ?>

      <?php
      if ( !empty( $quote_subheader[$count] ) ) {
        echo '<p class="quote-title grid3">';
        echo $quote_subheader[$count];
        echo "</p>";
      }
      ?>
    </div>
  </div>
  <?php
  $count++;
  endwhile;
  ?>
</div>

