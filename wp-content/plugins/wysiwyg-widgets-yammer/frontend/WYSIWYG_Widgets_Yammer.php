<?php

if(!class_exists('WYSIWYG_Widgets_Yammer')) {

	class WYSIWYG_Widgets_Yammer {
			
		public function __construct()
		{
                    add_action('widgets_init',array(&$this,'register_widget'));
                    add_filter( 'widget_text', 'shortcode_unautop');
                    add_filter( 'widget_text', 'do_shortcode');
		}
		
		/** Register the WYSIWYG Widgets Widget */
		function register_widget()
		{
			return register_widget('WYSIWYG_Widgets_Yammer_Widget');
		}
		
	}

}