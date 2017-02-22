<?php
/**
 * Profile widget.
 *
 * @package Amoeba
 * @subpackage Amoeba
 * @since 1.0.0
 */

/**
 * Core class used to implement a Profile widget.
 */
class AMBProfileWidget extends WP_Widget {

	/**
	 * Sets up a new Profile widget instance.
	 *
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_profile',
			'description' => __( 'A short information for user.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'profile', __( 'Profile' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Profile widget instance.
	 *
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Profile widget instance.
	 */
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Profile' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$user = wp_get_current_user();

		$desc = esc_html(get_the_author_meta('description', $user->user_ID));
		if (trim($desc) === '') {
			$desc = 'Apparently, this user prefers to keep an air of mystery about them.';
		}
		?>
		<div class="profile">
			<img class="profile-avatar" src="<?php echo get_avatar_url($user->user_ID, null); ?>" />
			<h2 class="profile-title"><?php echo $user->display_name; ?></h2>
			<p class="profile-biographical-info"><?php echo $desc; ?></p>
		</div>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Profile widget instance.
	 *
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		return $instance;
	}

	/**
	 * Outputs the settings form for the Profile widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
	}

}
