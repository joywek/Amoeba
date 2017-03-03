<?php

if (!function_exists('amoeba_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Amoeba .0
 */
function amoeba_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Amoeba, use a find and replace
	 * to change 'amoeba' to the name of your theme in all the template files
	 */
	load_theme_textdomain('amoeba', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Amoeba 1.0
	 */
	add_theme_support('custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	));

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1200, 9999);

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'amoeba'),
		'social'  => __('Social Links Menu', 'amoeba'),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	));

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style(array('css/editor-style.css', amoeba_fonts_url()));

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support('customize-selective-refresh-widgets');

	$pages = array(
		array('ID' => 'amoeba_archives_page', 'title' => __('Archives')),
		array('ID' => 'amoeba_categories_page', 'title' => __('Categories')),
		array('ID' => 'amoeba_tags_page', 'title' => __('Tags'))
	);
	foreach ($pages as $page) {
		$pageid = get_option($page['ID']);
		$params = array(
			'ID'           => $pageid,
			'post_type'    => 'page',
			'post_title'   => $page['title'],
			'post_status'  => 'publish',
		);
		$pageid = wp_insert_post($params);
		update_option($page['ID'], $pageid);
	}
}
endif; // amoeba_setup
add_action('after_setup_theme', 'amoeba_setup');

/**
 * Enqueue scripts and styles.
 */
function amoeba_scripts() {
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/4.7.0/css/font-awesome.min.css');

	if (is_page('about')) {
		wp_enqueue_style('amoeba-style', get_template_directory_uri() . '/css/about.css');
	}
	else {
		wp_enqueue_style('amoeba-style', get_template_directory_uri() . '/css/blog.css');
	}

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script('amoeba-js', get_template_directory_uri() . '/js/amoeba.js', array('jquery'), '');  
}
add_action('wp_enqueue_scripts', 'amoeba_scripts');


if (!function_exists('amoeba_fonts_url')) :
/**
 * Register Google fonts for Amoeba.
 *
 * Create your own amoeba_fonts_url() function to override in a child theme.
 *
 * @since Amoeba 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function amoeba_fonts_url() {
	return '';
}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function amoeba_widgets_init() {

	register_widget('AMBProfileWidget');
	register_widget('AMBBlogNavigationWidget');
	register_widget('AMBSocialWidget');

	register_sidebar(array(
		'name'          => esc_html__('Blog Sidebar', 'amoeba'),
		'id'            => 'blog-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));

	//Register widget areas for the Widgetized page template
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-templates/page_widgetized.php',
	));

	foreach($pages as $page){
		register_sidebar(array(
			'name'          => esc_html__('Page - ', 'amoeba') . $page->post_title,
			'id'            => 'widget-area-' . strtolower($page->post_name),
			'description'   => esc_html__('Use this widget area to build content for the page: ', 'amoeba') . $page->post_title,
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="atblock container">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title"><span class="title-decoration"></span>',
			'after_title'   => '</h2>',
		));
	}
}
add_action('widgets_init', 'amoeba_widgets_init');

add_filter('wp_generate_tag_cloud', function($content, $tags, $args) {
	$count = 0;
	$output = preg_replace_callback(
		'/(<a\s.*>).*(<\/a>)/U',
		function($match) use ($tags, &$count) {
			return "$match[1]<span class=\"name\">" . $tags[$count]->name . '</span><span class="count">' . $tags[$count++]->count . "</span>$match[2]"; 
		},
		$content);
	return preg_replace("/style='font-size:.+pt;'/", '', $output);
}, 10, 3);

add_filter('body_class', function($c) {
	if (!is_active_sidebar('blog-sidebar')) {
		$c[] = 'nosidebar';
	}
	return $c;
});

add_action('template_redirect', function() {
	if ($_SERVER['REQUEST_URI'] == '/tags/') {
		amoeba_load_template(TEMPLATEPATH . '/tags.php');
		exit;
	}
});

function amoeba_get_option($options, $section, $name, $default_value = '') {
	if (!empty($options)) {
		if ($section) {
			if (isset($options[$section])) {
				$section = $options[$section];
			}
		} else {
			$section = &$options;
		}
		if (isset($section[$name])) {
			return $section[$name];
		}
	}
	return $default_value;
}

function amoeba_load_template($path) {
	global $wp_query;
	if ($wp_query->is_404) {
		$wp_query->is_404 = false;
		$wp_query->is_archive = true;
	}
	header("HTTP/1.1 200 OK");
	include($path);
}

require_once('inc/parsedown.php');
function amoeba_markdown($text) {
	$md = new Parsedown();
	echo $md->text($text);
}

add_filter( 'widget_meta_poweredby', '__return_empty_string' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/options.php';
require get_template_directory() . '/widgets/profile.php';
require get_template_directory() . '/widgets/blog-navigation.php';
require get_template_directory() . '/widgets/social.php';
//require get_template_directory() . '/inc/options-demo.php';

?>
