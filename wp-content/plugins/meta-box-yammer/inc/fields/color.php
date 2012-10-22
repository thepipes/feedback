<?php
// Prevent loading this file directly - Busted!
if( ! class_exists('WP') )
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'RWMBY_Color_Field' ) )
{
	class RWMBY_Color_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_print_styles()
		{
			wp_enqueue_style( 'rwmby-color', RWMBY_CSS_URL.'color.css', array( 'farbtastic' ), RWMBY_VER );
			wp_enqueue_script( 'rwmby-color', RWMBY_JS_URL.'color.js', array( 'farbtastic' ), RWMBY_VER, true );
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
			if ( empty( $meta ) )
				$meta = '#';
			$name = "name='{$field['field_name']}'";

			$html = <<<HTML
<input class="rwmby-color" type="text" {$name} id="{$field['id']}" value="{$meta}" size="8" />
<a href="#" class="rwmby-color-select" rel="{$field['id']}">%s</a>
<div class="rwmby-color-picker" rel="{$field['id']}"></div>
HTML;
			$html = sprintf( $html, __( 'Select a color', 'rwmby' ) );

			return $html;
		}
	}
}