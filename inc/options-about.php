<?php

require_once('options-base.php');

class ThemeAboutOptionsPage extends OptionsBasePage {

	function __construct() {
		$this->menu_slug = 'amoeba-options-about';
		$this->page_title = __('About Settings');
		$this->menu_title = __('About');
		$this->option_key = 'amoeba_option_about';
	}

	function register_settings() {

		$this->options = get_option('amoeba_option_about');
		register_setting($this->option_key, $this->option_key);

		add_settings_section('profile_section', __("Profile"), null, $this->menu_slug);
		add_settings_field(
			'name',
			__('Name'),
			array($this, 'display_name_field'),
			$this->menu_slug,
			'profile_section');
		add_settings_field(
			'status',
			__('Status'),
			array($this, 'display_status_field'),
			$this->menu_slug,
			'profile_section');
		add_settings_field(
			'introduction',
			__('Biographical Info'),
			array($this, 'display_introduction_field'),
			$this->menu_slug,
			'profile_section');

		add_settings_section('social_section', __("Social"), null, $this->menu_slug);
		add_settings_field(
			'facebook',
			__('Facebook'),
			array($this, 'display_facebook_field'),
			$this->menu_slug,
			'social_section');
		add_settings_field(
			'twitter',
			__('Twitter'),
			array($this, 'display_twitter_field'),
			$this->menu_slug,
			'social_section');
		add_settings_field(
			'linkedin',
			__('Linkedin'),
			array($this, 'display_linkedin_field'),
			$this->menu_slug,
			'social_section');
	}
	
	function display_name_field() {
		echo '<input type="text" id="about-profile-name" name="', $this->option_key, '[profile][name]" value="', 
			$this->options['profile']['name'], '" class="regular-text" />';
	}

	function display_status_field() {
		echo '<input type="text" id="about-profile-status" name="', $this->option_key, '[profile][status]" value="', 
			$this->options['profile']['status'], '" class="large-text" />';
	}

	function display_introduction_field() {
		echo '<textarea id="about-profile-introduction" name="', $this->option_key, '[profile][introduction]" rows="8" class="large-text code">',
			amoeba_get_option($this->options, 'profile', 'introduction'), '</textarea>';
	}

	function display_facebook_field() {
		echo '<input type="text" id="about-social-facebook" name="', $this->option_key, '[social][facebook]" value="', 
			amoeba_get_option($this->options, 'social', 'facebook'), '" class="regular-text" />';
	}

	function display_twitter_field() {
		echo '<input type="text" id="about-social-twitter" name="', $this->option_key, '[social][twitter]" value="', 
			amoeba_get_option($this->options, 'social', 'twitter'), '" class="regular-text" />';
	}
	
	function display_linkedin_field() {
		echo '<input type="text" id="about-social-linkedin" name="', $this->option_key, '[social][linkedin]" value="', 
			amoeba_get_option($this->options, 'social', 'linkedin'), '" class="regular-text" />';
	}
}

?>
