<?php
// Prevent loading this file directly - Busted!
if( ! class_exists('WP') ) 
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'RWMBY_Select_Field' ) )
{
	class RWMBY_Select_Field
	{
		/**
		 * Enqueue scripts and styles
		 * 
		 * @return	void
		 */
		static function admin_print_styles( ) 
		{
			wp_enqueue_style( 'rwmby-select', RWMBY_CSS_URL.'select.css', RWMBY_VER );
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
			if ( ! is_array( $meta ) )
				$meta = (array) $meta;

			$std		 = isset( $field['disabled'] ) ? $field['disabled'] : false;
			$disabled	 = disabled( $std, true, false );

			$id		 = " id='{$field['id']}'";
			$name	 = " name='{$field['field_name']}'";
			$name	.= $field['multiple'] ? " multiple='multiple'" : "" ;

			$html	 = "<select class='rwmby-select'{$name}{$id}{$disabled}>";
			foreach ( $field['options'] as $key => $value ) 
			{
        if (empty($meta[0])):
          $meta[0] =  $field['std'];
        endif;
				$selected	 = selected( in_array( $key, $meta ), true, false );
				$html		.= "<option value='{$key}'{$selected}>{$value}</option>";
			}
			$html	.= "</select>";

			return $html;
		}
	}
}