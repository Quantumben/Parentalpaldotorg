<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Kindori
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
        wp_body_open();
    ?>
    <div id="page" class="site">
        <?php 
        	kindori_page_loading();
        	kindori_header_layout();
            kindori_page_title_layout();
        ?>
        <div id="content" class="site-content">
        	<div class="content-inner">
