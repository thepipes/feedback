<?php
/*
* TEMPLATE PART: feature-list-template
* DESCRIPTION: reusable panel sections of product template using FeatureList metabox
*/
?>
<?php
global $features_mb;
$m = new Mustache;

//LOOP FOR PANELS
$mb = $features_mb;
$mb->the_meta(); // get the meta data for the current post

$item_template = <<<TPL
      {{#even}}<div class="row">{{/even}}
        <div class="grid6 feature">
          {{#icon}}<img src="{{icon}}" />{{/icon}}
          <p class="name">
            {{#link}}<a href="{{link}}"{{#external}} target="_blank" onClick="_gaq.push(['_trackEvent', 'Outbound', 'Feature List', '{{name}}']);" {{/external}}>{{/link}}{{name}}{{#link}}</a>{{/link}}
          </p>
          <p class="description">{{description}}</p>
        </div>
      {{^even}}</div>{{/even}}
TPL;

$panel_template = <<<TPL
{{#items}}
<div class="row panel-container features-panel {{isLast}}" id="{{anchor}}">
  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">
      <h3>{{#icon}}<img src="{{icon}}" />{{/icon}}{{#title_link}}<a href="{{title_link}}">{{/title_link}}{{title}}{{#title_link}}</a>{{/title_link}}</h3>
      {{{items}}}
    </div>
  </div>
</div>
{{/items}}
TPL;

  $number_features = $mb->get_the_value('number-features');
  if($number_features == '' || $number_features < 0){
    $number_features = 7; // Default number of features to 7 for backward compatibility with production.
  }
    $order_array = array();
    $new_order_array = array();
    for ($i=1; $i <= $number_features; $i++){
      $current_order = $mb->get_the_value('meta-number'.$i);
      $index_number  = $mb->get_the_value('index-order'.$i);

      if($current_order == ""){
        $current_order = $i;
      }
      if($index_number == ""){
        $index_number = $i;
      }

      $order_array[$index_number] = $current_order;
    }

    arsort($order_array, SORT_NUMERIC);

  for ($i = 1; $i <= count($order_array); $i++ ) {

  $count = 0;
  $items = '';
 
  while($mb->have_fields('features'.$order_array[$i])) {
    $items .= $m->render($item_template, array(
      'icon' => $mb->get_the_value('icon'),
      'name' => $mb->get_the_value('name'),
      'description' => $mb->get_the_value('description'),
      'link' => $mb->get_the_value('link'),
      'external' => $mb->get_the_value('external'),
      'even' => ($count % 2 == 0)
    ));
    $count++;
  }
  if ($count % 2 > 0) {
    $items .= '</div>';
  }
  $last ='';
  if ($i == $number_features) { $last ='panel-last'; }
  echo $m->render($panel_template, array(
    'title' => $mb->get_the_value('title'.$order_array[$i]),
    'title_link' => $mb->get_the_value('title_link'.$order_array[$i]),
    'icon' => $mb->get_the_value('section'.$order_array[$i].'icon'),
    'items' => $items,
    'anchor' => strtolower(str_replace(" ","-",$mb->get_the_value('title'.$order_array[$i]))),
    'isLast' => $last
  )); 
}
?>