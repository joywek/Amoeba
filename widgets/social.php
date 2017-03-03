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
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Social' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$default_list = array('facebook', 'twitter', 'linkedin', 'weibo', 'rss');

		foreach ($default_list as &$item) {
			if (!empty($instance[$item . '-url'])) {
				$keys[] = $instance[$item . '-url'];
				$values[] = $instance[$item . '-order'];
				$display_list[] = $item;
			}
		}

		//uasort($display_list, function($a, $b) use($instance) {
		//	return $instance[$a . '-order'] >= $instance[$b . '-order'];
		//});
		array_multisort($values, SORT_DESC, $keys, SORT_DESC, $display_list);
		
		echo '<ul class="social">';
		foreach ($display_list as &$item) {
			echo '<li><a href="', $instance[$item . '-url'], '" target="_blank"><i class="fa fa-', $item, '"></i></a></li>';
		}
		echo '</ul>';

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
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['facebook-url'] = sanitize_text_field( $new_instance['facebook-url'] );
		$instance['facebook-order'] = $new_instance['facebook-order'];
		$instance['twitter-url'] = sanitize_text_field( $new_instance['twitter-url'] );
		$instance['twitter-order'] = $new_instance['twitter-order'];
		$instance['linkedin-url'] = sanitize_text_field( $new_instance['linkedin-url'] );
		$instance['linkedin-order'] = $new_instance['linkedin-order'];
		$instance['weibo-url'] = sanitize_text_field( $new_instance['weibo-url'] );
		$instance['weibo-order'] = $new_instance['weibo-order'];
		$instance['rss-url'] = sanitize_text_field( $new_instance['rss-url'] );
		$instance['rss-order'] = $new_instance['rss-order'];
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
	?>
		<table>
			<tr style="font-weight:bold;height:36px;">
				<td>Social</td><td style="width:100%">URL</td><td>Order</td>
			</tr>
		<?php
			$this->tr($instance, 'Facebook'); 
			$this->tr($instance, 'Twitter'); 
			$this->tr($instance, 'Linkedin'); 
			$this->tr($instance, 'Weibo'); 
			$this->tr($instance, 'RSS'); 
		?>
		</table>

	<?php
	}

	function tr($instance, $title) {
		$name = strtolower($title);
		$url_key = $name . '-url';
		$order_key = $name . '-order';

		$url = isset($instance[$url_key]) ? $instance[$url_key] : '';
		$order = empty($instance[$order_key]) ? "1" : $str;

	?>
		<tr>
		<td><?php echo $title; ?></td>
			<td><input class="widefat" id="rss-url" name="<?php echo $this->get_field_name($url_key) ?>" type="text" value="<?php echo $url; ?>" /></td>
			<td><input class="tiny-text" id="rss-order" name="<?php echo $this->get_field_name($order_key); ?>" type="number" step="1" min="1" size="3" value="<?php echo $order; ?>" /></td>
		</tr>
	<?php
	}

	function sanitize_url($str) {
		echo isset($str) ? $str : '';
	}

	function sanitize_order($str) {
		echo (!isset($str) || empty($str)) ? "1" : $str;
	}

}
