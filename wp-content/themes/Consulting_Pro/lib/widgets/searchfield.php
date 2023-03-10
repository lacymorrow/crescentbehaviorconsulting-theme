<?php
/**
 * Add Search Field Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Search Field
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'thinkup_widget_search' ) ) {
	class thinkup_widget_search extends WP_Widget {

		/* Register widget description. */
		public function __construct() {
			$widget_ops = array('classname' => 'thinkup_widget_search', 'description' => 'Display a simple search field.' );
			parent::__construct('thinkup_widget_search', 'ThinkUpThemes: Search', $widget_ops);
		}

		/* Add widget structure to Admin area. */
		function form($instance) {
			$default_entries = array( 'title' => '', 'buttonswitch' => '' , 'buttontext' => '' );
			$instance = wp_parse_args( (array) $instance, $default_entries );

			$title        = $instance['title'];
			$buttonswitch = $instance['buttonswitch'];
			$buttontext   = $instance['buttontext'];

			if ($buttonswitch == 'on') { $buttonswitch_check = 'checked=checked'; }

			echo '<p><label for="' . $this->get_field_id('title') . '">Title: <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" /></label></p>';
		}

		/* Assign variable values. */
		function update($new_instance, $old_instance) {
			$instance                 = $old_instance;
			$instance['title']        = $new_instance['title'];
			$instance['buttonswitch'] = $new_instance['buttonswitch'];
			$instance['buttontext']   = $new_instance['buttontext'];
			return $instance;
		}

		/* Output widget to front-end. */
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			if (!empty($title))
				echo $before_title . $title . $after_title;;

			get_search_form();

			echo $after_widget;
		}

	}
	add_action( 'widgets_init', function() { return register_widget( "thinkup_widget_search" ); } );
}