<?php
/**
 * Blog navigation widget.
 *
 * @package Amoeba
 * @subpackage Amoeba
 * @since 1.0.0
 */

/**
 * Core class used to implement a Blog Navigation widget.
 */
class AMBBlogNavigationWidget extends WP_Widget {

	/**
	 * Sets up a new Blog Navigation widget instance.
	 *
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_blog_nav',
			'description' => __( 'A short navigation for blog, containing archives, categories and tags.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'blog-nav', __( 'Blog Navigation' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Blog Navigation widget instance.
	 *
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Blog Navigation widget instance.
	 */
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Blog Navigation' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$user = wp_get_current_user();

		$desc = esc_html(get_the_author_meta('description', $user->user_ID));
		if (trim($desc) === '') {
			$desc = 'Apparently, this user prefers to keep an air of mystery about them.';
		}

		$request_uri = $_SERVER['REQUEST_URI'];

		?>
		<ul>
			<li class="nav-item-arc<?php echo $request_uri == '/archives/' ? ' current' : '' ?>"><a href="<?php echo get_home_url(), '/archives/' ?>"><?php _e('Archives', 'amoeba'); ?></a>
			<li class="nav-item-cat<?php echo $request_uri == '/categories/' ? ' current' : '' ?>"><a href="<?php echo get_home_url(), '/categories/' ?>"><?php _e('Categories', 'amoeba'); ?></a>
			<li class="nav-item-tag<?php echo $request_uri == '/tags/' ? ' current' : '' ?>"><a href="<?php echo get_home_url(), '/tags/' ?>"><?php _e('Tags', 'amoeba'); ?></a>
		</ul>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Blog Navigation widget instance.
	 *
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		//$instance = $old_instance;
		//$instance['title'] = sanitize_text_field( $new_instance['title'] );
		//$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		//$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		//$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Blog Navigation widget.
	 *
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
	}

}
