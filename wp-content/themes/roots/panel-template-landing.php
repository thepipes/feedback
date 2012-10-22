<?php
/*
* TEMPLATE PART: landing-template
* DESCRIPTION: reusable panel sections of product template using productfeatures metabox
*/

//get the custom field values and prepare to iterate thru to create the panels
  $headings = get_post_meta( get_the_ID(), 'yam_feature_heading', true );
  $images = get_image_urls( get_the_ID(), 'yam_images');
  $captions = get_post_meta( get_the_ID(), 'yam_caption', true );
  $headingsCount = count($headings) - 1;
  $count = 0;
  $popout = get_post_meta( get_the_ID(), 'yam_pop_out', false );
  $cta_btn_color = get_post_meta( get_the_ID(), 'yam_cta_color', true);
  $cta_btn_url = get_post_meta( get_the_ID(), 'yam_cta_url', true);
  $cta_btn_textcopy = get_post_meta( get_the_ID(), 'yam_cta_textcopy', true);
  $cta_link_on = get_post_meta(get_the_ID(), 'yam_ctalink_on', true);
  $cta_link_url = get_post_meta(get_the_ID(), 'yam_ctalink_url', true);
  $cta_link_text = get_post_meta(get_the_ID(), 'yam_ctalink_text', true);
?>
<?php
//LOOP FOR PANELS
while ($count <= $headingsCount) :
// prep data
  $cta_btn_on = 1;
  switch ($cta_btn_color[$count]) {
    case 0: $cta_btn_class = ''; break;
    case 1: $cta_btn_class = 'yj-btn-orange'; break;
    case 2: $cta_btn_class = 'yj-btn-alt'; break;
    case 3: $cta_btn_class = 'yj-btn-green'; break;
    case 4: $cta_btn_on = 0; break;
    break;
  }
// init Mustache & prepand data
  $mustache = new Mustache;
  $template = <<<TPL
    {{&headings}}
    {{&captions}}
    {{#cta_btn_on}}<p><a href="{{cta_btn_url}}" class="yj-btn yj-btn-landing {{cta_btn_class}}">{{cta_btn_textcopy}}</a></p>{{/cta_btn_on}}
    {{#cta_link_on}}<p><a href="{{cta_link_url}}">{{cta_link_textcopy}} <span class="arrow-right"></span></a></p>{{/cta_link_on}}
TPL;
  $data = array(
      'headings' => $headings[$count],
      'captions' => $captions[$count],
      'cta_btn_on'  => ($cta_btn_on) ? 1 : '',
      'cta_btn_class' => $cta_btn_class,
      'cta_btn_url' => $cta_btn_url[$count],
      'cta_btn_textcopy' => $cta_btn_textcopy[$count],
      'cta_link_on' => ($cta_link_on[$count]) ? 1 : '',
      'cta_link_url' => empty($cta_link_url[$count]) ? '#' : ($cta_link_url[$count]),
      'cta_link_textcopy' => $cta_link_text[$count]
  )

    ?>
<div class="row panel-container <?php echo ($count == $headingsCount)? 'panel-last' : '';?>">
        <?php
        //check if odd or even and use this to style the panels (text left or right)
        $even = ($count % 2 == 0);
        //check if first panel, add css class if so
        ?>
        <div class="panel-wrapper panel-wrapper-full grid12 raised <?php echo $headingsCount==1 ?  "panel1" :  ""; ?>">
            <div class="panel panel-full panel-landing">
                <?php if ($even) :?>
                <div class="grid5 panel-headings">
                    <?php echo $mustache->render($template, $data) ?>
                </div>
                <?php echo ($headingsCount == $count) ? '<a href="'.$cta_btn_url[$count].'">' : ''?>
                <img class="panel-img-right" <?php echo ($count==0 && $popout[0] == "YES") ? "style='right:-30px;'" : ""; ?> src="<?php echo ($images[$count]); ?>" />
                <?php echo ($headingsCount == $count) ? '</a>' : ''?>
                <?php else : ?>
                <?php echo ($headingsCount == $count) ? '<a href="'.$cta_btn_url[$count].'">' : ''?>
                <img style="left:0px;" src="<?php echo ($images[$count]); ?>" />
                <?php echo ($headingsCount == $count) ? '</a>' : '' ?>
                <div class="grid5 push7 panel-headings panel-headings-right">
                    <?php echo $mustache->render($template, $data) ?>
                </div>
                <?php endif; ?>
                <div class="warp"></div>
            </div>
        </div>
</div>
<?php
    $count++;
endwhile; ?>