<?php
/*
* TEMPLATE PART: quote-top
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

<?php if(isset($quote_text[$quote_id]) && $quote_text[$quote_id] != '') : ?>
<div class="row quote-top-row">
  <div class="grid12 quote-top">
    <img class="quote-image" src="<?php echo $images[0];?>" />
    <div class="row">
      <div class="grid10 push2 quote-container">
        <?php if ($add_quotes[$quote_id] == "YES") { ?>
        <img class="quotation-image" src="<?php echo get_template_directory_uri(); ?>/img/quotation.png" />
          <blockquote class="quote-text"><?php echo $quote_text[$quote_id]; ?>"
        <?php } else { ?>
          <blockquote class="quote-text"><?php echo $quote_text[$quote_id]; ?>
        <?php }?>
        <p class="quote-header"><span class="quote-header"><?php echo $quote_header[$quote_id]; ?></span>, <span class="quote-subheader"><?php echo $quote_subheader[$quote_id]; ?></span></p>
      </blockquote>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>