<?php
if (!class_exists('WYSIWYG_Widgets_Yammer_Widget')) {

    class WYSIWYG_Widgets_Yammer_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'wysiwyg_widget widget_text', 'description' => __('A widget with a WYSIWYG / Rich Text editor - supports media uploading'));
            $control_ops = array('width' => 560, 'height' => 400);
			$id_base = 'wysiwyg_widget_yammer';
            parent::__construct($id_base, 'WYSIWYG Widget (Yammer)', $widget_ops, $control_ops);
        }

        function widget($args, $instance) {
            extract($args);
            $show_panel = apply_filters('widget_show_panel', empty($instance['show_panel']) ? '' : $instance['show_panel'], $instance, "YES");
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            $text = apply_filters('widget_text', $instance['text'], $instance);
            $widget_class = ($show_panel == "YES") ? "panel-right" : "right";

            // Add unique class name using widgets title for widget specific CSS
            $widget_class .= ' '.strtolower(str_replace(' ', '-', $instance['title']));

            // Insert class to display inside a panel or without the panel depending on users selection.
            echo str_replace("{{panel}}", $widget_class, $before_widget);
            
            if (!empty($title)) {
                echo $before_title . $title . $after_title;
            }

            // Check for Vimeo link and get ID;
            preg_match_all('#(https://vimeo.com)/([0-9]+)#i',$text,$output);
            $vimeo_id = $output[2][0];
            $text = str_replace('http://player.vimeo.com', 'https://player.vimeo.com',str_replace('https://vimeo.com/'.$vimeo_id,wp_oembed_get('https://vimeo.com/'.$vimeo_id, array('width' => 240)).'<br style="line-height: 18px;" />',$text));
            ?>

            <div class="wysiwygwidget"><?php echo wpautop($text); ?></div>
            
            <?php
            echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;

            $instance['show_panel'] = strip_tags($new_instance['show_panel']);
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['type'] = strip_tags($new_instance['type']);
            
            if (current_user_can('unfiltered_html'))
                $instance['text'] = $new_instance['text'];
            else
                $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));

            return $instance;
        }

        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => '', 'text' => '', 'type' => 'visual'));

            $show_panel = strip_tags($instance['show_panel']);
            $title = strip_tags($instance['title']);
            $text = $instance['text'];
            $type = esc_textarea($instance['type']);
            
            ?>
            <span class="wysiwyg_widget"></span>
            <input id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="wwe_type" type="hidden" value="<?php echo esc_attr($type); ?>" />

            <p>
              <label for="<?php echo $this->get_field_id('show_panel'); ?>"><?php _e('Show Panel:'); ?></label>

              <select class="widefat" id="<?php echo $this->get_field_id('show_panel'); ?>" name="<?php echo $this->get_field_name('show_panel'); ?>">
                <option value="YES"<?php echo ($show_panel == "YES") ? " selected" : ""; ?>>Yes</option>
                <option value="NO"<?php echo ($show_panel == "NO") ? " selected" : ""; ?>>No</option>
              </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>


            <div class="wwe_container">
                <?php wp_editor($text, $this->get_field_id('text'), array( 'textarea_name' => $this->get_field_name('text'), 'textarea_rows' => 25 )) ?>
            </div>
            
            <?php
        }

    }

}