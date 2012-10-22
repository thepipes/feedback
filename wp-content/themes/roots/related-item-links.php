<?php
/*
* TEMPLATE PART: related-items-links
* DESCRIPTION: reusable section of case studies template using related links metabox listing out related links
*/

$link_titles = get_post_meta( get_the_ID(), 'yam_link_titles', true );
$links = get_post_meta( get_the_ID(), 'yam_links', true );
$count = 0;

// Templates
$m = new Mustache;
$item_template = <<<TPL
  <li class="related-link{{^count}} first{{/count}}">
    {{#link}}<a href="{{link}}">{{link_title}}</a>{{/link}}
    {{^link}}{{link_title}}{{/link}}
  </li>
TPL;
?>
<?php
//LOOP FOR RELATED LINKS
?>

<?php if (count($link_titles) >=1 ) : ?>
<div class="related-items links">
  <div class="row section-title">
    <h4 class="grid12"><?php _e('Related Links'); ?></h4>
  </div>
  <div class="row">
    <ul class="grid12 related-links-container">
    <?php while ($count < (count($link_titles))) :
      echo $m->render($item_template, array(
        'count' => $count,
        'link' => $links[$count],
        'link_title' => $link_titles[$count]
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
      <?php endif; ?>
  </div>
</div>
<?php endif; ?>