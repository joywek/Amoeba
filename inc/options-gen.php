<?php

require_once('options-base.php');

class ThemeGeneralOptionsPage extends OptionsBasePage {

	function __construct() {
		$this->menu_slug = 'amoeba-options-general';
		$this->page_title = __('General Settings', 'amoeba');
		$this->menu_title = __('General', 'amoeba');
		$this->option_key = 'amoeba_options_general';
	}

	function register_settings() {
		$this->options = get_option($this->option_key);
		register_setting($this->option_key, $this->option_key);
		add_settings_section('privacy_section', __('Privacy Settings', 'amoeba'), null, $this->menu_slug);
		add_settings_field(
			'privacy-page', 
			__('Privacy Page', 'amoeba'), 
			array($this, 'display_privacy_field'),
			$this->menu_slug, 
			'privacy_section');
	}
	
	function display_privacy_field() {
		wp_dropdown_pages(array(
			'id' => 'privacy_page',
			'name' => $this->option_key . '[privacy_page]',
			'echo' => 1,
			'show_option_none' => __( '&mdash; Select &mdash;' ),
			'option_none_value' => '0',
			'selected' => $this->options['privacy_page']
		));
	}

}

?>
