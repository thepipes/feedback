<?php
/*
* TEMPLATE PART: product-feature-highlights
* DESCRIPTION: reusable section of product template using productfeatures metabox listing out features
*/
$m = new Mustache;
$section_title = get_post_meta( get_the_ID(), 'yam_section_title', true );
$features = get_post_meta( get_the_ID(), 'yam_feature_highlight_name', true );
// Stripping NULL values from array to get valid count.
if (is_array($features)) {
  $features = array_filter($features, 'strlen');
}
$images = get_image_urls( get_the_ID(), 'yam_feature_highlight_images');
$links = get_post_meta( get_the_ID(), 'yam_feature_highlight_link', true );
$show_bottom_divider = get_post_meta( get_the_ID(), 'yam_show_bottom_divider', true );
$count = 0;

// Templates
$item_template = <<<TPL
  <li class="related-item{{^count}} first{{/count}}{{^last}} last{{/last}}">
    {{#image}}<img class="icon" src="{{image}}" />{{/image}}
    {{#link}}<a href="{{link}}">{{feature}}</a>{{/link}}
    {{^link}}{{feature}}{{/link}}
  </li>
TPL;
?>

<!-- Start Related Item Resources -->
<?php if (count($features) >=1 ) : ?>
<div class="related-items resources<?php echo ($show_bottom_divider == "YES") ? " bottom-border" : ""; ?>">

  <div class="row section-title">
    <h4 class="grid12"><?php _e($section_title); ?></h4>
  </div>
  <div class="row">
    <ul class="grid10">
    <?php while ($count < (count($features))) : 
      echo $m->render($item_template, array(
        'count' => $count,
        'image' => $images[$count],
        'link' => $links[$count],
        'feature' => $features[$count],
        'last' => ($count == count($features))
      ));
      $count++;
      endwhile;
    ?>
    </ul>
    <?php
    $buttonLink = get_post_meta( get_the_ID(), 'yam_feature_highlight_button_link', true );
    if(isset($buttonLink) && $buttonLink != ''):
    ?>
      <div class="grid2 actions">
        <a class="yj-btn yj-btn-alt" href="<?php echo $buttonLink; ?>"><?php echo get_post_meta( get_the_ID(), 'yam_feature_highlight_button_name', true ); ?></a>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>


<!-- End Related Item Resources -->