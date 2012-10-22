<?php
/*
Template Name: Management
*/
get_header(); ?>

<?php roots_content_before(); ?>
<?php roots_main_before(); ?>

<?php get_template_part( 'heading' );           // heading section (heading.php) ?>

<?php roots_loop_before(); ?>

<?php

global $management_mb;
$m = new Mustache;

//LOOP FOR PANELS
$mb = $management_mb;
$mb->the_meta(); // get the meta data for the current post

$item_template = <<<TPL
  <div class="row">
    <div class="grid2">
     {{#mugshot}}<img src="{{mugshot}}" />{{/mugshot}}
    </div>
    <div class="grid9">
      <h4>{{name}}</h4>
      <p class="subheading">{{title}}</p>
      {{&bio}}
    </div>
  </div>
  {{#isLast}}<hr/>{{/isLast}}
TPL;

$panel_template = <<<TPL
{{#items}}
<div class="row panel-container full-width {{#lastPanel}}panel-last{{/lastPanel}}">
  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">
      <div class="row">
        <div class="inner-full-width management-panel">
          {{#title}}<h3>{{title}}</h3>{{/title}}
          {{{items}}}
        </div>
      </div>
    </div>
  </div>
</div>
{{/items}}
TPL;

for($i = 1; $i <= 2; $i++) {
  $count = 0;
  $rows = array();
  $items = '';
  while($mb->have_fields('management'.$i)) {
    $name = $mb->get_the_value('name');
    $fname = array_shift(explode(' ',$name));
    $rows[$mb->get_the_value('order').$fname] = array(
      'name' => $name,
      'mugshot' => $mb->get_the_value('mugshot'),
      'bio' => wpautop($mb->get_the_value('bio')),
      'title' => $mb->get_the_value('title'),
      'isLast' => '1'
    );
  }
  if (ksort($rows)) {
    $last_el = array_pop($rows);
    $last_el['isLast'] = '';
    $rows[] = $last_el;  
    foreach($rows as $value) {
      $items .= $m->render($item_template, $value);
    }
  }
 if ($i == 2) { $lastPanel = '1';} else { $lastPanel ='';}
  echo $m->render($panel_template, array(
    'title' => $mb->get_the_value('name'.$i),
    'items' => $items,
    'lastPanel'=> $lastPanel
  )); 
}

?>
<?php get_template_part('back', 'top'); // template for displaying back to top anchor link ?>

<?php get_template_part( 'bottom-cta' );  // dynamic bottom cta section (bottom-cta.php) ?>

<?php roots_loop_after(); ?>

</div><!-- /#main, closing of heading -->
<?php roots_main_after(); ?>

</div><!-- /#content, closing of heading -->
<?php roots_content_after(); ?>
<?php get_footer(); ?>
