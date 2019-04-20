<?php

if (!function_exists('console_log')) :
function console_log( $data ){
	$tag = '[AMOEBA]';
	$date = date_format(date_create(), 'Y-m-d H:i:s:u');
	echo '<script>';
	echo 'console.log("' . $date . ' ' . $tag . ' ' . $data . '")';
	echo '</script>';
}
endif;

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
	
	$buildin_pages = get_option('amoeba_blog_nav_pages');
	if (!$buildin_pages) {
		$pages = array(
			array('title' => __('Archives'), 'name' => 'archives'),
			array('title' => __('Categories'), 'name' => 'categories'),
			array('title' => __('Tags'), 'name' => 'tags')
		);
		foreach ($pages as $page) {
			$params = array(
				'post_type'    => 'page',
				'post_title'   => $page['title'],
				'post_name'    => $page['name'],
				'post_status'  => 'publish',
			);
			$pageid = wp_insert_post($params);
			if ($pageid) {
				$buildin_pages[] = $pageid;
			}
			else {
				break;
			}
			update_option('amoeba_blog_nav_pages', $buildin_pages);
		}
	}

}
endif; // amoeba_setup
add_action('after_setup_theme', 'amoeba_setup');

/**
 * Enqueue scripts and styles.
 */
function amoeba_scripts() {
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('font-oswald', 'https://fonts.proxy.ustclug.org/css?family=Oswald');

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', false, null, true);
	wp_enqueue_script('jquery');

	wp_enqueue_style('amoeba-base-style', get_template_directory_uri() . "/css/base.css");

	if (is_page('coming-soon')) {
		wp_enqueue_style('amoeba-style', get_template_directory_uri() . "/css/coming-soon.css");
	}
	else if (is_page('about')) {
		wp_enqueue_style('amoeba-style', get_template_directory_uri() . "/css/about.css");
	}
	else if (is_page('gallery')) {
		wp_enqueue_style('amoeba-style', get_template_directory_uri() . "/css/gallery.css");
	}
	else {
		wp_enqueue_style('amoeba-style', get_template_directory_uri() . "/css/blog.css");
	}

	wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '');  
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
	return 'http://fonts.proxy.ustclug.org/css?family=Oswald:400,300,700';
}
endif;

if (!function_exists('am_create_post_type')) :
function am_create_post_type() {
    register_post_type( 'vivi',
		array(
			'labels' => array(
				'name'          => __( 'Vivi' ),
				'singular_name' => __( 'Vivi' ),
				'all_items'     => __('All Posts')
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'vivi'),
			'supports'    => array( 'title', 'editor', 'author', 'comments' )
		)
    );
}
endif;
add_action('init', 'am_create_post_type', 0);

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

if (!function_exists('am_get_template_shared_vars')) :
function am_get_template_shared_vars() {
}
endif;
add_action('template_redirect', 'am_get_template_shared_vars');

if (!function_exists('am_nav_menu_items')) :
function am_nav_menu_items($items) {
	if (!is_user_logged_in()) {
		$items .= '<li id="menu-item-login" class="menu-item menu-item-login"><a href="' . wp_login_url('index.php') . '">Login</a></li>';
	}
	else {
		$user = wp_get_current_user();
		$items .= '<li class="menu-item menu-item-profile"><a href ="' . admin_url() . '"><img src="' . get_avatar_url($user->ID) . '" />' . $user->display_name . '</a></li>';
	}
	return $items;
}
endif;
add_filter('wp_nav_menu_items', 'am_nav_menu_items', 10, 2);

// Disable admin bar for all users except for administrators.
if (!function_exists('am_admin_bar')) :
function am_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
endif;
add_action('after_setup_theme', 'am_admin_bar');

add_filter( 'wp_nav_menu_objects', function(array $items, $args) {
	console_log($args->theme_location);
	if ('primary' !== $args->theme_location) {
		return $items;
	}

	return array_filter($items, function($item) {
		if ('相册' === $item->title) {
			return is_user_logged_in();
		}
		return true;
	});
}, 10, 2 );

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

function amoeba_set_post_views() {
	if (is_single()) {
		global $post;
		$count = esc_attr(get_post_meta($post->ID, 'amoeba_post_views_count', true));
		if ($count == '') {
			$count = 1;
			add_post_meta($post->ID, 'amoeba_post_views_count', $count);
		} else {
			$count = (int)$count + 1;
			update_post_meta($post->ID, 'amoeba_post_views_count', $count);
		}
	}
}

function amoeba_get_post_views() {
	global $post;
	$count = get_post_meta($post->ID, 'amoeba_post_views_count', true);
	if ($count == '') {
		$count = 0;
	}
	if ($count >= 1000) {
		$count = round(($visitor_count / 1000), 2);
		$count = $count . 'K';
	}
	return esc_attr($count);
}

add_filter( 'widget_meta_poweredby', '__return_empty_string' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/options.php';
require get_template_directory() . '/inc/gallery.php';
require get_template_directory() . '/widgets/profile.php';
require get_template_directory() . '/widgets/blog-navigation.php';
require get_template_directory() . '/widgets/social.php';
//require get_template_directory() . '/inc/options-demo.php';

?>
