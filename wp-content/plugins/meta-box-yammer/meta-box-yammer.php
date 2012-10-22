<?php
/*
Plugin Name: Meta Box (Yammer)
Description: Create meta box for editing pages in WordPress. Compatible with custom post types since WP 3.0 (Yammer)
Author URI: http://www.deluxeblogtips.com
License: GPL2+
*/

// Prevent loading this file directly - Busted!
if ( ! class_exists( 'WP' ) )
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

// Meta Box Class
if ( ! class_exists( 'RW_Meta_Box_Yammer' ) )
{
	// Script version, used to add version for scripts and styles
	//define( 'RWMBY_VER', '4.1.2' );

	// Define plugin URLs, for fast enqueuing scripts and styles
	if ( ! defined( 'RWMBY_URL' ) )
		define( 'RWMBY_URL', plugin_dir_url( __FILE__ ) );
	define( 'RWMBY_JS_URL', trailingslashit( RWMBY_URL . 'js' ) );
	define( 'RWMBY_CSS_URL', trailingslashit( RWMBY_URL . 'css' ) );

	// Plugin paths, for including files
	if ( ! defined( 'RWMBY_DIR' ) )
		define( 'RWMBY_DIR', plugin_dir_path( __FILE__ ) );
	define( 'RWMBY_INC_DIR', trailingslashit( RWMBY_DIR . 'inc' ) );
	define( 'RWMBY_FIELDS_DIR', trailingslashit( RWMBY_INC_DIR . 'fields' ) );

	// Include field classes
	foreach ( glob( RWMBY_FIELDS_DIR . '*.php' ) as $file )
	{
		require_once $file;
	}

	/**
	 * A class to rapid develop meta boxes for custom & built in content types
	 * Piggybacks on WordPress
	 *
	 * @author Rilwis
	 * @author Co-Authors @see https://github.com/rilwis/meta-box
	 * @license GNU GPL2+
	 * @package RW Meta Box
	 */
	class RW_Meta_Box_Yammer
	{
		/**
		 * Meta box information
		 */
		var $meta_box;

		/**
		 * Fields information
		 */
		var $fields;

		/**
		 * Contains all field types of current meta box
		 */
		var $types;

		/**
		 * Create meta box based on given data
		 *
		 * @see demo/demo.php file for details
		 *
		 * @param array $meta_box Meta box definition
		 *
		 * @return \RW_Meta_Box_Yammer
		 */
		function __construct( $meta_box )
		{
			// Run script only in admin area
			if ( ! is_admin() )
				return;

			// Assign meta box values to local variables and add it's missed values
			$this->meta_box = self::normalize( $meta_box );
			$this->fields   = &$this->meta_box['fields'];

			// List of meta box field types
			$this->types = array_unique( wp_list_pluck( $this->fields, 'type' ) );

			// Load translation file
			// Call directly because we define meta boxes in 'admin_init' hook (@see demo/demo.php)
			// So the function won't run if we use 'add_action' to load textdomain here
			self::load_textdomain();

			// Enqueue common styles and scripts
			add_action( 'admin_print_styles-post.php', array( __CLASS__, 'admin_print_styles' ) );
			add_action( 'admin_print_styles-post-new.php', array( __CLASS__, 'admin_print_styles' ) );

			foreach ( $this->types as $type )
			{
				$class = self::get_class_name( $type );

				// Enqueue scripts and styles for fields
				if ( method_exists( $class, 'admin_print_styles' ) )
				{
					add_action( 'admin_print_styles-post.php', array( $class, 'admin_print_styles' ) );
					add_action( 'admin_print_styles-post-new.php', array( $class, 'admin_print_styles' ) );
				}

				// Add additional actions for fields
				if ( method_exists( $class, 'add_actions' ) )
					call_user_func( array( $class, 'add_actions' ) );
			}

			// Add meta box
			foreach ( $this->meta_box['pages'] as $page )
				add_action( "add_meta_boxes_{$page}", array( &$this, 'add_meta_boxes' ) );

			// Save post meta
			add_action( 'save_post', array( &$this, 'save_post' ) );
		}

		/**
		 * Load plugin translation
		 *
		 * @link http://wordpress.stackexchange.com/a/33314 Translation Tutorial by the author
		 * @return void
		 */
		static function load_textdomain()
		{
			// l18n translation files
			$locale = get_locale();
			$dir    = trailingslashit( RWMBY_DIR . 'lang' );
			$mofile = "{$dir}{$locale}.mo";

			// In themes/plugins/mu-plugins directory
			load_textdomain( 'rwmby', $mofile );
		}

		/**
		 * Enqueue common styles
		 *
		 * @return void
		 */
		static function admin_print_styles()
		{
			wp_enqueue_style( 'rwmby', RWMBY_CSS_URL . 'style.css', RWMBY_VER );
			wp_enqueue_script( 'rwmby-clone', RWMBY_JS_URL . 'clone.js', RWMBY_VER );
		}

		/**************************************************
			SHOW META BOX
		**************************************************/

		/**
		 * Add meta box for multiple post types
		 *
		 * @return void
		 */
		function add_meta_boxes()
    {
      if (isset($this->meta_box['pages']) && $this->meta_box['pages'] != ''){
      foreach ( $this->meta_box['pages'] as $page )
      {
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
        $template_file = get_post_meta($post_id,'_wp_page_template',true);
        // check for a template type
        if ($this->meta_box['excludepagetemplates'] == null):
          $this->meta_box['excludepagetemplates'] = array();
        endif;
        if (empty($this->meta_box['pagetemplates'][0])):
          if (!in_array($template_file, $this->meta_box['excludepagetemplates'])):
            add_meta_box(
              $this->meta_box['id'],
              $this->meta_box['title'],
              array( &$this, 'show' ),
              $page,
              $this->meta_box['context'],
              $this->meta_box['priority']
            );
          endif;
        else:
          if ($template_file == $this->meta_box['pagetemplates'][0]):
            if (!in_array($template_file, $this->meta_box['excludepagetemplates'])):
              add_meta_box(
                $this->meta_box['id'],
                $this->meta_box['title'],
                array( &$this, 'show' ),
                $page,
                $this->meta_box['context'],
                $this->meta_box['priority']
              );
            endif;
          endif;
        endif;
      }
      }
    }

		/**
		 * Callback function to show fields in meta box
		 *
		 * @return void
		 */
		public function show()
		{
			global $post;

			$saved = self::has_been_saved( $post->ID, $this->fields );

			wp_nonce_field( "rwmby-save-{$this->meta_box['id']}", "nonce_{$this->meta_box['id']}" );

			// Allow users to add custom code before meta box content
			// 1st action applies to all meta boxes
			// 2nd action applies to only current meta box
			do_action( 'rwmby_before' );
			do_action( "rwmby_before_{$this->meta_box['id']}" );

			foreach ( $this->fields as $field )
			{
				$type = $field['type'];
				$id = $field['id'];
				$meta = self::apply_field_class_filters( $field, 'meta', '', $post->ID, $saved );
				$meta = apply_filters( "rwmby_{$type}_meta", $meta );
				$meta = apply_filters( "rwmby_{$id}_meta", $meta );

				$begin = self::apply_field_class_filters( $field, 'begin_html', '', $meta );

				// Apply filter to field begin HTML
				// 1st filter applies to all fields
				// 2nd filter applies to all fields with the same type
				// 3rd filter applies to current field only
				$begin = apply_filters( "rwmby_begin_html", $begin, $field, $meta );
				$begin = apply_filters( "rwmby_{$type}_begin_html", $begin, $field, $meta );
				$begin = apply_filters( "rwmby_{$id}_begin_html", $begin, $field, $meta );

				// Separate code for clonable and non-cloneable fields to make easy to maintain

				// Cloneable fields
				if ( self::is_cloneable( $field ) )
				{
					$field_html = '';

					$meta = (array) $meta;
					foreach ( $meta as $meta_data )
					{
						add_filter( "rwmby_{$id}_html", array( &$this, 'add_delete_clone_button' ), 10, 3 );

						// Wrap field HTML in a div with class="rwmby-clone" if needed
						$input_html = '<div class="rwmby-clone">';

						// Call separated methods for displaying each type of field
						$input_html .= self::apply_field_class_filters( $field, 'html', '', $meta_data );

						// Apply filter to field HTML
						// 1st filter applies to all fields with the same type
						// 2nd filter applies to current field only
						$input_html = apply_filters( "rwmby_{$type}_html", $input_html, $field, $meta_data );
						$input_html = apply_filters( "rwmby_{$id}_html", $input_html, $field, $meta_data );

						$input_html .= '</div>';

						$field_html .= $input_html;
					}
				}
				// Non-cloneable fields
				else
				{
					// Call separated methods for displaying each type of field
					$field_html = self::apply_field_class_filters( $field, 'html', '', $meta );

					// Apply filter to field HTML
					// 1st filter applies to all fields with the same type
					// 2nd filter applies to current field only
					$field_html = apply_filters( "rwmby_{$type}_html", $field_html, $field, $meta );
					$field_html = apply_filters( "rwmby_{$id}_html", $field_html, $field, $meta );
				}

				$end = self::apply_field_class_filters( $field, 'end_html', '', $meta );

				// Apply filter to field end HTML
				// 1st filter applies to all fields
				// 2nd filter applies to all fields with the same type
				// 3rd filter applies to current field only
				$end = apply_filters( "rwmby_end_html", $end, $field, $meta );
				$end = apply_filters( "rwmby_{$type}_end_html", $end, $field, $meta );
				$end = apply_filters( "rwmby_{$id}_end_html", $end, $field, $meta );

				// Apply filter to field wrapper
				// This allow users to change whole HTML markup of the field wrapper (i.e. table row)
				// 1st filter applies to all fields with the same type
				// 2nd filter applies to current field only
				$html = apply_filters( "rwmby_{$type}_wrapper_html", "{$begin}{$field_html}{$end}", $field, $meta );
				$html = apply_filters( "rwmby_{$id}_wrapper_html", $html, $field, $meta );

				// Display label and input in DIV and allow user-defined classes to be appended
				$class = 'rwmby-field';
				if ( isset( $field['class'] ) )
					$class = $this->add_cssclass( $field[ 'class' ], $class );

				// If the 'hidden' argument is set and TRUE, the div will be hidden
				if ( isset( $field['hidden'] ) && $field['hidden'] )
					$class = $this->add_cssclass( 'hidden', $class );
				echo "<div class='{$class}'>{$html}</div>";
			}

			// Allow users to add custom code after meta box content
			// 1st action applies to all meta boxes
			// 2nd action applies to only current meta box
			do_action( 'rwmby_after' );
			do_action( "rwmby_after_{$this->meta_box['id']}" );
		}

		/**
		 * Show begin HTML markup for fields
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function begin_html( $html, $meta, $field )
		{
			$class = 'rwmby-label';
			if ( ! empty( $field['class'] ) )
				$class = self::add_cssclass( $field['class'], $class );

			if ( empty( $field['name'] ) )
				return '<div class="rwmby-input">';

			$html = <<<HTML
<div class="{$class}">
	<label for="{$field['id']}">{$field['name']}</label>
</div>
<div class="rwmby-input">
HTML;

			return $html;
		}

		/**
		 * Show end HTML markup for fields
		 *
		 * @param string $html
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function end_html( $html, $meta, $field )
		{
			$id   = $field['id'];

			$button = '';
			if ( self::is_cloneable( $field ) )
				$button = '<a href="#" class="rwmby-button button-primary add-clone">' . __( '+', 'rwmby' ) . '</a>';

			$desc = ! empty( $field[ 'desc' ] ) ? "<p id='{$id}_description' class='description'>{$field['desc']}</p>" : '';

			// Closes the container
			$html = "{$button}{$desc}</div>";

			return $html;
		}

		/**
		 * Callback function to add clone buttons on demand
		 * Hooks on the flight into the "rwmby_{$field_id}_html" filter before the closing div
		 *
		 * @param string $html
		 * @param array  $field
		 * @param mixed  $meta_data
		 *
		 * @return string $html
		 */
		static function add_delete_clone_button( $html, $field, $meta_data )
		{
			$id = $field['id'];

			$button = '<a href="#" class="rwmby-button button-secondary remove-clone">' . __( '&#8211;', 'rwmby' ) . '</a>';

			return "{$html}{$button}";
		}

		/**
		 * Standard meta retrieval
		 *
		 * @param mixed $meta
		 * @param int	$post_id
		 * @param array $field
		 * @param bool  $saved
		 *
		 * @return mixed
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			$meta = get_post_meta( $post_id, $field['id'], ! $field['multiple'] );

			// Use $field['std'] only when the meta box hasn't been saved (i.e. the first time we run)
			$meta = ( ! $saved && '' === $meta || array() === $meta ) ? $field['std'] : $meta;

			// Escape attributes for non-wysiwyg fields
			if ( 'wysiwyg' !==  $field['type'] )
				$meta = is_array( $meta ) ? array_map( 'esc_attr', $meta ) : esc_attr( $meta );

			return $meta;
		}

		/**************************************************
			SAVE META BOX
		**************************************************/

		/**
		 * Save data from meta box
		 *
		 * @param int $post_id Post ID
		 *
		 * @return int|void
		 */
		function save_post( $post_id )
		{
			global $post_type, $post;
			$post_type_object = get_post_type_object( $post_type );

			// Check whether:
			// - the post is autosaved
			// - the post is a revision
			// - current post type is supported
			// - user has proper capability
			if (
				( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )
				|| ( ! in_array( $post_type, $this->meta_box['pages'] ) )
				|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) )
				)
			{
				return $post_id;
			}

			// Verify nonce and page templates and that the previous save was of the same
      // template type when trying to save page template specific meta data.
      $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
      $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
      $old_template_file = get_post_meta($post->ID, 'old_template_file', true);
      $save_data = false;

      if (!is_array($this->meta_box['excludepagetemplates'])) {
        $this->meta_box['excludepagetemplates'] = array();
      }

      // check for a page template
        if (empty($this->meta_box['pagetemplates'][0])):
          if (!in_array($old_template_file, $this->meta_box['excludepagetemplates'])):
            check_admin_referer( "rwmby-save-{$this->meta_box['id']}", "nonce_{$this->meta_box['id']}" );
            $save_data = true;
          endif;
        else:
          // verify that previous page template was the same as the one being saved before
          // trying to insert values from the previously hidden meta boxes.
          if ($template_file == $this->meta_box['pagetemplates'][0] && $template_file == $old_template_file) {
            if (!in_array($old_template_file, $this->meta_box['excludepagetemplates'])):
			        check_admin_referer( "rwmby-save-{$this->meta_box['id']}", "nonce_{$this->meta_box['id']}" );
              $save_data = true;
            endif;
          }
        endif;

      if ($save_data):
        foreach ( $this->fields as $field )
        {
          $name = $field['id'];
          $old  = get_post_meta( $post_id, $name, ! $field['multiple'] );
          $new  = isset( $_POST[ $name ] ) ? $_POST[ $name ] : ( $field['multiple'] ? array() : '' );

          // Allow field class change the value
          $new = self::apply_field_class_filters( $field, 'value', $new, $old, $post_id );

          // Use filter to change field value
          // 1st filter applies to all fields with the same type
          // 2nd filter applies to current field only
          $new = apply_filters( "rwmby_{$field['type']}_value", $new, $field, $old );
          $new = apply_filters( "rwmby_{$name}_value", $new, $field, $old );

          // Call defined method to save meta value, if there's no methods, call common one
          self::do_field_class_actions( $field, 'save', $new, $old, $post_id );
        }
      endif;
		}

		/**
		 * Common functions for saving field
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int $post_id
		 * @param array $field
		 *
		 * @return void
		 */
		static function save( $new, $old, $post_id, $field )
		{
			$name = $field['id'];

			delete_post_meta( $post_id, $name );
			if ( '' === $new || array() === $new )
				return;

			if ( $field['multiple'] )
			{
				foreach ( $new as $add_new )
				{
					add_post_meta( $post_id, $name, $add_new, false );
				}
			}
			else
			{
				update_post_meta( $post_id, $name, $new );
			}
		}

		/**************************************************
			HELPER FUNCTIONS
		**************************************************/

		/**
		 * Normalize parameters for meta box
		 *
		 * @param array $meta_box Meta box definition
		 *
		 * @return array $meta_box Normalized meta box
		 */
		static function normalize( $meta_box )
		{
			// Set default values for meta box
			$meta_box = wp_parse_args( $meta_box, array(
				'context'  => 'normal',
				'priority' => 'high',
				'pages'    => array( 'post' )
			) );

			// Set default values for fields
			foreach ( $meta_box['fields'] as &$field )
			{
				$clone 	  = (isset($field['clone']) ? $field['clone'] : false);
				$multiple = in_array( $field['type'], array( 'checkbox_list', 'file', 'image' ) ) ;
				$std      = $multiple ? array() : '';
				$format   = 'date' === $field['type'] ? 'yy-mm-dd' : ( 'time' === $field['type'] ? 'hh:mm' : '' );


				$field = wp_parse_args( $field, array(
					'multiple' => $multiple,
					'clone' => $clone,
					'std'      => $std,
					'desc'     => '',
					'format'   => $format
				) );

				$field['field_name'] = $field['id'] . (( $field['multiple'] || $field['clone'])? "[]" : "");

				// Allow field class add/change default field values
				$field = self::apply_field_class_filters( $field, 'normalize_field', $field );
			}

			return $meta_box;
		}

		/**
		 * Get field class name
		 *
		 * @param string $type Field type
		 *
		 * @return bool|string Field class name OR false on failure
		 */
		static function get_class_name( $type )
		{
			$type	= ucwords( $type );
			$class	= "RWMBY_{$type}_Field";

			if ( class_exists( $class ) )
				return $class;

			return false;
		}

		/**
		 * Apply filters by field class, fallback to RW_Meta_Box_Yammer method
		 *
		 * @param array  $field
		 * @param string $method_name
		 * @param mixed  $value
		 *
		 * @return mixed $value
		 */
		static function apply_field_class_filters( $field, $method_name, $value )
		{
			$args	= array_slice( func_get_args(), 2 );
			$args[]	= $field;

			// Call:     field class method
			// Fallback: RW_Meta_Box_Yammer method
			$class = self::get_class_name( $field['type'] );
			if ( method_exists( $class, $method_name ) )
			{
				$value = call_user_func_array( array( $class, $method_name ), $args );
			}
			elseif ( method_exists( __CLASS__, $method_name ) )
			{
				$value = call_user_func_array( array( __CLASS__, $method_name ), $args );
			}

			return $value;
		}

		/**
		 * Call field class method for actions, fallback to RW_Meta_Box method
		 *
		 * @param array  $field
		 * @param string $method_name
		 *
		 * @return mixed
		 */
		static function do_field_class_actions( $field, $method_name )
		{
			$args   = array_slice( func_get_args(), 2 );
			$args[] = $field;

			// Call:     field class method
			// Fallback: RW_Meta_Box method
			$class = self::get_class_name( $field['type'] );
			if ( method_exists( $class, $method_name ) )
			{
				call_user_func_array( array( $class, $method_name ), $args );
			}
			elseif ( method_exists( __CLASS__, $method_name ) )
			{
				call_user_func_array( array( __CLASS__, $method_name ), $args );
			}
		}

		/**
		 * Format Ajax response
		 *
		 * @param string $message
		 * @param string $status
		 *
		 * @return void
		 */
		static function ajax_response( $message, $status )
		{
			$response = array( 'what' => 'meta-box' );
			$response['data'] = 'error' === $status ? new WP_Error( 'error', $message ) : $message;
			$x = new WP_Ajax_Response( $response );
			$x->send();
		}

		/**
		 * Check if meta box has been saved
		 * This helps saving empty value in meta fields (for text box, check box, etc.)
		 *
		 * @param int   $post_id
		 * @param array $fields
		 *
		 * @return bool
		 */
		static function has_been_saved( $post_id, $fields )
		{
			$saved = false;
			foreach ( $fields as $field )
			{
				if ( get_post_meta( $post_id, $field['id'], ! $field['multiple'] ) )
				{
					$saved = true;
					break;
				}
			}
			return $saved;
		}

		/**
		 * Adds a css class
		 * Mainly a copy of the core admin menu function
		 * As the core function is only meant to be used by core internally,
		 * We copy it here - in case core changes functionality or drops the function.
		 *
		 * @param string $add
		 * @param string $class | Class name - Default: empty
		 *
		 * @return string $class
		 */
		static function add_cssclass( $add, $class = '' )
		{
			$class .= empty( $class ) ? $add : " {$add}";

			return $class;
		}


		/**
		 * Helper function to check for multi/clone field IDs
		 *
		 * @param  array $field
		 *
		 * @return bool False if no cloneable
		 */
		static function is_cloneable( $field )
		{
			return $field['clone'];
		}
	}
}

/**
 * Adds [whatever] to the global debug array
 *
 * @param mixed  $input
 * @param string $print_or_export
 *
 * @return array
 */
function rwmby_debug( $input, $print_or_export = 'print' )
{
	global $rwmby_debug;

	$html = 'print' === $print_or_export ? print_r( $input, true ) : var_export( $input, true );

	return $rwmby_debug[] = $html;
}

/**
 * Prints or exports the content of the global debug array at the 'shutdown' hook
 *
 * @return void
 */
function rwmby_debug_print()
{
	global $rwmby_debug;
	if ( ! $rwmby_debug || ( is_user_logged_in() && is_user_admin() ) )
		return;

	$html  = '<h3>' . __( 'RW_Meta_Box_Yammer Debug:', 'rwmby' ) . '</h3><pre>';
	foreach ( $rwmby_debug as $debug )
	{
		$html .= "{$debug}<hr />";
	}
	$html .= '</pre>';

	die( $html );
}

add_action( 'shutdown', 'rwmby_debug_print', 999 );
