<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >

        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
            <div id="page" class="site">
                <div id="content" class="site-content">
                    <div class="content-inner">
                        <?php

                            if ( have_posts() )
                            {
                                while ( have_posts() )
                                {
                                    the_post();

                                    /*
                                     * Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called loop-search-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content', 'elementor_library' );
                                }

                                kindori_posts_pagination();
                            }
                            else
                            {
                                get_template_part( 'template-parts/content', 'none' );
                            }

                        ?>
                    </div><!-- #content inner -->
                </div><!-- #content -->
            </div><!-- #page -->
        <?php wp_footer(); ?>
    </body>
</html>
