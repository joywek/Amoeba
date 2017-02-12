<?php

require_once('options-base.php');

class ThemeAnalyticsOptionsPage extends OptionsBasePage {

	function __construct() {
		$this->menu_slug = 'amoeba-options-analytics';
		$this->page_title = __('Analytics Settings', 'amoeba');
		$this->menu_title = __('Analytics', 'amoeba');
		$this->option_key = 'amoeba_options_analytics';
	}

	function register_settings() {
		$this->options = get_option($this->option_key);
		register_setting($this->option_key, $this->option_key);
		add_settings_section('analytics_section', __('Analytics Settings', 'amoeba'), null, $this->menu_slug);
		add_settings_field(
			'trackgin_id', 
			__('Trackgin ID', 'amoeba'), 
			array($this, 'display_tracking_id_field'),
			$this->menu_slug, 
			'analytics_section');
	}
	
	function display_tracking_id_field() {
		echo '<input type="text" id="analytics-tracking-id" name="', $this->option_key, '[tracking_id]" value="', 
			$this->options['tracking_id'], '" class="regular-text" />';
	}

}

?>
