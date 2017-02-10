<?php

class ThemeAnalyticsOptionsPage {

	public $menu_slug = 'amoeba-options-analytics';
	public $page_title;
	public $menu_title;

	function __construct() {
		$this->page_title = __('Analytics Settings');
		$this->menu_title = __('Analytics');
	}

	function register_settings() {
		add_settings_section('analytics_section', __('Analytics Settings'), null, $this->menu_slug);
		add_settings_field(
			'trackgin_id', 
			__('Trackgin ID'), 
			array($this, 'display_tracking_id_field'),
			$this->menu_slug, 
			'analytics_section');
	}
	
	function display_tracking_id_field() {
		echo '<input type="text" id="tracking_id" name="amoeba_options[analytics][tracking_id]" value="', 
			$this->options['analytics']['tracking_id'], '" />';
	}

}

?>
