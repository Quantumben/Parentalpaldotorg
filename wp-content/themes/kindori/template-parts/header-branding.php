<?php
/**
 * Template part for displaying site branding
 */

//
$custom_header = kindori_get_page_opt( 'custom_header', '0' );

if ( $custom_header == '1' && !empty($logo_dark['url']) ) {
    $logo_url = $logo_dark['url'];
}


$logo = kindori_get_opt( 'logo', array( 'url' => '', 'id' => '' ) );
$logo_url = $logo['url'];

$page_logo = kindori_get_page_opt( 'logo', array( 'url' => '', 'id' => '' ) );
if( !empty($page_logo['url'])) {
    $logo_url = $page_logo['url'];
}

$logo_light = kindori_get_opt( 'logo_light', array( 'url' => '', 'id' => '' ) );
$logo_light_url = $logo_light['url'];

$page_logo_light = kindori_get_page_opt( 'logo_light', array( 'url' => '', 'id' => '' ) );
if( !empty($page_logo_light['url']) ) {
    $logo_light_url = $page_logo_light['url'];
}


$logo_mobile = kindori_get_opt( 'logo_mobile', array( 'url' => '', 'id' => '' ) );
$logo_mobile_url = $logo_mobile['url'];

$page_logo_mobile = kindori_get_page_opt( 'logo_mobile', array( 'url' => '', 'id' => '' ) );
if( !empty($page_logo_mobile['url']) ) {
    $logo_mobile_url = $page_logo_mobile['url'];
}

if ($logo_url || $logo_light_url || $logo_mobile_url)
{
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_light_url )
    );
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_url )
    );
    printf(
        '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_mobile_url )
    );
}
else
{
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo-dark.png' )
    );
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo-light.png' )
    );
    printf(
        '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo-dark.png' )
    );
}