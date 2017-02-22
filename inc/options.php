<?php

require_once('options-gen.php');
require_once('options-about.php');
require_once('options-analytics.php');

class ThemeOptionsManager {

	private $pages;

	function __construct() {

		$this->pages = array(
			new ThemeGeneralOptionsPage(),
			new ThemeAboutOptionsPage(),
			new ThemeAnalyticsOptionsPage(),
		);

		add_action('admin_menu', array($this, 'setup_menu'));
		add_action('admin_init', array($this, 'register_settings'));
	}

	public function setup_menu() {

		$pages = $this->pages;
		$home_page = $pages[0];

		add_menu_page(
			$home_page->page_title, // Page title
			__('Amoeba', 'amoeba'), // Menu title
			'manage_options', // The capability required for this menu to be displayed to the user 
			$home_page->menu_slug, // The slug name to refer to this menu by (should be unique for this menu).
			array($home_page, 'render_page'));

		foreach ($pages as &$page) {
			add_submenu_page(
				$home_page->menu_slug,
				$page->page_title, // Page title
				$page->menu_title, // Menu title
				'manage_options',
				$page->menu_slug,
				array($page, 'render_page'));
		}
	}

	function register_settings() {
		foreach ($this->pages as &$page) {
			$page->register_settings();
		}
	}

}

$mgr = new ThemeOptionsManager();

?>
