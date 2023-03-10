<?php
/**
 * Add Tabs Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Tabs
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'thinkup_widget_tabs' ) ) {
	class thinkup_widget_tabs extends WP_Widget {

		/* Register widget description. */
		public function __construct() {
			$widget_ops = array('classname' => 'thinkup_widget_tabs', 'description' => 'Show recent, popular and commented posts in tabs.' );
			parent::__construct('thinkup_widget_tabs', 'ThinkUpThemes: Tabs', $widget_ops);
		}

		/* Add widget structure to Admin area. */
		function form($instance) {
			$default_entries = array( 'title' => '', 'postcount' => '5' );
			$instance = wp_parse_args( (array) $instance, $default_entries );

			$title           = $instance['title'];
			$postcount       = $instance['postcount'];

			echo '<p><label for="' . $this->get_field_id('title') . '">Title: <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="width: 95px;margin-left: 98px;" /></label></p>';
					
			echo '<p><label for="' . $this->get_field_id('postcount') . '">Number of posts: <input class="widefat" id="' . $this->get_field_id('postcount') . '" name="' . $this->get_field_name('postcount') . '" type="text" value="' . esc_attr($postcount) . '" style="width: 106px;margin-left: 20px;" /></label></p>';

		}

		/* Assign variable values. */
		function update($new_instance, $old_instance) {
			$instance                    = $old_instance;
			$instance['title']           = $new_instance['title'];		
			$instance['postcount']       = $new_instance['postcount'];
			return $instance;
		}

		/* Output widget to front-end. */
		function widget($args, $instance) {
		global $post;

			extract($args, EXTR_SKIP);
		 
			/* current instance id */
			$current_instance_id = substr($this->id, strrpos($this->id, '-') + 1);

			echo $before_widget;

			/* Tab navigation */
			echo	'<ul class="nav nav-tabs">',
						'<li class="active"><a href="#widgetpopular-' . $current_instance_id . '" data-toggle="tab"><h3 class="widget-title">' . __( 'Popular', 'consulting' ) . '</h3></a></li>',
						'<li><a href="#widgetrecent-' . $current_instance_id . '" data-toggle="tab"><h3 class="widget-title">' . __( 'Recent', 'consulting' ) . '</h3></a></li>',
					'</ul>';

			/* Main tabs */
			echo	'<div class="tab-content">',
					'<div class="tab-pane fade" id="widgetpopular-' . $current_instance_id . '">';

						$posts = new WP_Query('orderby=comment_count&posts_per_page=' . $instance['postcount'] . '');
						while ($posts->have_posts()) : $posts->the_post();

							/* Insert comments if needed. */
							$comment_count = get_comments_number();
							if ( $comment_count == 0 ) {
								$commentnumber_input = 'No Comments';
							} else if ( $comment_count == 1 ) {
								$commentnumber_input = '1 Comment';
							} else if ( $comment_count > 1 ) {
								$commentnumber_input = $comment_count . ' Comments';
							}
							$comment_input = '<a class="comment" href="' . esc_url( get_permalink() ) . '">' .  $commentnumber_input . '</a>';

							/* HTML output */
							echo '<div class="popular-posts">';
								if ( has_post_thumbnail() ) {
								echo	'<div class="image">',
										'<a href="' . esc_url( get_permalink() ) . '" title="' . get_the_title() . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '<div class="image-overlay"></div></a>',
										'</div>',
										'<div class="main">',
										'<a class="title" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>',
										$comment_input,
										'</div>';
								} else {
								echo	'<div class="main widget-noimage">',
										'<a class="title" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>',
										$comment_input,
										'</div>';
								}
							echo '</div>';
						endwhile; wp_reset_query();

			echo	'</div>',
					'<div class="tab-pane fade active in" id="widgetrecent-' . $current_instance_id . '">';

						$posts = new WP_Query('orderby=date&posts_per_page=' . $instance['postcount'] . '');
						while ($posts->have_posts()) : $posts->the_post();

								$date_input = '<a href="' . esc_url( get_permalink() ) . '" class="date">' .  get_the_date() . '</a>';
						
							/* HTML output */
							echo '<div class="recent-posts">';
								if ( has_post_thumbnail() ) {
								echo	'<div class="image">',
										'<a href="' . esc_url( get_permalink() ) . '" title="' . get_the_title() . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '<div class="image-overlay"></div></a>',
										'</div>',
										'<div class="main">',
										'<a class="title" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>',
										$date_input,
										'</div>';
								} else {
								echo	'<div class="main widget-noimage">',
										'<a class="title" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>',
										$date_input,
										'</div>';
								}
							echo '</div>';
						endwhile; wp_reset_query();

			echo	'</div>',
					'</div>';

			echo $after_widget;
		  }

	}
	add_action( 'widgets_init', function() { return register_widget( "thinkup_widget_tabs" ); } );
}