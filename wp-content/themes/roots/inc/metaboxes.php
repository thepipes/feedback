<?php // Meta boxes configurations

/*
 * Meta Box for all pages, adds heading, subheading and image
 * uses MetaBox plugin
 */

$prefix = 'yam_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box, for all pages
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'page_custom',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'post', 'page', 'productfeatures', 'casestudies', 'solutions', 'enterpriseit' ),
    
    'excludepagetemplates' => array('page-landing.php', 'page-landing-menu.php'),
    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Customize this Page',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
          'name'	=> 'Heading Grid',
          'id'	=> "{$prefix}heading_grid",
          'type'	=> 'select',
          'options'	=> array(
            'grid4'		=> 'Grid 4',
            'grid5'		=> 'Grid 5',
            'grid6'		=> 'Grid 6',
            'grid7'		=> 'Grid 7',
            'grid8'		=> 'Grid 8',
            'grid9'		=> 'Grid 9',
            'grid10'		=> 'Grid 10',
            'grid11'		=> 'Grid 11',
            'grid12'		=> 'Grid 12',
          ),
          'std' =>  'grid6',
          'desc'	=> 'Please select a grid for the header. (This effects the width of the text display)'
        ),
        array(
            'name'	=> 'Page Heading',
            'id'	=> "{$prefix}heading",
            'type'	=> 'text',
            'desc'	=> 'Enter the page heading'
        ),
        array(
            'name'	=> 'Page Subheading',
            'id'	=> "{$prefix}subheading",
            'type'	=> 'textarea',
            'desc'	=> 'Enter the subheading (if there is one) here'
        ),
        array(
            'name'	=> 'Heading and Subheading Color',
            'id'	=> "{$prefix}headingcolor",
            'type'	=> 'color',
            'desc'	=> 'Enter the color to use, default is white',
            'std' => '#333333'
        ),
        array(
          'name'	=> 'Video Title',
          'id'	=> "{$prefix}video_title",
          'type'	=> 'text',
          'desc'	=> 'Enter a video title (if there is one) here'
        ),
        array(
            'name'	=> 'Video Link',
            'id'	=> "{$prefix}video_link",
            'type'	=> 'text',
            'desc'	=> 'Enter a video link (if there is one) here'
        ),
        array(
          'name'	=> 'Video Thumbnail',
          'id'	=> "{$prefix}video_thumbnail",
          'type'	=> 'plupload_image',
          'desc'	=> 'Add a Thumbnail to display for videos'
        ),
        array(
          'name'	=> 'Video Caption',
          'id'	=> "{$prefix}video_caption",
          'type'	=> 'text',
          'desc'	=> 'Enter a video caption (if you want to display one) here'
        ),
        array(
            'name'	=> 'Show Breadcrumbs',
            'id'	=> "{$prefix}show_breadrcrumbs",
            'type'	=> 'select',
            'options'	=> array(
                'YES'		=> 'Yes',
                'NO'		=> 'No'
            ),
            'std' =>  'YES'
        ),
        array(
            'name'		=> 'Bottom Call to Action',
            'id'		=> "{$prefix}bottom_cta",
            'type'		=> 'select',
            // Array of 'key' => 'value' pairs for select box
            'options'	=> array(
                'none'		=> 'none',
                'Sign Up'		=> 'Sign Up',
                'Contact Sales'		=> 'Contact Sales'
            ),
            'std' =>  'NONE'
        ),
      array(
        'name'		=> 'Select Form to Display',
        'id'		=> "{$prefix}gf_id",
        'type'		=> 'select',
        // Array of 'key' => 'value' pairs for select box
        'options'	=> array('-1' => 'Select Form') + get_forms_dropdown(),
        'std' =>  '-1',
        'desc' => 'To display a form, select it from the menu above.'
      ),
    ));

// 2nd meta box, for all case studies
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'case_study_data',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'casestudies' ),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Case Study Form',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
      array(
        'name'		=> 'Select Customer',
        'id'		=> "{$prefix}client_id",
        'type'		=> 'select',
        // Array of 'key' => 'value' pairs for select box
        'options'	=>  array('-1' => 'Select Customer') + get_clients_dropdown(),
        'std' =>  '-1'
      ),
      array(
        'name'		=> 'Main Content',
        'id'		=> "{$prefix}main_content",
        'type'		=> 'wysiwyg'
      ),
      array(
            'name'	=> 'Results & Benefits',
            'id'	=> "{$prefix}results_and_benefits",
            'type'	=> 'text',
            'clone'		=> true,
            'desc'	=> 'Enter each result and benefit to the customer (bulleted list)'
        ),
      array(
            'name'	=> 'Case Study PDFs',
            'desc'	=> 'Upload a PDFs for the case study',
            'id'	=> "{$prefix}pdf",
            'type'	=> 'file'
        )
    ));

// 3rd meta box, for all feature pages!
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'features',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'productfeatures', 'solutions'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Panel Details',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'	=> 'Headings',
            'id'	=> "{$prefix}feature_heading",
            'type'	=> 'text',
            'desc'	=> 'Enter the section heading',
            'clone' => true
        ),
        array(
            'name'	=> 'Captions',
            'id'	=> "{$prefix}caption",
            'type'	=> 'textarea',
            'desc'	=> 'Enter the section heading',
            'clone' => true
        ),
        array(
            'name'	=> 'Images',
            'desc'	=> 'Upload images here for each area, in order',
            'id'	=> "{$prefix}images",
            'type'	=> 'plupload_image'
        ),
        array(
            'name'  => 'Videos',
            'id'    => "{$prefix}videos",
            'type'  => 'text',
            'desc'  => 'Enter the video url for each area, in order',
            'clone' => true
        ),
        array(
            'name'		=> 'Pop Out',
            'id'		=> "{$prefix}pop_out",
            'type'		=> 'radio',
            // Array of 'key' => 'value' pairs for radio options.
            // Note: the 'key' is stored in meta field, not the 'value'
            'options'	=> array(
                'YES'			=> 'YES',
                'NO'			=> 'NO'
            ),
            'std'		=> 'NO',
            'desc'		=> 'Pops out the first image outside (to the right) of the first panel.'
        )
    ));

// 4th meta box, for all feature pages with additional resources/links
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'highlights',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'productfeatures', 'solutions', 'casestudies'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Related Items',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    //list of fields
    'fields' => array(
        array(
            'name'	=> 'Section Title',
            'id'	=> "{$prefix}section_title",
            'type'	=> 'text',
            'desc'	=> 'Enter the title for these related items'
        ),
        array(
            'name'	=> 'Related Item Name',
            'id'	=> "{$prefix}feature_highlight_name",
            'type'	=> 'text',
            'desc'	=> 'Enter the name of each related item (feature highlights, resources)',
            'clone' => true
        ),
        array(
            'name'	=> 'Related Item Images',
            'id'	=> "{$prefix}feature_highlight_images",
            'type'	=> 'plupload_image',
            'desc'	=> 'Add images in order for related items (feature highlights, resources)'
        ),
        array(
            'name'	=> 'Related Item Link (optional)',
            'id'	=> "{$prefix}feature_highlight_link",
            'type'	=> 'text',
            'desc'	=> 'Enter the link of each related item (optional)',
            'clone' => true
        ),
        array(
            'name'	=> 'Show Bottom Divider',
            'id'	=> "{$prefix}show_bottom_divider",
            'type'	=> 'select',
            'options'	=> array(
                'YES'		=> 'Yes',
                'NO'		=> 'No'
            ),
            'std' =>  'NO'
        ),
        array(
          'name'	=> 'Related Item Button Link',
          'id'	=> "{$prefix}feature_highlight_button_link",
          'type'	=> 'text',
          'desc'	=> 'Enter the link for the button'
        ),
        array(
          'name'	=> 'Related Item Button Name',
          'id'	=> "{$prefix}feature_highlight_button_name",
          'type'	=> 'text',
          'desc'	=> 'Enter the name for the button'
        )
    ));

// 5th meta box, for client quotes
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'quote',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'clients', 'enterpriseit'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Quote',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    //list of fields
    'fields' => array(
      array(
          'name'	=> 'Add Quotes (" ")',
          'id'	=> "{$prefix}add_quotes",
          'type'		=> 'select',
          // Array of 'key' => 'value' pairs for radio options.
          // Note: the 'key' is stored in meta field, not the 'value'
          'options'	=> array(
            'YES'			=> 'YES',
            'NO'			=> 'NO'
          ),
          'std'		=> 'NO',
          'desc'	=> 'Add quote images and indent text inside the bluebox',
          'clone' => true
        ),
        array(
            'name'	=> 'The Quote',
            'id'	=> "{$prefix}quote_text",
            'type'	=> 'textarea',
            'desc'	=> 'Enter the quote here',
          'clone' => true
        ),
        array(
            'name'	=> 'Quoted Header',
            'id'	=> "{$prefix}quote_header",
            'type'	=> 'text',
            'desc'	=> '<b>Required to display.</b> Enter the quote\'s header (e.g. Useful Tip, David Sacks, etc.)',
          'clone' => true
        ),
      array(
        'name'	=> 'Quoted Sub-header',
        'id'	=> "{$prefix}quote_subheader",
        'type'	=> 'text',
        'desc'	=> 'Add any titles when quoting a person, comma seperated (e.g. CEO, Yammer)',
        'clone' => true
      ),
      array(
        'name'	=> 'Bottom Text',
        'id'	=> "{$prefix}bottom_text",
        'type'	=> 'text',
        'desc'	=> 'Text for the bottom of the quote.',
        'clone' => true
      ),
      array(
        'name'	=> 'Bottom Link',
        'id'	=> "{$prefix}bottom_link",
        'type'	=> 'text',
        'desc'	=> 'Link for the text at the bottom of the quote.',
        'clone' => true
      )
    ));

// 6th meta box, for any pages with a related pages section
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'related_pages',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'solutions'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Related Pages',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    //list of fields
    'fields' => array(
        array(
            'name' =>'Note:',
            'id'   => "{$prefix}description",
            'type' => 'description',
            'desc'=> 'To display one quote, select from the top fields. Selecting the second quote without selecting the first quote will not load it on the front end.'
        ),
        array(
            'name'		=> 'Select Customer for First Quote',
            'id'		=> "{$prefix}client_id_for_quote_related_pages",
            'type'		=> 'select',
            // Array of 'key' => 'value' pairs for select box
            'options'	=> array('-1' => 'Select Customer') + get_clients_dropdown(),
            'std' =>  '-1',
            'desc' => 'To display only one quote, select the first customer and quote only.'
        ),
        array(
            'name'	=> 'Quote to Display',
            'id'	=> "{$prefix}quote_id_related_pages",
            'type'	=> 'select',
            'options'	=> array(
                '-1'		=> 'Select Quote',
            ),
            'std' =>  '-1',

        ),
        array(
            //Hidden field used by JS files to handle ajax selections on quote selection.
            'name'	=> 'Selected Quote ID (hidden)',
            'id'	=> "{$prefix}selected_quote_id_related_pages",
            'type'	=> 'hidden',

        ),
        array(
            'name'	=> 'Quote Image',
            'id'	=> "{$prefix}quote_image_related_pages",
            'type'	=> 'plupload_image',
            'desc'	=> 'Add an optional image to be displayed abover this quote',

        ),

        array(
            'name'		=> 'Select Customer for second quote',
            'id'		=> "{$prefix}client_id_for_quote_related_pages_2",
            'type'		=> 'select',
            // Array of 'key' => 'value' pairs for select box
            'options'	=> array('-1' => 'Select Customer') + get_clients_dropdown(),
            'std' =>  '-1',
            'desc' => 'To display two quotes, select both the first and second customer and quotes.'
        ),
        array(
            'name'	=> 'Quote to Display for second quote',
            'id'	=> "{$prefix}quote_id_related_pages_2",
            'type'	=> 'select',
            'options'	=> array(
                '-1'		=> 'Select Quote',
            ),
            'std' =>  '-1',

        ),
        array(
            //Hidden field used by JS files to handle ajax selections on quote selection.
            'name'	=> 'Selected Quote ID (hidden)',
            'id'	=> "{$prefix}selected_quote_id_related_pages_2",
            'type'	=> 'hidden',

        ),
        array(
            'name'	=> 'Quote Image for second quote',
            'id'	=> "{$prefix}quote_image_related_pages_2",
            'type'	=> 'plupload_image',
            'desc'	=> 'Add an optional image to be displayed abover this quote',

        )
    ));

// 7th meta box, for all page template: customer overview
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'customer_overview',

    'pages' => array( 'page' ),

    'pagetemplates' => array ('page-customer-overview.php'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Add Featured Customer Images to this Page',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'  => 'Featured Customer Image Heading',
            'id'  => "{$prefix}featured_client_image_heading",
            'type'  => 'text',
            'desc'  => 'Optional featured client heading',
        ),
        array(
            'name'  => 'Featured Customer Image Heading Link',
            'id'  => "{$prefix}featured_client_heading_link",
            'type'  => 'text',
            'desc'  => 'Optional featured customer heading link',
        )
    ));

// 8th meta box, for all page template: overview
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'overview_sections',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'page'),

    'pagetemplates' => array ('page-overview.php'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Overview Page Details',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'	=> 'Headings',
            'id'	=> "{$prefix}overview_heading",
            'type'	=> 'text',
            'desc'	=> 'Enter the section heading',
            'clone' => true
        ),
        array(
            'name'	=> 'Links',
            'id'	=> "{$prefix}overview_links",
            'type'	=> 'text',
            'desc'	=> 'Enter the section link (optional)',
            'clone' => true
        ),
        array(
            'name'	=> 'Captions',
            'id'	=> "{$prefix}overview_captions",
            'type'	=> 'textarea',
            'desc'	=> 'Enter the section heading',
            'clone' => true
        ),
        array(
            'name'	=> 'Images',
            'desc'	=> 'Upload images here for each area, in order',
            'id'	=> "{$prefix}overview_images",
            'type'	=> 'plupload_image'
        ),
        array(
            'name'		=> 'Pop Out',
            'id'		=> "{$prefix}overview_pop_out",
            'type'		=> 'radio',
            // Array of 'key' => 'value' pairs for radio options.
            // Note: the 'key' is stored in meta field, not the 'value'
            'options'	=> array(
                'YES'			=> 'YES',
                'NO'			=> 'NO'
            ),
            'std'		=> 'NO',
            'desc'		=> 'Pops out the section image outside (top) of the panel.'
        ),
        array(
            'name'	=> 'Teaser Heading',
            'id'	=> "{$prefix}overview_teaser_heading",
            'type'	=> 'text',
            'desc'	=> 'Enter the teaser heading'
        ),
        array(
            'name'	=> 'Teaser Caption',
            'id'	=> "{$prefix}overview_teaser_caption",
            'type'	=> 'textarea',
            'desc'	=> 'Enter the teaser caption'
        ),
        array(
            'name'	=> 'Teaser Image',
            'desc'	=> 'Upload image here for the teaser area',
            'id'	=> "{$prefix}overview_teaser_images",
            'type'	=> 'plupload_image'
        ),
        array(
          'name'	=> 'Panels Heading',
          'id'	=> "{$prefix}overview_panels_heading",
          'type'	=> 'text',
          'desc'	=> 'Enter the panels heading, ex: what can you do with yammer'
        ),
    ));

$case_studies_arr = get_case_studies_array();

$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box
  'id' => 'related_case_studies',

  // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
  'pages' => array('casestudies'),

  // Meta box title - Will appear at the drag and drop handle bar
  'title' => 'Add Related Case Studies',

  // Where the meta box appear: normal (default), advanced, side; optional
  'context' => 'normal',

  // Order of meta box: high (default), low; optional
  'priority' => 'high',

  //list of fields
  'fields' => array(
    array(
      'name'	=> 'Logo/Headshot',
      'desc'	=> 'Upload the image to be used with the related case studies module. (Logo or Logo/Headshot)',
      'id'	=> "{$prefix}related_case_study_image",
      'type'	=> 'plupload_image'
    ),
    array(
      'name'		=> 'Select Case Study',
      'id'		=> "{$prefix}related_case_studies_ids",
      'type'		=> 'select',
      // Array of 'key' => 'value' pairs for select box
      'options'	=> array('-1' => 'Select Case Study') + $case_studies_arr,
      'std' =>  '-1',
      'clone' => true
    ),
  ));


$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box
  'id' => 'customer_overview_data',

  // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
  'pages' => array('page'),

  'pagetemplates' => array('page-customer-overview.php'),

  // Meta box title - Will appear at the drag and drop handle bar
  'title' => 'Customer Overview Data',

  // Where the meta box appear: normal (default), advanced, side; optional
  'context' => 'normal',

  // Order of meta box: high (default), low; optional
  'priority' => 'high',

  //list of fields
  'fields' => array(
    array(
      'name'	=> 'Heading 1 Text',
      'desc'	=> 'Add the title of the first panel on any Customer Overview page',
      'id'	=> "{$prefix}heading_1_text",
      'type'	=> 'text'
    ),
    array(
      'name'	=> 'Heading 1 Link Text',
      'desc'	=> 'Add the text for the link on the first panel title on any Customer Overview page',
      'id'	=> "{$prefix}heading_1_link_text",
      'type'	=> 'text'
    ),
    array(
      'name'	=> 'Heading 1 Link',
      'desc'	=> 'Add the link for the first panel title on any Customer Overview page',
      'id'	=> "{$prefix}heading_1_link",
      'type'	=> 'text'
    ),
    array(
      'name'	=> 'Case Study Images',
      'desc'	=> 'Add two images, one to go with each case study',
      'id'	=> "{$prefix}case_study_images",
      'type'	=> 'plupload_image'
    ),
    array(
      'name'		=> 'Select Case Study 1',
      'id'		=> "{$prefix}case_study_1",
      'type'		=> 'select',
      // Array of 'key' => 'value' pairs for select box
      'options'	=> array('-1' => 'Select Case Study') + $case_studies_arr,
      'std' =>  '-1'
    ),
    array(
      'name'		=> 'Select Case Study 2',
      'id'		=> "{$prefix}case_study_2",
      'type'		=> 'select',
      // Array of 'key' => 'value' pairs for select box
      'options'	=> array('-1' => 'Select Case Study') + $case_studies_arr,
      'std' =>  '-1'
    ),
    array(
      'name'  => 'Customer Success Case Study Video Images',
      'id'  => "{$prefix}customer_success_case_study_video_images",
      'type'  => 'plupload_image',
      'desc'  => 'Video images for customer success case studies',
    ),
    array(
      'name'  => 'Customer Success Case Study Video Text',
      'id'  => "{$prefix}customer_success_case_study_video_text",
      'type'  => 'text',
      'desc'  => 'Caption for customer success case studies videos',
      'clone' => true
    ),
    array(
      'name'  => 'Customer Success Case Study Video URL',
      'id'  => "{$prefix}customer_success_case_study_video_url",
      'type'  => 'text',
      'desc'  => 'URL for customer success case studies videos',
      'clone' => true
    ),
    array(
      'name'  => 'Customer Success Case Study Video Title',
      'id'  => "{$prefix}customer_success_case_study_video_title",
      'type'  => 'text',
      'desc'  => 'Title for customer success case studies videos',
      'clone' => true
    )
  ));

// 9th meta box, for customer information on case studies
$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box
  'id' => 'customer_information',

  // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
  'pages' => array('clients'),

  // Meta box title - Will appear at the drag and drop handle bar
  'title' => 'Customer Information',

  // Where the meta box appear: normal (default), advanced, side; optional
  'context' => 'normal',

  // Order of meta box: high (default), low; optional
  'priority' => 'high',

  //list of fields
  'fields' => array(
    array(
      'name'	=> 'Featured Customer',
      'id'	=> "{$prefix}featured_customer",
      'type'	=> 'select',
      'options'	=> array(
        'YES'		=> 'Yes',
        'NO'		=> 'No'
      ),
      'std' =>  'NO'
    ),
    array(
      'name'	=> 'Region',
      'id'	=> "{$prefix}region",
      'type'	=> 'text',
      'desc'	=> 'Enter the location of the company'
    ),
    array(
      'name'	=> 'Employees',
      'id'	=> "{$prefix}employees",
      'type'	=> 'text',
      'desc'	=> 'Enter the number of employees'
    ),
    array(
      'name'	=> 'Date Founded',
      'id'	=> "{$prefix}founded",
      'type'	=> 'text',
      'desc'	=> 'Enter the year the company was founded'
    ),
    array(
      'name'	=> 'Revenue',
      'id'	=> "{$prefix}revenue",
      'type'	=> 'text',
      'desc'	=> 'Enter the revenue of the company'
    ),
      array(
    'name'	=> 'Video Title',
    'id'	=> "{$prefix}client_video_title",
    'type'	=> 'text',
    'desc'	=> 'Enter a video title (if there is one) here'
  ),
        array(
          'name'	=> 'Video Link',
          'id'	=> "{$prefix}client_video_link",
          'type'	=> 'text',
          'desc'	=> 'Enter a video link (if there is one) here'
        ),
        array(
          'name'	=> 'Video Thumbnail',
          'id'	=> "{$prefix}client_video_thumbnail",
          'type'	=> 'plupload_image',
          'desc'	=> 'Add a Thumbnail to display for videos'
        )
  ));

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'customer_success',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array('page'),

    'pagetemplates' => array ('page-customer-overview.php'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Add Customer Success Heading',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    //list of fields
    'fields' => array(
        array(
            'name'  => 'Customer Success Heading',
            'id'  => "{$prefix}customer_success_heading",
            'type'  => 'text',
            'desc'  => 'Optional customer success heading',
        ),
        array(
            'name'  => 'Customer Success Heading Bullet Images',
            'id'  => "{$prefix}customer_success_heading_bullet_images",
            'type'  => 'plupload_image',
            'desc'  => 'Bullet images for customer success heading',
        ),
        array(
          'name'  => 'Customer Success Heading Bullet Text',
          'id'  => "{$prefix}customer_success_heading_bullet_text",
          'type'  => 'text',
          'desc'  => 'Bullet text for customer success heading',
          'clone' => true
        ),
        array(
          'name'  => 'Customer Success Heading Link Text',
          'id'  => "{$prefix}customer_success_heading_link_text",
          'type'  => 'text',
          'desc'  => 'Optional customer success heading link text',
        ),
        array(
            'name'  => 'Customer Success Heading Link',
            'id'  => "{$prefix}customer_success_heading_link",
            'type'  => 'text',
            'desc'  => 'Optional customer success heading link',
        ),
      array(
        'name'		=> 'Select Category',
        'id'		=> "{$prefix}category_id",
        'type'		=> 'select',
        // Array of 'key' => 'value' pairs for select box
        'options'	=> get_category_array(),
        'std' =>  '-1'

      )
    ));

// Meta Boxes for Event posts
$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box
  'id' => 'events',

  // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
  'pages' => array('post'),

  // Meta box title - Will appear at the drag and drop handle bar
  'title' => 'Event Information',

  // Where the meta box appear: normal (default), advanced, side; optional
  'context' => 'normal',

  // Order of meta box: high (default), low; optional
  'priority' => 'high',

  //list of fields
  'fields' => array(
    array(
      'name'  => 'Event Start Date',
      'id'  => "{$prefix}event_start_date",
      'type'  => 'date',
      'desc'  => 'Enter a start date if this is an event',
    ),
    array(
      'name'  => 'Event End Date',
      'id'  => "{$prefix}event_end_date",
      'type'  => 'date',
      'desc'  => 'Enter an end date if this is an event (Optional: For Multi Day Events)',
    ),
    array(
      'name'  => 'Registration Link',
      'id'  => "{$prefix}registration_link",
      'type'  => 'text',
      'desc'  => 'Enter a registration link if this is an event (Optional)',
    ),
    array(
      'name'  => 'Location',
      'id'  => "{$prefix}event_location",
      'type'  => 'textarea',
      'desc'  => 'Enter a location/address for this event (Optional)',
    )
  ));

// Meta Boxes for simple posts pages
$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box
  'id' => 'posts_page',

  // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
  'pages' => array('page'),

  'pagetemplates' => array ('page-post-listing.php', 'page-events.php'),
  // Meta box title - Will appear at the drag and drop handle bar
  'title' => 'Post Listing Information',

  // Where the meta box appear: normal (default), advanced, side; optional
  'context' => 'normal',

  // Order of meta box: high (default), low; optional
  'priority' => 'high',

  //list of fields
  'fields' => array(
    array(
      'name'	=> 'Events Page',
      'id'	=> "{$prefix}events_page",
      'type'		=> 'select',
      'options'	=> array(
        'YES'			=> 'YES',
        'NO'			=> 'NO'
      ),
      'std'		=> 'NO',
      'desc'	=> 'Display as event listing'
    ),
    array(
      'name'	=> 'Link to Page',
      'id'	=> "{$prefix}cat_link_page",
      'type'		=> 'select',
      'options'	=> get_pages_array(),
      'std'		=> 'NO',
      'desc'	=> 'Page to link this event to (For Events Page).',
      'clone' => true
    ),
    array(
      'name'		=> 'Select Categories',
      'id'		=> "{$prefix}category_ids",
      'type'		=> 'select',
      // Array of 'key' => 'value' pairs for select box
      'options'	=> get_category_array(),
      'std' =>  '-1',
      'clone' => true

    )
  ));


// meta box, for clients post type to enter a link when the client has a case study.
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'url_to_client_case_study',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array('clients'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Featured Case Study',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'low',

    //list of fields
    'fields' => array(
        array(
            'name'		=> 'Select Case Study',
            'id'		=> "{$prefix}related_case_studies_ids",
            'type'		=> 'select',
            // Array of 'key' => 'value' pairs for select box
            'options'	=> array('-1' => 'Select Case Study') + $case_studies_arr,
            'std' =>  '-1'

        )
    ));


//Metabox for selecting quotes
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'select_quotes',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array('solutions', 'casestudies'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Select a quote to display',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'low',

    //list of fields
    'fields' => array(

        array(
            'name'		=> 'Select Customer',
            'id'		=> "{$prefix}client_id_for_quote",
            'type'		=> 'select',
            // Array of 'key' => 'value' pairs for select box
            'options'	=> array('-1' => 'Select Customer') + get_clients_dropdown(),
            'std' =>  '-1'
        ),
        array(
            'name'	=> 'Quote to Display',
            'id'	=> "{$prefix}quote_id",
            'type'	=> 'select',
            'options'	=> array(
                '-1'		=> 'Select Quote',
            ),
            'std' =>  '-1'
        ),
        array(
            //Hidden field used by JS files to handle ajax selections on quote selection.
            'name'	=> 'Selected Quote ID (hidden)',
            'id'	=> "{$prefix}selected_quote_id",
            'type'	=> 'hidden'
        ),
        array(
            'name'	=> 'Quote Image',
            'id'	=> "{$prefix}quote_image",
            'type'	=> 'plupload_image',
            'desc'	=> 'Add an optional image to be displayed abover this quote'
        )
    ));

// Metaboxes, just for landing page template with Menu.. the "pagetemplates" variable is not taking more than one parameter.

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box
    'id' => 'page_landing_menu',

    // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
    'pages' => array( 'page' ),

    'pagetemplates' => array ('page-landing-menu.php'),

    // Meta box title - Will appear at the drag and drop handle bar
    'title' => 'Customize this Page',

    // Where the meta box appear: normal (default), advanced, side; optional
    'context' => 'normal',

    // Order of meta box: high (default), low; optional
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'	=> 'Page Heading',
            'id'	=> "{$prefix}heading",
            'type'	=> 'text',
            'desc'	=> 'Enter the page heading'
        ),

        array(
            'name'	=> 'Heading Color',
            'id'	=> "{$prefix}headingcolor",
            'type'	=> 'color',
            'desc'	=> 'Enter the color to use, default is white',
            'std' => '#333333'
        ),
        array(
            'name'	=> 'Page Subheading',
            'id'	=> "{$prefix}subheading",
            'type'	=> 'textarea',
            'desc'	=> 'Enter the subheading (if there is one) here'
        ),
        array(
            'name'	=> 'Subheading Color',
            'id'	=> "{$prefix}subheadingcolor",
            'type'	=> 'color',
            'desc'	=> 'Enter the color to use, default is white',
            'std' => '#333333'
        ),
        array(
            'name'	=> 'Report PDF',
            'desc'	=> 'Upload a PDF for the report',
            'id'	=> "{$prefix}pdf",
            'type'	=> 'file'
        ),
        array(
            'name'	=> 'Show Breadcrumbs',
            'id'	=> "{$prefix}show_breadrcrumbs",
            'type'	=> 'select',
            'options'	=> array(
                'YES'		=> 'Yes',
                'NO'		=> 'No'
            ),
            'std' =>  'YES'
        ),
        array(
            'name'		=> 'Bottom Call to Action',
            'id'		=> "{$prefix}bottom_cta",
            'type'		=> 'select',
            // Array of 'key' => 'value' pairs for select box
            'options'	=> array(
                'none'		=> 'none',
                'Sign Up'		=> 'Sign Up',
                'Contact Sales'		=> 'Contact Sales'
            ),
            'std' =>  'NONE'
        )
    ));

// Metaboxes, just for landing page template
  $meta_boxes[] = array(
      // Meta box id, UNIQUE per meta box
      'id' => 'page_landing',

      // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
      'pages' => array( 'page' ),

      'pagetemplates' => array ('page-landing.php'),

      // Meta box title - Will appear at the drag and drop handle bar
      'title' => 'Customize this Page',

      // Where the meta box appear: normal (default), advanced, side; optional
      'context' => 'normal',

      // Order of meta box: high (default), low; optional
      'priority' => 'high',

      // List of meta fields
      'fields' => array(
          array(
              'name'	=> 'Page Heading',
              'id'	=> "{$prefix}heading",
              'type'	=> 'text',
              'desc'	=> 'Enter the page heading'
          ),
          
          array(
              'name'	=> 'Heading Color',
              'id'	=> "{$prefix}headingcolor",
              'type'	=> 'color',
              'desc'	=> 'Enter the color to use, default is white',
              'std' => '#333333'
          ),
          array(
              'name'	=> 'Page Subheading',
              'id'	=> "{$prefix}subheading",
              'type'	=> 'textarea',
              'desc'	=> 'Enter the subheading (if there is one) here'
          ),
          array(
              'name'	=> 'Subheading Color',
              'id'	=> "{$prefix}subheadingcolor",
              'type'	=> 'color',
              'desc'	=> 'Enter the color to use, default is white',
              'std' => '#333333'
          ),
          array(
            'name'	=> 'Video Title',
            'id'	=> "{$prefix}video_title",
            'type'	=> 'text',
            'desc'	=> 'Enter a video title (if there is one) here'
          ),
          array(
              'name'	=> 'Video Link',
              'id'	=> "{$prefix}video_link",
              'type'	=> 'text',
              'desc'	=> 'Enter a video link (if there is one) here'
          ),
          array(
            'name'	=> 'Video Thumbnail',
            'id'	=> "{$prefix}video_thumbnail",
            'type'	=> 'plupload_image',
            'desc'	=> 'Add a Thumbnail to display for videos'
          ),
          array(
              'name'	=> 'Show Breadcrumbs',
              'id'	=> "{$prefix}show_breadrcrumbs",
              'type'	=> 'select',
              'options'	=> array(
                  'YES'		=> 'Yes',
                  'NO'		=> 'No'
              ),
              'std' =>  'YES'
          ),
          array(
              'name'		=> 'Bottom Call to Action',
              'id'		=> "{$prefix}bottom_cta",
              'type'		=> 'select',
              // Array of 'key' => 'value' pairs for select box
              'options'	=> array(
                  'none'		=> 'none',
                  'Sign Up'		=> 'Sign Up',
                  'Contact Sales'		=> 'Contact Sales'
              ),
              'std' =>  'NONE'
          )
      ));
  $meta_boxes[] = array(
      // Meta box id, UNIQUE per meta box
      'id' => 'features',

      // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
      'pages' => array( 'page' ),

      'pagetemplates' => array ('page-landing.php'),
      // Meta box title - Will appear at the drag and drop handle bar
      'title' => 'Panel Details',

      // Where the meta box appear: normal (default), advanced, side; optional
      'context' => 'normal',

      // Order of meta box: high (default), low; optional
      'priority' => 'high',

      // List of meta fields
      'fields' => array(
          array(
              'name'	=> 'Headings',
              'id'	=> "{$prefix}feature_heading",
              'type'	=> 'text',
              'desc'	=> 'Enter the section heading',
              'clone' => true
          ),
          array(
              'name'	=> 'Captions',
              'id'	=> "{$prefix}caption",
              'type'	=> 'textarea',
              'desc'	=> 'Enter the section heading',
              'clone' => true
          ),
          array(
              'name'	=> 'Call to action link URL',
              'id'	=> "{$prefix}cta_url",
              'type' => 'text',
              'desc'	=> 'URL of the CTA buttons',
              'clone' => true
          ),
          array(
              'name'	=> 'Call to action text',
              'id'	=> "{$prefix}cta_textcopy",
              'type' => 'text',
              'desc'	=> 'Text of the CTA button',
              'clone' => true
          ),
          array(
              'name'	=> 'Call to action color or Disable',
              'id'	=> "{$prefix}cta_color",
              'type' => 'select',
              'options'	=>  array('-1' => 'Select CTA Color',
                                  '0'  => 'Blue',
                                  '1'  => 'Orange',
                                  '2'  => 'Grey',
                                  '3'  => 'Green',
                                  '4'  => 'Hide button'),
              'desc'	=> 'Select the CTA color or Disable it',
              'clone' => true
          ),
          array(
              'name'	=> 'Text Link',
              'id'	=> "{$prefix}ctalink_on",
              'type' => 'select',
              'options' => array('0' => 'Off',
                                 '1' => 'On'),
              'desc'	=> 'Display Text Link below link or not.',
              'clone' => true
          ),
          array(
              'name'	=> 'Text Link URL',
              'id'	=> "{$prefix}ctalink_url",
              'type' => 'text',
              'desc'	=> 'URL of the Text Link',
              'clone' => true
          ),
          array(
              'name'	=> 'Text Link text',
              'id'	=> "{$prefix}ctalink_text",
              'type' => 'text',
              'desc'	=> 'The text of the Text Link',
              'clone' => true
          ),
          array(
              'name'	=> 'Images',
              'desc'	=> 'Upload images here for each area, in order',
              'id'	=> "{$prefix}images",
              'type'	=> 'plupload_image'
          ),
          array(
              'name'		=> 'Pop Out',
              'id'		=> "{$prefix}pop_out",
              'type'		=> 'radio',
              // Array of 'key' => 'value' pairs for radio options.
              // Note: the 'key' is stored in meta field, not the 'value'
              'options'	=> array(
                  'YES'			=> 'YES',
                  'NO'			=> 'NO'
              ),
              'std'		=> 'NO',
              'desc'		=> 'Pops out the first image outside (to the right) of the first panel.'
          )
      ));

//Metabox for sources lightbox
$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box
  'id' => 'custom_lightbox',

  // Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
  'pages' => array('page'),

  'pagetemplates' => array ('page-overview.php'),
  // Meta box title - Will appear at the drag and drop handle bar
  'title' => 'Add an optional lightbox to this page.',

  // Where the meta box appear: normal (default), advanced, side; optional
  'context' => 'normal',

  // Order of meta box: high (default), low; optional
  'priority' => 'low',

  //list of fields
  'fields' => array(
    array(
      'name'		=> 'Display Lightbox',
      'id'		=> "{$prefix}display_lightbox",
      'type'		=> 'radio',
      // Array of 'key' => 'value' pairs for radio options.
      // Note: the 'key' is stored in meta field, not the 'value'
      'options'	=> array(
        'YES'			=> 'YES',
        'NO'			=> 'NO'
      ),
      'std'		=> 'NO',
      'desc'		=> 'Optionally adds a button to display below content in a lightbox.'
    ),
    array(
      'name'		=> 'Button Text',
      'id'		=> "{$prefix}lightbox_button_text",
      'type'		=> 'text'
    ),
    array(
      'name'		=> 'Lightbox Title',
      'id'		=> "{$prefix}lightbox_title",
      'type'		=> 'text'
    ),
    array(
      'name'		=> 'Lightbox Content',
      'id'		=> "{$prefix}lightbox_content",
      'type'		=> 'wysiwyg',
    ),
  ));

/**
 * Register meta boxes
 *
 * @return void
 */
function yam_register_meta_boxes()
{
    global $meta_boxes;

    // Make sure there's no errors when the plugin is deactivated or during upgrade
      if ( class_exists( 'RW_Meta_Box_Yammer' ) )
    {
        foreach ( $meta_boxes as $meta_box )
        {
            new RW_Meta_Box_Yammer( $meta_box );
        }
    }
}

// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'yam_register_meta_boxes' );

?>