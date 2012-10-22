<?php
/*
* TEMPLATE PART: product-feature-highlights
* DESCRIPTION: reusable section of product template using productfeatures metabox listing out features
*/
$m = new Mustache;
$features = get_post_meta( get_the_ID(), 'yam_feature_highlight_name', true );
$images = get_image_urls( get_the_ID(), 'yam_feature_highlight_images');
$links = get_post_meta( get_the_ID(), 'yam_feature_highlight_link', true );
$count = 0;
// Templates
$item_template = <<<TPL
  <li class="related-item{{^count}} first{{/count}}">
    {{#image}}<img class="icon" src="{{image}}" />{{/image}}
     {{#link}}<a href="{{link}}">{{features}}</a>{{/link}}
    {{^link}}{{features}}{{/link}}
  </li>
TPL;
?>
<?php
//LOOP FOR FEATURES
?>
<?php if (count($features) >=1 ) : ?>
<div class="related-items feature-highlights">
  <div class="row section-title">
      <h4 class="grid12"><?php echo get_post_meta( get_the_ID(), 'yam_section_title', true ); ?></h4>
  </div>
  <div class="row">
    <ul class="grid10">
    <?php while ($count < (count($features))) :
      echo $m->render($item_template, array(
        'count' => $count, 
        'image' => $images[$count],
        'link'  => $links[$count],
        'features' => $features[$count]
      ));
      $count++;
      endwhile;
    ?>
    </ul>
    <?php
      $buttonLink = get_post_meta( get_the_ID(), 'yam_feature_highlight_button_link', true );
      $buttonText = get_post_meta( get_the_ID(), 'yam_feature_highlight_button_name', true );
      if(isset($buttonLink) && $buttonLink != '' && isset($buttonText) && $buttonText != ''):
    ?>
        <div class="grid2 actions">
          <a class="yj-btn yj-btn-alt" href="<?php echo $buttonLink; ?>"><?php echo $buttonText; ?></a>
        </div>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>