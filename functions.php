<?php
/**
 * Slumber Falls functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Slumber_Falls
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function slumber_falls_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Slumber Falls, use a find and replace
		* to change 'slumber-falls' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'slumber-falls', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'slumber-falls' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'slumber_falls_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'slumber_falls_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function slumber_falls_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'slumber_falls_content_width', 640 );
}
add_action( 'after_setup_theme', 'slumber_falls_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function slumber_falls_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'slumber-falls' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'slumber-falls' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'slumber_falls_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function slumber_falls_scripts() {
	// Main theme styles (Tailwind compiled)
	wp_enqueue_style(
		'slumber-falls-tailwind',
		get_template_directory_uri() . '/assets/css/output.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/output.css' )
	);

	// Keep original Underscores styles if needed
	wp_enqueue_style(
		'slumber-falls-style',
		get_stylesheet_uri(),
		array( 'slumber-falls-tailwind' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_style_add_data( 'slumber-falls-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slumber-falls-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// Enqueue FAQ accordion script on FAQ archive page
	if ( is_post_type_archive( 'faq' ) ) {
		wp_enqueue_script(
			'slumber-falls-faq-accordion',
			get_template_directory_uri() . '/assets/js/faq-accordion.js',
			array(),
			filemtime( get_template_directory() . '/assets/js/faq-accordion.js' ),
			true
		);
	}

	// Enqueue camp filters script on camp archive page
	if ( is_post_type_archive( 'camp' ) ) {
		wp_enqueue_script(
			'slumber-falls-camp-filters',
			get_template_directory_uri() . '/assets/js/camp-filters.js',
			array(),
			filemtime( get_template_directory() . '/assets/js/camp-filters.js' ),
			true
		);
	}

	// Enqueue carousel script on front page
	if ( is_front_page() ) {
		wp_enqueue_script(
			'slumber-falls-carousel',
			get_template_directory_uri() . '/assets/js/carousel.js',
			array(),
			filemtime( get_template_directory() . '/assets/js/carousel.js' ),
			true
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'slumber_falls_scripts' );

/**
 * Fallback menu if primary menu not assigned
 */
function slumber_falls_fallback_menu() {
	echo '<ul id="primary-menu" class="flex space-x-6">';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '" class="text-white hover:text-gray-200">Home</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/camps/' ) ) . '" class="text-white hover:text-gray-200">Camps</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/activities/' ) ) . '" class="text-white hover:text-gray-200">Activities</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/instructors/' ) ) . '" class="text-white hover:text-gray-200">Instructors</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/retreats/' ) ) . '" class="text-white hover:text-gray-200">Retreats</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/faqs/' ) ) . '" class="text-white hover:text-gray-200">FAQs</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/about/' ) ) . '" class="text-white hover:text-gray-200">About</a></li>';
	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/contact/' ) ) . '" class="text-white hover:text-gray-200">Contact</a></li>';
	echo '</ul>';
}

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Custom Meta Boxes
 */
require get_template_directory() . '/inc/meta-boxes.php';

/**
 * Form Handlers
 */
require get_template_directory() . '/inc/forms.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

