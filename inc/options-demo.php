<?php

$options = null;

function theme_settings_page() {
	global $options;
	$options = get_option('mytheme_options');
?>
	<div class="wrap">
		<h1>My Theme Settings</h1>
		<form method="post" action="options.php">
		<?php 
			settings_fields('mytheme_options_group');
			do_settings_sections('mytheme-settings');
			submit_button();
		?>
		</form>
	</div>
<?php
}

function setup_menu() {
	add_options_page(
		__('My Theme Settings'), 	// page title
		__('MyTheme'),			 	// menu title
		'manage_options', 
		'mytheme-settings',		// menu slug
		'theme_settings_page'		// callback
	);
}
add_action("admin_menu", "setup_menu");

function register_settings() {
	register_setting('mytheme_options_group', 'mytheme_options');

	add_settings_section('analytics_section', __('Google Analytics'), null, 'mytheme-settings');
	add_settings_field('trackging_id', __('Tracking ID'), 'display_tracking_id_element', 'mytheme-settings', 'analytics_section');
	
	add_settings_section('social_section', __('Social'), null, 'mytheme-settings');
	add_settings_field('twitter_url', __('Twitter Profile Url'), 'display_twitter_element', 'mytheme-settings', 'social_section');
    add_settings_field('facebook_url', __('Facebook Profile Url'), 'display_facebook_element', 'mytheme-settings', 'social_section');
}
add_action("admin_init", "register_settings");

function display_tracking_id_element() {
	global $options;
?>
   	<input type="text" name="mytheme_options[analytics][tracking_id]" id="tracking_id" value="<?php echo $options['analytics']['tracking_id']; ?>" />
<?php
}

function display_twitter_element() {
	global $options;
?>
   	<input type="text" name="mytheme_options[social][twitter_url]" id="twitter_url" value="<?php echo $options['social']['twitter_url']; ?>" />
<?php
}

function display_facebook_element() {
	global $options;
?>
	<input type="text" name="mytheme_options[social][facebook_url]" id="facebook_url" value="<?php echo $options['social']['facebook_url']; ?>" />
<?php
}

?>
