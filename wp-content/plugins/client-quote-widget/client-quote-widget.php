<?php
/*
Plugin Name: Client Quote Widget
Description: Simple widget to add quotes .
Author: Yammer
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

// Load the widget on widgets_init
function yammer_load_client_quote_widget() {
	register_widget('Yammer_Client_Quote_Widget');
}
add_action('widgets_init', 'yammer_load_client_quote_widget');

/**
 * Yammer_Client_Quote_Widget class
 **/
class Yammer_Client_Quote_Widget extends WP_Widget {

	var $pluginDomain = 'sp_client_quote_widget';

	/**
	 * SP Client Quote Widget constructor
	 *
	 * @author Yammer
	 */
	function Yammer_Client_Quote_Widget() {
		$this->loadPluginTextDomain();
		$widget_ops = array( 'classname' => 'widget_sp_client_quote', 'description' => __( 'Display a single quote ', $this->pluginDomain ) );
		$control_ops = array( 'id_base' => 'widget_sp_client_quote' );
		$this->WP_Widget('widget_sp_client_quote', __('Client Quote Widget', $this->pluginDomain), $widget_ops, $control_ops);
		$this->register_scripts_and_styles();

		global $pagenow;
		if (defined("WP_ADMIN") && WP_ADMIN) {
			add_action( 'admin_init', array( $this, 'fix_async_upload_image' ) );

			if ( 'widgets.php' == $pagenow ) {
				wp_enqueue_style( 'thickbox' );
				wp_enqueue_script( 'yammer-client-quote-widget' );
				add_action( 'admin_head-widgets.php', array( $this, 'admin_head' ) );
			}
			elseif ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
				wp_enqueue_script( 'fix-browser-upload' );
				add_filter( 'image_send_to_editor', array( $this,'image_send_to_editor'), 1, 8 );
				add_filter( 'gettext', array( $this, 'replace_text_in_thickbox' ), 1, 3 );
				add_filter( 'media_upload_tabs', array( $this, 'media_upload_tabs' ) );
			}
		}

	}

	function register_scripts_and_styles() {
		$dir = plugins_url('/', __FILE__);
		wp_register_script( 'yammer-client-quote-widget', $dir . 'client-quote-widget.js', array('jquery','thickbox'), false, true );
	}

	function fix_async_upload_image() {
		if(isset($_REQUEST['attachment_id'])) {
			$id = (int) $_REQUEST['attachment_id'];
			$GLOBALS['post'] = get_post( $id );
		}
	}

	function loadPluginTextDomain() {
		load_plugin_textdomain( $this->pluginDomain, false, trailingslashit(basename(dirname(__FILE__))) . 'lang/');
	}

	/**
	 * Retrieve resized image URL
	 *
	 * @param int $id Post ID or Attachment ID
	 * @param int $width desired width of image (optional)
	 * @param int $height desired height of image (optional)
	 * @return string URL
	 * @author Yammer
	 */
	function get_image_url( $id, $width=false, $height=false ) {

		/**/
		// Get attachment and resize but return attachment path (needs to return url)
		$attachment = wp_get_attachment_metadata( $id );
		$attachment_url = wp_get_attachment_url( $id );
		if (isset($attachment_url)) {
			if ($width && $height) {
				$uploads = wp_upload_dir();
				$imgpath = $uploads['basedir'].'/'.$attachment['file'];
				if (WP_DEBUG) {
					error_log(__CLASS__.'->'.__FUNCTION__.'() $imgpath = '.$imgpath);
				}
				$image = image_resize( $imgpath, $width, $height );
				if ( $image && !is_wp_error( $image ) ) {
					$image = path_join( dirname($attachment_url), basename($image) );
				} else {
					$image = $attachment_url;
				}
			} else {
				$image = $attachment_url;
			}
			if (isset($image)) {
				return $image;
			}
		}
	}

	/**
	 * Test context to see if the uploader is being used for the image widget or for other regular uploads
	 *
	 * @author Yammer
	 */
	function is_sp_widget_context() {
		if ( isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],$this->id_base) !== false ) {
			return true;
		} elseif ( isset($_REQUEST['_wp_http_referer']) && strpos($_REQUEST['_wp_http_referer'],$this->id_base) !== false ) {
			return true;
		} elseif ( isset($_REQUEST['widget_id']) && strpos($_REQUEST['widget_id'],$this->id_base) !== false ) {
			return true;
		}
		return false;
	}

	/**
	 * Somewhat hacky way of replacing "Insert into Post" with "Insert into Widget"
	 *
	 * @param string $translated_text text that has already been translated (normally passed straight through)
	 * @param string $source_text text as it is in the code
	 * @param string $domain domain of the text
	 * @author Yammer
	 */
	function replace_text_in_thickbox($translated_text, $source_text, $domain) {
		if ( $this->is_sp_widget_context() ) {
			if ('Insert into Post' == $source_text) {
				return __('Insert Into Widget', $this->pluginDomain );
			}
		}
		return $translated_text;
	}

	/**
	 * Filter image_end_to_editor results
	 *
	 * @param string $html
	 * @param int $id
	 * @param string $alt
	 * @param string $title
	 * @param string $align
	 * @param string $url
	 * @param array $size
	 * @return string javascript array of attachment url and id or just the url
	 * @author Yammer
	 */
	function image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt = '' ) {
		// Normally, media uploader return an HTML string (in this case, typically a complete image tag surrounded by a caption).
		// Don't change that; instead, send custom javascript variables back to opener.
		// Check that this is for the widget. Shouldn't hurt anything if it runs, but let's do it needlessly.
		if ( $this->is_sp_widget_context() ) {
			if ($alt=='') $alt = $title;
			?>
			<script type="text/javascript">
				// send image variables back to opener
				var win = window.dialogArguments || opener || parent || top;
				win.IW_html = '<?php echo addslashes($html); ?>';
				win.IW_img_id = '<?php echo $id; ?>';
				win.IW_alt = '<?php echo addslashes($alt); ?>';
				win.IW_caption = '<?php echo addslashes($caption); ?>';
				win.IW_title = '<?php echo addslashes($title); ?>';
				win.IW_align = '<?php echo esc_attr($align); ?>';
				win.IW_url = '<?php echo esc_url($url); ?>';
				win.IW_size = '<?php echo esc_attr($size); ?>';
			</script>
			<?php
		}
		return $html;
	}

	/**
	 * Remove from url tab until that functionality is added to widgets.
	 *
	 * @param array $tabs
	 * @author Yammer
	 */
	function media_upload_tabs($tabs) {
		if ( $this->is_sp_widget_context() ) {
			unset($tabs['type_url']);
		}
		return $tabs;
	}


	/**
	 * Widget frontend output
	 *
	 * @param array $args
	 * @param array $instance
	 * @author Yammer
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $title ) ? '' : $title );

		include( $this->getTemplateHierarchy( 'widget' ) );
	}

	/**
	 * Update widget options
	 *
	 * @param object $new_instance Widget Instance
	 * @param object $old_instance Widget Instance
	 * @return object
	 * @author Yammer
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['image'] = $new_instance['image'];
		$instance['imageurl'] = $this->get_image_url($new_instance['image']);  // image resizing not working right now
		if( $_SERVER["HTTPS"] == "on" ) {
			$instance['imageurl'] = str_replace('http://', 'https://', $instance['imageurl']);
		}
    $instance['client_id'] = $new_instance['client_id'];
    $instance['quote_id'] = $new_instance['quote_id'];

		return $instance;
	}

	/**
	 * Form UI
	 *
	 * @param object $instance Widget Instance
	 * @author Yammer
	 */
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(
			'image' => '',
			'imageurl' => '',
      'client_id' => '',
      'quote_id' => ''
		) );
		include( $this->getTemplateHierarchy( 'widget-admin' ) );
	}

	/**
	 * Admin header css
	 *
	 * @author Yammer
	 */
	function admin_head() {
		?>
		<style type="text/css">
			.aligncenter {
				display: block;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
		<?php
	}

	/**
	 * Loads theme files in appropriate hierarchy: 1) child theme,
	 * 2) parent template, 3) plugin resources. will look in the quote-widget/
	 * directory in a theme and the views/ directory in the plugin
	 *
	 * @param string $template template file to search for
	 * @return template path
	 * @author Yammer
	 **/

	function getTemplateHierarchy($template) {
		// whether or not .php was added
		$template_slug = rtrim($template, '.php');
		$template = $template_slug . '.php';

		if ( $theme_file = locate_template(array('quote-widget/'.$template)) ) {
			$file = $theme_file;
		} else {
			$file = 'views/' . $template;
		}
		return apply_filters( 'sp_template_client_quote-widget_'.$template, $file);
	}
}
