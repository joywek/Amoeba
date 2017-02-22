<?php
/**
 * Social widget.
 *
 * @package Amoeba
 * @subpackage Amoeba
 * @since 1.0.0
 */

/**
 * Core class used to implement a Social widget.
 */
class AMBSocialWidget extends WP_Widget {

	/**
	 * Sets up a new Social widget instance.
	 *
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_social',
			'description' => __( '' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'social', __( 'Social' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Social widget instance.
	 *
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Social widget instance.
	 */
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Social' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		?>
		<ul class="social">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
		</ul>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Social widget instance.
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
	 * Outputs the settings form for the Social widget.
	 *
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
	}

}
