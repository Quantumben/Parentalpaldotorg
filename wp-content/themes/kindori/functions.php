<?php
/**
 * Functions and definitions
 *
 * @package Kindori
 */
if ( ! function_exists( 'kindori_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kindori_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'kindori', get_template_directory() . '/languages' );

		// Custom Header
		add_theme_support( "custom-header" );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'kindori' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
            'script',
            'style'
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kindori_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_theme_support( 'post-formats', array(
			'gallery',
			'video',
		) );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');
        add_image_size( 'thumbnail-small', 160, 160, true );
        add_image_size( 'author-avatar', 500, 647, true );
        add_image_size( 'post-widget', 800, 512, true );
        add_image_size( 'post-single', 980, 510, true );
		add_image_size( 'portfolio-single-full', 1170, 660, true );
		add_image_size( 'portfolio-icon', 70, 70, true );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'kindori_setup' ); 

add_action( 'cms_locations', function ( $cms_locations ) {
//    $cms_locations['cms-test'] ='Test Menu';
	return $cms_locations;
} );

/**
 * Add custom class in Row Visual Composer
 */
function kindori_elementor_shortcode_css_class( $classes, $settings_base, $atts )
{
    $classes_arr = explode( ' ', $classes );
    if ( 'vc_column' == $settings_base ) {
        if ( $atts['cms_column_class'] ) {
            $classes_arr[] = $atts['cms_column_class'];
        }
        if ( $atts['cms_column_remove_space'] ) {
            $classes_arr[] = $atts['cms_column_remove_space'];
        }
        if ( $atts['cms_column_offset'] ) {
            $classes_arr[] = $atts['cms_column_offset'];
        }   
        if ( $atts['cms_column_padding_class'] ) {
            $classes_arr[] = $atts['cms_column_padding_class'];
        }   
    }

    return implode( ' ', $classes_arr );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function kindori_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kindori_content_width', 640 );
}

add_action( 'after_setup_theme', 'kindori_content_width', 0 );

/**
 * Register widget area.
 */
function kindori_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'kindori' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here.', 'kindori' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if (class_exists('ReduxFramework')) {
		register_sidebar( array(
			'name'          => esc_html__( 'Page Sidebar', 'kindori' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets here.', 'kindori' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'kindori' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'kindori' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}

add_action( 'widgets_init', 'kindori_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kindori_scripts() {
	$theme = wp_get_theme( get_template() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0' );
	wp_enqueue_style( 'awesome', get_template_directory_uri() . '/assets/css/awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'awesome5', get_template_directory_uri() . '/assets/css/awesome5.min.css', array(), '5.8.0' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), '2.2.1' );
	wp_enqueue_style( 'flaticon3', get_template_directory_uri() . '/assets/css/flaticon3.css', array(), '2.2.3' );

	wp_enqueue_style( 'font-material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0' );


	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0' );
	wp_enqueue_style( 'kindori-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'kindori-style', get_stylesheet_uri() );
	wp_enqueue_style( 'kindori-google-fonts', kindori_fonts_url() );

	/* Lib JS */
    wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', array( 'jquery' ), '1.4.1', true);
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), 'all', true );
    wp_enqueue_script( 'enscroll', get_template_directory_uri() . '/assets/js/enscroll.js', array( 'jquery' ), 'all', true );
    wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/match-height-min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'kindori-sidebar-fixed', get_template_directory_uri() . '/assets/js/sidebar-scroll-fixed.js', array( 'jquery' ), '1.0.0', true );
    
    wp_enqueue_script('kindori-elementor-custom-classes-js', get_template_directory_uri() . '/assets/js/elementor-custom-classes.js', [ 'jquery' ], '1.0.0');
    
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '1.0.0', true );
    
    wp_register_script( 'kindori-carousel', get_template_directory_uri() . '/assets/js/cms-carousel.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), $theme->get('Version'), true);

    $smoothscroll = kindori_get_opt( 'smoothscroll', false );
    if ( isset( $smoothscroll ) && $smoothscroll ) {
        wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array( 'jquery' ), 'all', true );
    }

    /* Theme JS */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'kindori-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_register_script( 'kindori-parallax', get_template_directory_uri() . '/assets/js/cms-parallax.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_enqueue_script( 'kindori-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_localize_script( 'kindori-main', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    /*
     * Elementor Widget JS
     */
    // Counter Widget
    wp_register_script( 'cms-counter-widget-js', get_template_directory_uri() . '/elementor/js/cms-counter-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Progress Bar Widget
    wp_register_script( 'cms-progressbar-widget-js', get_template_directory_uri() . '/elementor/js/cms-progressbar-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Teams List Widget
    wp_register_script( 'cms-item-carousel-js', get_template_directory_uri() . '/elementor/js/cms-item-carousel.js', [ 'jquery' ], $theme->get( 'Version' ) );
    wp_register_script( 'cms-countdown-time-widget-js', get_template_directory_uri() . '/elementor/js/countdown-time-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Clients List Widget
    wp_register_script( 'cms-clients-list-widget-js', get_template_directory_uri() . '/elementor/js/cms-clients-list-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Pie Charts Widget
    wp_register_script( 'cms-piecharts-widget-js', get_template_directory_uri() . '/elementor/js/cms-piecharts-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // CMS Post Carousel Widget
    wp_register_script( 'cms-post-carousel-widget-js', get_template_directory_uri() . '/elementor/js/cms-post-carousel-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    
    // Google Maps Widget
    $api = kindori_get_opt('gm_api_key', 'AIzaSyC08_qdlXXCWiFNVj02d-L2BDK5qr6ZnfM');
    $api_js = "https://maps.googleapis.com/maps/api/js?sensor=false&key=".$api;
    wp_register_script('maps-googleapis', $api_js, [], date("Ymd"));
    wp_register_script('custom-gm-widget-js', get_template_directory_uri() . '/elementor/js/custom-gm-widget.js', ['maps-googleapis', 'jquery'], $theme->get( 'Version' ), true);
    wp_register_script('cms-post-grid-widget-js', get_template_directory_uri() . '/elementor/js/cms-post-grid-widget.js', [ 'isotope', 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-toggle-widget-js', get_template_directory_uri() . '/elementor/js/cms-toggle-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-accordion-widget-js', get_template_directory_uri() . '/elementor/js/cms-accordion-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-alert-widget-js', get_template_directory_uri() . '/elementor/js/cms-alert-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-tabs-widget-js', get_template_directory_uri() . '/elementor/js/cms-tabs-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
}

/* Create Demo Data */
add_filter('swa_ie_export_mode', 'kindori_enable_export_mode');
function kindori_enable_export_mode()
{
    return false;
}

add_action( 'wp_enqueue_scripts', 'kindori_scripts' );

/* add editor styles */
function kindori_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}

add_action( 'admin_init', 'kindori_add_editor_styles' );

/* add admin styles */
function kindori_admin_style() {
	$theme = wp_get_theme( get_template() );
	wp_enqueue_style( 'kindori-admin-style', get_template_directory_uri() . '/assets/css/admin.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), '2.2.0' );
	wp_enqueue_style( 'flaticon3', get_template_directory_uri() . '/assets/css/flaticon3.css', array(), '2.2.3' );
	wp_enqueue_style( 'material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0' );
}

add_action( 'admin_enqueue_scripts', 'kindori_admin_style' );

/**
 * Helper functions for this theme.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme options
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Page options
 */
require_once get_template_directory() . '/inc/page-options.php';

/**
 * CSS Generator.
 */
if ( ! class_exists( 'CSS_Generator' ) ) {
	require_once get_template_directory() . '/inc/classes/class-css-generator.php';
}

/**
 * Breadcrumb.
 */
require_once get_template_directory() . '/inc/classes/class-breadcrumb.php';

/**
 * Custom template tags for this theme.
 */

require_once get_template_directory() . '/inc/template-tags.php';

/* Load list require plugins */
require_once( get_template_directory() . '/inc/require-plugins.php' );

/**
 * Additional widgets for the theme
 */
require_once get_template_directory() . '/widgets/widget-getintouch.php';
require_once get_template_directory() . '/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/widgets/widget-recent-posts-carousel.php';
require_once get_template_directory() . '/widgets/widget-social.php';
require_once get_template_directory() . '/widgets/class.widget-extends.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/extends.php';


/**
 * Tutorials snippet functions. You should add those to extends.php
 * and remove the file.
 */
require_once get_template_directory() . '/inc/snippets.php';

/**
 * Custom Category Walker
 */
require_once get_template_directory() . '/inc/walker/class-cms-walker-category.php';


if ( ! function_exists( 'kindori_fonts_url' ) ) :
	/**
	 * Register Google fonts.
	 *
	 * Create your own kindori_fonts_url() function to override in a child theme.
	 *
	 * @since league 1.1
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function kindori_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x( 'on', 'Prompt font: on or off', 'kindori' ) ) {
			$fonts[] = 'Prompt:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700';
		}
		if ( 'off' !== _x( 'on', 'Schoolbell font: on or off', 'kindori' ) ) {
			$fonts[] = 'Schoolbell:400';
		}
		
		if ( 'off' !== _x( 'on', 'Fredoka+One font: on or off', 'kindori' ) ) {
			$fonts[] = 'Fredoka+One:400';
		}
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/* Favicon */
function kindori_site_favicon(){
    
    $favicon = kindori_get_opt( 'favicon' );
    
    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}
add_action('wp_head', 'kindori_site_favicon');

/**
 * Add Template Woocommerce
 */
if(class_exists('Woocommerce')){
    require_once( get_template_directory() . '/woocommerce/wc-function-hooks.php' );
}

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if(!function_exists('kindori_widget_categories_args')){
    add_filter( 'widget_categories_args', 'kindori_widget_categories_args', 10, 2 );
    function kindori_widget_categories_args($cat_args, $instance){
        $cat_args['walker'] = new CMS_Walker_Category;

        return $cat_args;
    }
}
if(!function_exists('kindori_get_archives_link')){
	add_filter( 'get_archives_link', 'kindori_get_archives_link', 10 );
	function kindori_get_archives_link($link_html){
		$link_html = str_replace('(', '<span class="count-post">', $link_html);
		$link_html = str_replace(')', '</span>', $link_html);

		return $link_html;
	}
}

add_filter( 'cms_video_tutorial_link', function () {
	return 'https://www.youtube.com/watch?v=8j3vBM3qHiw';
} );

add_filter( 'wp_lazy_loading_enabled', '__return_false' );