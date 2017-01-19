<?php

namespace amoeba {

	class ThemeSettingsPage {

		private $options;
		private $menu_slug = 'amoeba-theme-settings';
		private $options_group = 'amoeba_options_group';

		function __construct() {
			add_action('admin_menu', array($this, 'setup_menu'));
			add_action('admin_init', array($this, 'register_settings'));
		}

		public function setup_menu() {
			add_options_page(
				__('Amoeba Settings'), // Page title
				__('Amoeba'), // Menu title
				'manage_options', 
				$this->menu_slug, 
				array($this, 'render'));
		}

		function register_settings() {
			register_setting($this->options_group, 'amoeba_options', array($this, 'sanitize_options'));
			add_settings_section('analytics_section', __('Analytics Settings'), null, $this->menu_slug);

			add_settings_field(
				'trackgin_id', 
				__('Trackgin ID'), 
				array($this, 'display_tracking_id_field'),
				$this->menu_slug, 
				'analytics_section');
		}

		function render() {
			$this->options = get_option('amoeba_options');
		?>
			<div class="wrap">
				<h1>Amoeba Settings</h1>
				<form name="form" action="options.php" method="post">
				<?php
					settings_fields($this->options_group);
					do_settings_sections($this->menu_slug);
					submit_button();
				?>
				</form>
			</div>
		<?php
		}

		function sanitize_options($options) {
			return $options;
		}

		function display_tracking_id_field() {
			echo '<input type="text" id="tracking_id" name="amoeba_options[analytics][tracking_id]" value="', 
				$this->options['analytics']['tracking_id'], '" />';
		}
	}

	$mgr = new ThemeSettingsPage();

}

?>
