<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Kindori
 */

/**
 * Setup default image sizes after the theme has been activated
 */
function kindori_after_setup_theme()
{

}
add_action( 'after_setup_theme', 'kindori_after_setup_theme' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kindori_body_classes( $classes )
{   
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (kindori_get_opt( 'site_boxed', false )) {
        $classes[] = 'site-boxed';
    }

    if ( class_exists('WPBakeryVisualComposerAbstract') ) {
        $classes[] = 'visual-composer';
    }

    if (class_exists('ReduxFramework')) {
        $classes[] = 'redux-page';
    }

    $body_default_font = kindori_get_opt( 'body_default_font', 'Prompt' );
    $heading_default_font = kindori_get_opt( 'heading_default_font', 'Fredoka' );

    if($body_default_font == 'Prompt') {
        $classes[] = 'body-default-font';
    }

    if($heading_default_font == 'Fredoka') {
        $classes[] = 'heading-default-font';
    }

    if (kindori_get_opt( 'sticky_on', false )) {
        $classes[] = 'header-sticky';
    }

    return $classes;
}
add_filter( 'body_class', 'kindori_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function kindori_pingback_header()
{
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'kindori_pingback_header' );
