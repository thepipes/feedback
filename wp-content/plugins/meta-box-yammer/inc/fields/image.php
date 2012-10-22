<?php
// Prevent loading this file directly - Busted!
if( ! class_exists('WP') )
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'RWMBY_Image_Field' ) )
{
	class RWMBY_Image_Field extends RWMBY_File_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_print_styles()
		{
			// Enqueue same scripts and styles as for file field
			parent::admin_print_styles();

			wp_enqueue_style( 'rwmby-image', RWMBY_CSS_URL.'image.css', array(), RWMBY_VER );

			wp_enqueue_script( 'rwmby-image', RWMBY_JS_URL.'image.js', array( 'jquery-ui-sortable', 'wp-ajax-response' ), RWMBY_VER, true );
		}

		/**
		 * Add actions
		 *
		 * @return void
		 */
		static function add_actions()
		{
			// Do same actions as file field
			parent::add_actions();

			// Reorder images via Ajax
			add_action( 'wp_ajax_rwmby_reorder_images', array( __CLASS__, 'wp_ajax_reorder_images' ) );
		}

		/**
		 * Ajax callback for reordering images
		 *
		 * @return void
		 */
		static function wp_ajax_reorder_images()
		{
			$post_id  = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
			$field_id = isset( $_POST['field_id'] ) ? $_POST['field_id'] : 0;
			$order    = isset( $_POST['order'] ) ? $_POST['order'] : 0;

			check_admin_referer( "rwmby-reorder-images_{$field_id}" );

			parse_str( $order, $items );
			$items = $items['item'];
			$order = 1;
			foreach ( $items as $item )
			{
				wp_update_post( array(
					'ID'          => $item,
					'post_parent' => $post_id,
					'menu_order'  => $order ++
				) );
			}

			RW_Meta_Box_Yammer::ajax_response( __( 'Order saved', 'rwmby' ), 'success' );
		}

		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			global $wpdb;

			$i18n_msg      = _x( 'Uploaded files', 'image upload', 'rwmby' );
			$i18n_del_file = _x( 'Delete this file', 'image upload', 'rwmby' );
			$i18n_delete   = _x( 'Delete', 'image upload', 'rwmby' );
			$i18n_edit     = _x( 'Edit', 'image upload', 'rwmby' );
			$i18n_title    = _x( 'Upload files', 'image upload', 'rwmby' );
			$i18n_more     = _x( 'Add another file', 'image upload', 'rwmby' );

			$html  = wp_nonce_field( "rwmby-delete-file_{$field['id']}", "nonce-delete-file_{$field['id']}", false, false );
			$html .= wp_nonce_field( "rwmby-reorder-images_{$field['id']}", "nonce-reorder-images_{$field['id']}", false, false );
			$html .= "<input type='hidden' class='field-id' value='{$field['id']}' />";

			// Uploaded images
			if ( ! empty( $meta ) )
			{
				$html .= "<h4>{$i18n_msg}</h4>";
				$html .= "<ul class='rwmby-images rwmby-uploaded'>";

				foreach ( $meta as $image )
				{
					$src = wp_get_attachment_image_src( $image, 'thumbnail' );
					$src = $src[0];
					$link = get_edit_post_link( $image );

					$html .= "<li id='item_{$image}'>
						<img src='{$src}' />
						<div class='rwmby-image-bar'>
							<a title='{$i18n_edit}' class='rwmby-edit-file' href='{$link}' target='_blank'>{$i18n_edit}</a> |
							<a title='{$i18n_del_file}' class='rwmby-delete-file' href='#' rel='{$image}'>{$i18n_delete}</a>
						</div>
					</li>";
				}

				$html .= '</ul>';
			}

			// Show form upload
			$html .= "
			<h4>{$i18n_title}</h4>
			<div class='new-files'>
				<div class='file-input'><input type='file' name='{$field['id']}[]' /></div>
				<a class='rwmby-add-file' href='#'>{$i18n_more}</a>
			</div>";

			return $html;
		}

		/**
		 * Standard meta retrieval
		 *
		 * @param mixed 	$meta
		 * @param int		$post_id
		 * @param array  	$field
		 * @param bool  	$saved
		 *
		 * @return mixed
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			global $wpdb;

			$meta = RW_Meta_Box_Yammer::meta( $meta, $post_id, $saved, $field );

			if ( empty( $meta ) )
				return array();

			$meta = implode( ',' , $meta );

			// Re-arrange images with 'menu_order', thanks Onur
			$meta = $wpdb->get_col( "
				SELECT ID FROM {$wpdb->posts}
				WHERE post_type = 'attachment'
				AND ID in ({$meta})
				ORDER BY menu_order ASC
			" );

			return (array) $meta;
		}
	}
}