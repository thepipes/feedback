<?php // https://github.com/retlehs/roots/wiki

/*******************************************************************************
 * ROOTS THEME CONFIGS, NO TOUCH!
 */
if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));

require_once locate_template('/inc/roots-activation.php');  // activation
require_once locate_template('/inc/roots-options.php');     // theme options
require_once locate_template('/inc/roots-cleanup.php');     // cleanup
require_once locate_template('/inc/roots-scripts.php');     // modified scripts output
require_once locate_template('/inc/roots-htaccess.php');    // rewrites for assets, h5bp htaccess
require_once locate_template('/inc/roots-hooks.php');       // hooks
require_once locate_template('/inc/roots-actions.php');     // actions
require_once locate_template('/inc/roots-widgets.php');     // widgets
require_once locate_template('/inc/roots-custom.php');      // custom functions
require_once locate_template('/inc/Mustache.php');          // Mustache template
require_once locate_template('/inc/metaboxes.php');         // Metaboxes functions

// WPAlchemy includes
include_once locate_template('/metaboxes/setup.php');
include_once locate_template('/metaboxes/features-spec.php');
include_once locate_template('/metaboxes/management-spec.php');
include_once locate_template('/metaboxes/pricing-spec.php');
include_once locate_template('/metaboxes/pricing-plans-spec.php');
include_once locate_template('/metaboxes/simple-list-spec.php');
include_once locate_template('/metaboxes/simple-list-no-title-spec.php');
include_once locate_template('/metaboxes/meta-setup-spec.php');
//include_once locate_template('/metaboxes/case-study-selection-spec.php');


$roots_options = roots_get_theme_options();

// set the maximum 'Large' image width to the maximum grid width
// http://wordpress.stackexchange.com/q/11766
if (!isset($content_width)) {
  global $roots_options;
  $roots_css_framework = $roots_options['css_framework'];
  switch ($roots_css_framework) {
    case 'blueprint':   $content_width = 950;   break;
    case '960gs_12':    $content_width = 940;   break;
    case '960gs_16':    $content_width = 940;   break;
    case '960gs_24':    $content_width = 940;   break;
    case '1140':        $content_width = 1140;  break;
    case 'adapt':       $content_width = 940;   break;
    case 'bootstrap':   $content_width = 940;   break;
    case 'foundation':  $content_width = 980;   break;
    default:            $content_width = 950;   break;
  }
}

function roots_setup() {
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // tell the TinyMCE editor to use editor-style.css
  // if you have issues with getting the editor to show your changes then
  // use this instead: add_editor_style('editor-style.css?' . time());
  add_editor_style('editor-style.css');

  // http://codex.wordpress.org/Post_Thumbnails
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);

  // http://codex.wordpress.org/Post_Formats
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
    'footer_navigation' => __('Footer Navigation', 'roots'),
    'sales_menu'         => __('Sales Menu', 'roots')
  ));

}

add_action('after_setup_theme', 'roots_setup');

// http://codex.wordpress.org/Function_Reference/register_sidebar
function roots_register_sidebars() {
  $sidebars = array('Sidebar', 'Footer');

  foreach($sidebars as $sidebar) {
    register_sidebar(
      array(
        'id'            => 'roots-' . sanitize_title($sidebar),
        'name'          => __($sidebar, 'roots'),
        'description'   => __($sidebar, 'roots'),
        'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="container">',
        'after_widget'  => '</div></article>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
      )
    );
  }
}

add_action('widgets_init', 'roots_register_sidebars');

add_action('roots_footer', 'yammer_crazy_egg');

function yammer_crazy_egg() {
  echo "\n\t<script>\n";
  echo "\t\tsetTimeout(function(){var a=document.createElement(\"script\"); var b=document.getElementsByTagName('script')[0]; a.src=document.location.protocol+\"//dnn506yrbagrg.cloudfront.net/pages/scripts/0012/1513.js?\"+Math.floor(new Date().getTime()/3600000); a.async=true;a.type=\"text/javascript\";b.parentNode.insertBefore(a,b)}, 1);\n";
  echo "\t</script>\n";
}

add_action('roots_footer', 'yammer_adroll');

function yammer_adroll() {
  echo "\n\t<script>\n";
  echo "\t\tadroll_adv_id = \"BUIR53QGUNCHPAA5IDCCTB\"; adroll_pix_id = \"5EWZRLDA4NDSLFONDMVGDZ\";(function () {var oldonload = window.onload; window.onload = function(){__adroll_loaded=true;var scr = document.createElement(\"script\");var host = ((\"https:\" == document.location.protocol) ? \"https://s.adroll.com\" : \"http://a.adroll.com\");scr.setAttribute('async', 'true');scr.type = \"text/javascript\";scr.src = host + \"/j/roundtrip.js\";((document.getElementsByTagName('head') || [null])[0] ||document.getElementsByTagName('script')[0].parentNode).appendChild(scr);   if(oldonload){oldonload()}};}());\n";
  echo "\t</script>\n";
}



add_action('roots_footer', 'yammer_kissinsights');

function yammer_kissinsights() {
  echo "\n\t<script type=\"text/javascript\">var _kiq = _kiq || [];</script>\n";
  echo "\n\t<script type=\"text/javascript\" src=\"//s3.amazonaws.com/ki.js/26627/5gE.js\" async=\"true\"></script>\n";
}

// return post entry meta information
function roots_entry_meta() {
  echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s at %s.', 'roots'), get_the_date(), get_the_time()) .'</time>';
  echo '<p class="byline author vcard">'. __('Written by', 'roots') .' <a href="'. get_author_posts_url(get_the_author_meta('id')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}

/********************************************************************************
 * END OF ROOTS THEME STUFF
 */


/*
 * YAMMER Specific Stuff Below
 */

/** Image sizes definitions */
add_image_size( 'customer-logo-featured-list', 124, 84 );
add_image_size( 'customer-logo-case-studies', 230, 100 );
add_image_size( 'customer-logo-related-case-studies', 150, 250 );
add_image_size( 'customer-logo-customer-success', 180, 250 );
add_image_size( 'customer-logo-post-listing-thumbnail', 188, 100 );
add_image_size( 'case-study-overview', 100, 100 );
add_image_size( 'video-link-thumbnail', 380, 214 );
/*
 * Function for retreiving images in correct order from meta boxes
 */

function get_image_urls($ID, $fieldID, $size = 'full') {
  global $wpdb, $post;

  $imageURLS = array();

  $meta = get_post_meta( $ID, $fieldID, false );
  if ( !is_array( $meta ) )
      $meta = ( array ) $meta;

  if ( !empty( $meta ) ) {
      $meta = implode( ',', $meta );
      $images = $wpdb->get_col( "
          SELECT ID FROM $wpdb->posts
          WHERE post_type = 'attachment'
          AND ID IN ( $meta )
          ORDER BY menu_order ASC
      " );
      foreach ( $images as $att ) {
          // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
          $src = wp_get_attachment_image_src( $att, $size );
          $src = $src[0];

          // add image src to aray
          $imageURLS[] = $src;
      }
  }

  return $imageURLS;
}

/*
 * Function for initializing the case study post type
 */

function case_study_setup(){
  register_post_type('casestudies', array(
      'description' => 'Case Study custom post type',
      'show_ui' => true,
      'menu_position' => 5,
      'exclude_from_search' => false,
      'labels' => array(
          'name' => 'Case Studies',
          'singular_name' => 'Case Study',
          'add_new' => 'Add New Case Study',
          'add_new_item' => 'Add New Case Study',
          'edit' => 'Edit Case Study',
          'edit_item' => 'Edit Case Study',
          'new_item' => 'New Case Study',
          'view' => 'View Case Study',
          'view_item' => 'View Case Study',
          'search_items' => 'Search Case Studies',
          'not_found' => 'No Case Study Found',
          'not_found_in_trash' => 'No Case Studies found in trash',
          'parent' => 'Parent Case Study'
      ),
      'supports' => array('title', 'revisions', 'thumbnail', 'page-attributes'),
      'public' => true,
      'rewrite' => array('slug' => 'customers/casestudies', 'with_front' => false),
      'taxonomies' => array('category'),
      'menu_icon' => get_home_url() .'/wp-content/themes/roots/img/yammer-icon.png',
  ));
}

function product_features_setup(){
  register_post_type('productfeatures', array(
      'description' => 'Product Features custom post type',
      'show_ui' => true,
      'menu_position' => 5,
      'exclude_from_search' => false,
      'labels' => array(
          'name' => 'Product Features',
          'singular_name' => 'Product Feature',
          'add_new' => 'Add New Product Feature',
          'add_new_item' => 'Add New Product Feature',
          'edit' => 'Edit Product Feature',
          'edit_item' => 'Edit Product Feature',
          'new_item' => 'New Product Feature',
          'view' => 'View Product Feature',
          'view_item' => 'View Product Feature',
          'search_items' => 'Search Product Features',
          'not_found' => 'No Product Feature Found',
          'not_found_in_trash' => 'No Product Features found in trash',
          'parent' => 'Parent Product Feature'
      ),
      'supports' => array('title', 'revisions', 'thumbnail', 'page-attributes'),
      'public' => true,
      'rewrite' => array('slug' => 'product/features', 'with_front' => false),
      'taxonomies' => array('category'),
      'menu_icon' => get_home_url() .'/wp-content/themes/roots/img/yammer-icon.png',
      ));
}

function solutions_setup(){
    register_post_type('solutions', array(
        'description' => 'Solutions custom post type',
        'show_ui' => true,
        'menu_position' => 5,
        'exclude_from_search' => false,
        'labels' => array(
            'name' => 'Solutions',
            'singular_name' => 'Solution',
            'add_new' => 'Add Solution',
            'add_new_item' => 'Add Solution',
            'edit' => 'Edit Solution',
            'edit_item' => 'Edit Solution',
            'new_item' => 'New Solution',
            'view' => 'View Solution',
            'view_item' => 'View Solution',
            'search_items' => 'Search Solutions',
            'not_found' => 'No Solutions Found',
            'not_found_in_trash' => 'No Solutions found in trash',
            'parent' => 'Parent Solution'
        ),
        'supports' => array('title', 'revisions', 'thumbnail', 'page-attributes'),
        'public' => true,
        'rewrite' => array('slug' => 'solutions', 'with_front' => false),
        'taxonomies' => array('category'),
        'menu_icon' => get_home_url() .'/wp-content/themes/roots/img/yammer-icon.png',
    ));
}

/*
 * Function for initializing the Enterprise IT post type
 */

function enterprise_setup(){
    register_post_type('enterpriseit', array(
        'description' => 'Enterprise IT custom post type',
        'show_ui' => true,
        'menu_position' => 5,
        'exclude_from_search' => false,
        'labels' => array(
            'name' => 'Enterprise IT',
            'singular_name' => 'Enterprise IT',
            'add_new' => 'Add Enterprise IT',
            'add_new_item' => 'Add Enterprise IT',
            'edit' => 'Edit Enterprise IT',
            'edit_item' => 'Edit Enterprise IT',
            'new_item' => 'New Enterprise IT',
            'view' => 'View Enterprise IT',
            'view_item' => 'View Enterprise IT',
            'search_items' => 'Search Enterprise IT',
            'not_found' => 'No Enterprise IT Found',
            'not_found_in_trash' => 'No Enterprise IT found in trash',
            'parent' => 'Parent Enterprise IT'
        ),
        'supports' => array('title', 'editor', 'revisions', 'thumbnail', 'page-attributes'),
        'public' => true,
        'rewrite' => array('slug' => 'it', 'with_front' => false),
        'taxonomies' => array('category'),
        'menu_icon' => get_home_url() .'/wp-content/themes/roots/img/yammer-icon.png',
    ));
}

function clients_setup(){
    register_post_type('clients', array(
        'description' => 'Customers custom post type',
        'show_ui' => true,
        'menu_position' => 3,
        'exclude_from_search' => false,
        'labels' => array(
            'name' => 'Customers',
            'singular_name' => 'Customers',
            'add_new' => 'Add Customer',
            'add_new_item' => 'Add Customer',
            'edit' => 'Edit Customer',
            'edit_item' => 'Edit Customer',
            'new_item' => 'New Customer',
            'view' => 'View Customer',
            'view_item' => 'View Customer',
            'search_items' => 'Search Customer',
            'not_found' => 'No Customers Found',
            'not_found_in_trash' => 'No Customers found in trash',
            'parent' => 'Parent Customer'
        ),
        'supports' => array('title', 'revisions', 'thumbnail', 'page-attributes'),
        'public' => true,
        'rewrite' => array('slug' => 'customer', 'with_front' => true),
        'taxonomies' => array('category'),
        'menu_icon' => get_home_url() .'/wp-content/themes/roots/img/yammer-icon.png',
    ));
}

function my_scripts_method() {

    wp_register_style( 'yam-featured-logo-metabox-css', get_bloginfo("template_url") . '/css/admin-metabox.css');
    wp_enqueue_style('yam-featured-logo-metabox-css');

    echo '<script type="text/javascript">var templateUrl = "'.get_bloginfo("template_url").'";</script>';

}

add_action('admin_print_styles-post.php', 'my_scripts_method');
add_action( 'admin_print_styles-post-new.php', 'my_scripts_method' );
add_action( 'add_meta_boxes', 'add_featured_customers_metabox' );

//register a new metabox in pages to order customer logos
function add_featured_customers_metabox(){
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
  if ($template_file == "page-customer-overview.php" || $template_file == "page-featured-customers.php"):
    add_meta_box('yam_featured_customers_logo_order_mb', 'Featured Customers Order', 'featured_customers_order_mb', 'page');
  endif;
  if ($template_file == "page-landing-menu.php"):
    add_meta_box('yam_case_study_selection_mb', 'Case Study Selection', 'case_study_selection_mb', 'page');
  endif;
}
//function for displaying what will be inside the metabox. This is call in the method above in add_meta_box
function featured_customers_order_mb () {
    //get_template_part( 'panel-template', 'featured-clients-logo-list' );  // display the featured client logos from this template
    include_once(get_stylesheet_directory() . '/metaboxes/featured-clients-logo-list.php');
}
function case_study_selection_mb(){
  include_once(get_stylesheet_directory() . '/metaboxes/case-study-selection-meta.php');
}


/*
 * Function to setup all the yammer specific theme customizaations
*/

function yammer_setup(){
  case_study_setup();
  product_features_setup();
  solutions_setup();
  sidebars_setup();
  enterprise_setup();
  clients_setup();
  create_industry_taxonomy();
}

add_action('after_setup_theme', 'yammer_setup');

/*
 *  Function to add all Yammer specific side bars.
 */
function sidebars_setup() {
  if (function_exists('register_sidebar')):
    register_sidebar(array(
      'name'=> 'Jobs Sidebar',
      'id' => 'jobs_sidebar',
      'before_widget' => '<div class="grid4 panel-right">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name'=> 'Press Center Sidebar',
      'id' => 'press_center_sidebar',
      'before_widget' => '<div class="grid4 panel-right">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name'=> 'Customer Blogs Sidebar',
      'id' => 'customer_blogs_sidebar',
      'before_widget' => '<div class="grid4 panel-right">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name'=> 'News Sidebar',
      'id' => 'news_sidebar',
      'before_widget' => '<div class="grid4 panel-right">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name'=> 'Events Sidebar',
      'id' => 'events_sidebar',
      'before_widget' => '<div class="grid4 panel-right">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
    ));
    register_sidebar(array(
        'name'=> 'Enterprise IT Sidebar',
        'id' => 'enterpriseit_sidebar',
        'before_widget' => '<div class="grid4 panel-right">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
  endif;
}

function yammer_contact_sales_link($class='', $label='', $type='link') {
  global $roots_options;
  $ga_sales ='';
  if($roots_options['google_analytics_id'] != ''){
    $ga_sales = '_gaq.push([\'_trackEvent\', \'CTA\', \'Contact Sales\', \'bottom-cta-contact-sales\']);';
  }
  if (empty($label)) {
    $label = _('Contact Sales');
  }
  $template = <<<TPL
<a href="/about/contact-sales" data-reveal-id="contact-sales" id="bottom-contact-sales-{{type}}" class="contact-sales {{class}}" onClick="{{ga}}">{{label}}</a>
TPL;

  $m = new Mustache;
  return $m->render($template, array('class' => $class, 'label' => $label, 'type' => $type, 'ga' => $ga_sales));
}

// Allow for single templates per category
add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-{$cat->slug}.php"; } return $t;' ));

// Modify breadcrumbs to replace category links with page links,
add_action('bcn_yammer_after_fill', 'remove_category_bc');
function remove_category_bc($trail)
{
  for($i=0;$i<count($trail->trail);$i++) {
    if (strtoupper($trail->trail[$i]->type[0]) == "CATEGORY") {
      $new_url = str_replace('/category/','/',$trail->trail[$i]->url);
      $trail->trail[$i]->set_url($new_url);
    }

  }
}


// create taxonomy "industry" for case studies
function create_industry_taxonomy() {

  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Industry', 'taxonomy general name' ),
    'singular_name' => _x( 'Industry', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Industries' ),
    'all_items' => __( 'All Industries' ),
    'parent_item' => __( 'Parent Industry' ),
    'parent_item_colon' => __( 'Parent Industry:' ),
    'edit_item' => __( 'Edit Industry' ),
    'update_item' => __( 'Update Industry' ),
    'add_new_item' => __( 'Add New Industry' ),
    'new_item_name' => __( 'New Industry Name' ),
  );

  register_taxonomy( 'customer-industry', array('clients' ), array(
    'hierarchical' => true,
    'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'customers/case-studies/industry' ),
  ));
}

// Allow for single templates per category
add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-{$cat->slug}.php"; } return $t;' ));

/* Function to get array of clients. Used to display client selection in meta boxes. */
function get_clients_dropdown() {
  $args = array( 'post_type' => 'clients', 'numberposts' => -1 );
  $clients = get_posts( $args );

  $clients_arr = array();

  foreach ($clients as $client):
    $clients_arr[$client->ID] = $client->post_title;
  endforeach;
  return $clients_arr;
}

/* Function to get array of forms. Used to display form selection in meta boxes. */
function get_forms_dropdown() {
  if (class_exists(RGForms)):
    $active = RGForms::get("active") == "" ? null : RGForms::get("active");
    $forms = RGFormsModel::get_forms($active, "title");

    $forms_arr = array();

    foreach ($forms as $form):
      $forms_arr[$form->id] = $form->title;
    endforeach;
    return $forms_arr;
  else:
    return array(-1,"Make sure Gravity forms is activated.");
  endif;
}

function get_clients_quotes($clientID) {

  return get_post_meta( $clientID, 'yam_quote_text', true);
}


function get_case_study_quote($case_study_id) {
  $client_id = get_post_meta( $case_study_id, 'yam_client_id_for_quote', true);
  $quote_id = get_post_meta( $case_study_id, 'yam_selected_quote_id', true);

  $quote_header = get_post_meta( $client_id, 'yam_quote_header', true);
  $quote_subheader = get_post_meta( $client_id, 'yam_quote_subheader', true);
  $quote_text = get_post_meta( $client_id, 'yam_quote_text', true);

  $quote = array(
    'header' => $quote_header[$quote_id],
    'subheader' => $quote_subheader[$quote_id],
    'text' => $quote_text[$quote_id]
  );

  return $quote;
}

/* Function to get array of case studies. Used to display case studies selection in meta boxes. */
function get_case_studies_array() {
  $args = array( 'post_type' => 'casestudies', 'numberposts' => -1 );
  $case_studies = get_posts( $args );

  $case_studies_arr = array();

  foreach ($case_studies as $case_study):
    $case_studies_arr[$case_study->ID] = $case_study->post_title;
  endforeach;
  return $case_studies_arr;
}

/* Function to get array of categories. Used to display category selection in meta boxes. */
function get_category_array() {
  $categories = get_categories();

  $categories_arr = array();
  foreach ($categories as $category):
    $categories_arr[$category->cat_ID] = $category->cat_name;
  endforeach;
  return $categories_arr;
}

function get_pages_array() {
  $pages = get_pages();

  $pages_arr = array();
  foreach ($pages as $page):
    $pages_arr[$page->ID] = (($page->post_parent) ? ' - ' : '').$page->post_title;
  endforeach;
  return $pages_arr;
}
// Load JS file for case studies post type only.
function case_studies_admin_js() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

  if ((get_post_type()=="casestudies" || get_post_type()=="solutions") && is_admin() || $template_file == "page-landing-menu.php") {
    wp_register_script( 'yammer-case-studies-js', get_bloginfo("template_url").'/js/yammer-case-studies.js', array('jquery'), false, true );
    wp_enqueue_script( 'yammer-case-studies-js' );
      wp_register_script( 'yammer-quote-selection', get_bloginfo("template_url").'/js/yammer-quote-selection.js', array('jquery'), false, true );
      wp_enqueue_script( 'yammer-quote-selection' );
    echo '<script type="text/javascript">var templateUrl = "'.get_bloginfo("template_url").'";var scriptUrl = "/js/load-client-quotes.php";</script>';
  }
}
add_action('admin_enqueue_scripts', 'case_studies_admin_js');

function yammer_make_realtive_bc($bc) {
  $return = str_replace(get_option('siteurl'),'', $bc);
  return ($return == '') ? '/' : $return;
}
add_filter('bcn_yammer_breadcrumb_url', 'yammer_make_realtive_bc');

// Load JS files for frontend.
function yammer_load_js() {
  $template_uri = get_template_directory_uri();
  //modernizr
  wp_enqueue_script('roots_modernizr', ''.$template_uri.'/js/libs/modernizr-2.0.6.min.js'. versionControl(), false, null, false);
  //flash detect
  wp_enqueue_script( 'flash-detect-min-js', $template_uri . '/js/flash-detect-min.js', array ( 'jquery' ), null, true );
}
add_action( 'wp_print_scripts', 'yammer_load_js' );

// Change the base search URL to /about/search instead of just /search
// Replace the casestudies with case-studies when viewing case studies
function add_yammer_rewrite_rules()
{
    $GLOBALS['wp_rewrite']->search_base = 'about/search';
    $GLOBALS['wp_rewrite']->extra_permastructs['casestudies'][0] = "customers/case-studies/%casestudies%";
    $GLOBALS['wp_rewrite']->extra_permastructs['customer-industry'][0] = "/customers/case-studies-%customer-industry%";
}
add_action( 'init', 'add_yammer_rewrite_rules' );



// Remove editor and content from all pages by default
function remove_fields_from_pages(){
  //remove_post_type_support( 'page', 'editor' );
  remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'remove_fields_from_pages' );

// Function used to rearrange the admin menu order to our needs.
function menu_order_filter($menu) {

  //Find page menu item and remove it.
  $remove_key = array_search("edit.php?post_type=page", $menu);
  unset($menu[$remove_key]);
  // Find post menu item and resinsert page menu below it.
  $find_key = array_search("edit.php", $menu);
  array_splice($menu,$find_key+1,0,'edit.php?post_type=page');

  //Find customers menu item and remove it.
  $remove_key = array_search("edit.php?post_type=clients", $menu);
  unset($menu[$remove_key]);

  // Find pages menu item and resinsert customer menu below it.
  $find_key = array_search("edit.php?post_type=page", $menu);
  array_splice($menu,$find_key+1,0,'edit.php?post_type=clients');

  return $menu;
}
add_filter('custom_menu_order', create_function('', 'return true;'));
add_filter('menu_order', 'menu_order_filter');

function yammer_get_next_post_sort($sort) {
  global $post;
  if ($post->post_type == "solutions" || $post->post_type = "productfeatures"):
    return str_replace('p.post_date','p.menu_order', $sort);
  endif;
}
add_filter('get_next_post_sort', 'yammer_get_next_post_sort');

function yammer_get_next_post_where($where) {
  global $post;
  if ($post->post_type == "solutions" || $post->post_type == "productfeatures"):
    $where = "WHERE p.menu_order > $post->menu_order AND p.post_type = '".$post->post_type."' AND p.post_status = 'publish'";
    return $where;
  endif;
}
add_filter('get_next_post_where', 'yammer_get_next_post_where');

// After rewriting the search base URL, it no longer provides clean SEO friendly URLs for search.
// This fixes that and makes search URLs SEO friendly.
function clean_search_redirect() {
  if ( !empty($_GET['s']) ):
    wp_redirect( home_url( '/about/search/' . str_replace( array( ' ', '%20' ),  array( '+', '+' ), get_query_var( 's' ) ) ) );
    exit();
  endif;

}
add_action( 'template_redirect', 'clean_search_redirect');

// Add wordpress menu to pages
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');

// Add wordpress menu as a TAB form to pages
function print_tab_menu_shortcode($atts, $contents = null){
	extract(shortcode_atts(array('name'=>null,), $atts));
	return wp_nav_menu(array('menu'=>$name, 'echo'=>false, 'menu_class'=>'yj-tabs', 'tab_menu'=>true));
}

add_shortcode('tabmenu', 'print_tab_menu_shortcode');

function yammer_save_template_file($data) {
  global $post;

  if ($data['post_type'] !== 'revision'):
    $old_template_file = get_post_meta($post->ID,'_wp_page_template',TRUE);
    update_post_meta($post->ID, "old_template_file", $old_template_file);
  endif;

  return $data;
}
add_action('wp_insert_post_data','yammer_save_template_file');


function is_sidebar_active( $sidebar_id ){
  $sidebars	= wp_get_sidebars_widgets();
  return (count($sidebars[$sidebar_id]));
}

function parse_video_link($video_link) {
  // Parse link for video ID so we can rebuild the URL with the appropriate format.
  preg_match('/(\d+)/', $video_link, $matches);

  if ($matches[0] == "") {
    $ytarray=explode("/", $video_link);
    $ytendstring=end($ytarray);
    $ytendarray=explode("?v=", $ytendstring);
    $ytendstring=end($ytendarray);
    $ytendarray=explode("&", $ytendstring);
    $ytcode=$ytendarray[0];
    // You Tube Link
    $video_link = "https://www.youtube-nocookie.com/embed/".$ytcode.'?modestbranding=0&autohide=1&mode=transparent&rel=0&showinfo=0&hd=1';
  } else {
    // Vimeo Link
    $video_link = "https://player.vimeo.com/video/".$matches[0];
  }
  return $video_link;
}
function versionControl() {
    global $roots_options;
    $dev =  $roots_options['development'];
    $version_num = $roots_options['production_version'];
    $version = "";
    if ($dev == 1) {
        $version = '?v=' . time();
    }
    else {
        if($version_num != ''){ $version = '?v=' . $version_num; }
    }
    return $version;
}

add_filter('gf_salesforce_lead_source', 'yammer_gravityforms_lead_source', 1, 3);
function yammer_gravityforms_lead_source($lead_source, $form_meta, $data) {
  // $lead_source - What was about to be used (normally Gravity Forms Form Title)
  // $form_meta - Gravity Forms form details
  // $data - The data passed to Salesforce
  global $roots_options;
  $form_id = $form_meta['id'];
  if ($form_id == $roots_options['contact_sales_form_id']) {
    $lead_source = 'Contact Sales Form';
  } elseif ($form_id == $roots_options['contact_affiliates_form_id']) {
    $lead_source = 'Partner Site';
  }
  return $lead_source;
}
add_filter("gform_submit_button", "yammer_gform_submit_button", 10, 2);
function yammer_gform_submit_button($button, $form) {
  $m = new Mustache;
  return $m->render('<input type="submit" class="yj-btn" id="gform_submit_button_{{id}}" value="{{submit}}" />', array('id' => $form["id"], 'submit' => _('Submit')));
}

function get_call_to_action_text($action){
    $text = "";
    if($action == 'read'){
        $text = __('Read More') . '<div class="arrow-right"></div>';
    }
    elseif ($action == 'video'){
        $video_text = __('Watch Video');
        $text = $video_text . '<img src="'.get_home_url() .'/wp-content/themes/roots/img/video.png'.'" alt="'.$video_text.'" class="watch-video-icon">';
    }
    elseif($action == 'learn'){
      $text = __('Learn More') . '<div class="arrow-right"></div>';
    }
    elseif($action == 'view'){
      $text = __('View More') . '<div class="arrow-right"></div>';
    }
    return $text;
}

function truncateString ($str, $length=290, $trailing='...')
{
  $length-=strlen($trailing); //take 3 characters off at the end to replace it with ...
  if (strlen($str) > $length)
  {
    return substr($str,0,$length).$trailing;
  }
  else
  {
    $res = $str;
  }

  return $res;
}

function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', array('page','solutions','enterpriseit','casestudies','post','productfeatures'));
  }

  return $query;
}

add_filter('pre_get_posts','SearchFilter');

//Hook into Yoast and WP title generation to add our custom %%parent%% variable.
add_filter( 'wp_title', 'yammer_title', 10, 3 );
function yammer_title($title) {
  global $post;
  $bcnOpts = get_option('bcn_yammer_options');
  if ($post->post_parent):
    $parentId = $post->post_parent;
  else:
    $parentId = $bcnOpts['apost_'.$post->post_type.'_root'];
  endif;
  if ($parentId > 0 && $parentId != get_option('page_on_front')):
    $title = str_replace("%%parent%%", get_the_title($parentId), $title);
    if (substr($title, -3) == " - "):
      return substr($title, 0, -3);
    else:
      return $title;
    endif;
  else:
    $title = str_replace("%%parent%%", '', $title);
    if (substr($title, -3) == " - "):
      return substr($title, 0, -3);
    else:
      return $title;
    endif;
  endif;
}

//Hook into Yoast and WP title generation to add our custom %%parent%% variable.
add_filter( 'wpseo_title', 'yammer_title_seo', 10, 3 );
function yammer_title_seo($title) {
  global $post;
  $bcnOpts = get_option('bcn_yammer_options');
  if ($post->post_parent):
    $parentId = $post->post_parent;
  else:
    $parentId = $bcnOpts['apost_'.$post->post_type.'_root'];
  endif;
  if ($parentId > 0 && $parentId != get_option('page_on_front')):
    $title = str_replace("%%parent%%", get_the_title($parentId), $title);
    if (substr($title, -3) == " - "):
      return substr($title, 0, -3);
    else:
      return $title;
    endif;
  else:
    $title = str_replace("%%parent%%", '', $title);
    if (substr($title, -3) == " - "):
      return substr($title, 0, -3);
    else:
      return $title;
    endif;
  endif;
}

//prepare and get the open graph objects
function print_og_tags(){
  $postID = get_the_ID();
  $url = get_permalink($postID);

  $logo = get_template_directory_uri()."/img/yammer-logo.png";
  $imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), array(200,200) );
  $imageURL = (isset($imageURL) && $imageURL[0] != '') ? home_url().$imageURL[0] : $logo;

  $description = get_post_meta( $postID, 'yam_subheading', true );
  $description = (isset($description) && $description != '') ? $description : "Yammer is a tool for making companies and organizations more productive through the exchange of short frequent answers to one simple question: What are you working on?";

  $title = "Yammer: ".get_the_title($postID);
  $heading = get_post_meta( get_the_ID(), 'yam_heading', true );
  $title = (isset($heading) && $heading != '') ? $title." - ".$heading : $title;

  $type = "<meta property='og:type' content='website'>";
  $url = "<meta property='og:url' content='".strip_tags($url)."'>";
  $image = "<meta property='og:image' content='".strip_tags($imageURL)."'>";
  $siteName = "<meta property='og:title' content='".htmlspecialchars(strip_tags($title), ENT_QUOTES)."'>";
  $description = "<meta property='og:description' content='".htmlspecialchars(strip_tags($description), ENT_QUOTES)."'>";

  echo $type.$url.$image.$siteName.$description;
}
add_action('wp_head', 'print_og_tags');

/*
 * Add filter and function to grab email from URL param and add it to tracking pixel
 */

add_filter('query_vars', 'email_queryvars' );
function email_queryvars( $qvars )
{
  $qvars[] = 'refm';
  return $qvars;
}
function get_email_queryvars()
{
  $email =  $_GET['m_yammer'];
  $email = filter_var($email, FILTER_SANITIZE_NUMBER_INT);
  if (filter_var($email, FILTER_SANITIZE_NUMBER_INT)) {
    return $email;
  }
  else {
    return "";
  }
}


// Catch query from specific server.
function yammer_capture_response(){
  if (isset($_GET['m'])) {
    $_GET['m_yammer'] = $_GET['m'];
    unset($_GET['m']);
  }
}
add_action( 'init', 'yammer_capture_response' );


function yammer_excerpt_length($length) {
  return 120; // Or whatever you want the length to be.
}
add_filter('excerpt_length', 'yammer_excerpt_length');

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
  function post_is_in_descendant_category( $cats, $_post = null ) {
    foreach ( (array) $cats as $cat ) {
      // get_term_children() accepts integer ID only
      $descendants = get_term_children( (int) $cat, 'category' );
      if ( $descendants && in_category( $descendants, $_post ) )
        return true;
    }
    return false;
  }
}

function printQuantcastTag() {
    global $roots_options;
    $id =  $roots_options['quantcast_id'];
    if (!empty($id)) {
        echo "<!-- Start Quantcast Tag -->
            <script type=\"text/javascript\"> 
            _qoptions={qacct:\"$id\",labels:\"\"};
            </script>
            <script type=\"text/javascript\" src=\"https://edge.quantserve.com/quant.js\"></script>
            <noscript>
            <img src=\"https://pixel.quantserve.com/pixel/$id.gif\" style=\"display: none;\" border=\"0\" height=\"1\" width=\"1\" alt=\"Quantcast\"/>
            </noscript>
            <!-- End Quantcast tag -->";
    }
}
?>