<?php
/**
 * The template for displaying archive pages
 *
 * @package Kindori
 */

get_header();
?>
<div class="container content-container">
    <div class="content-row">
        <div id="primary">
            <main id="main" class="site-main">
                <div class="row">
                    <?php

                        if ( have_posts() )
                        {
                            while ( have_posts() )
                            {
                                the_post();?>
                                    <div class="col-4">
                                        <article id="post-<?php the_ID(); ?>" class="archive-hentry archive-cmsevents-hentry">
                                            <div class="grid-item-inner">
                                                <div class="cmsevents-item">
                                                    <?php if (has_post_thumbnail()) {
                                                        echo '<div class="entry-featured image-light-box"><div class="post-image">'; ?>
                                                            <?php the_post_thumbnail(); ?>
                                                            <a class="light-box" href="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), $size = 'full') ?>">+</a>
                                                        <?php echo '</div></div>';
                                                    } ?>
                                                    <div class="entry-body">
                                                        <div class="item-category">
                                                            <?php the_terms(get_the_ID() ,'cmsevents-category', '', ', ' ); ?>
                                                        </div>
                                                        <h2 class="entry-title">
                                                            <a href="<?php echo esc_url( get_permalink()); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        <div class="entry-content">
                                                            <?php kindori_entry_excerpt( 20 ); ?>
                                                        </div>
                                                        <div class="entry-readmore">
                                                            <a href="<?php echo esc_url( get_permalink()); ?>" class="btn-more">
                                                                <?php echo esc_html__('Read More', 'kindori'); ?>
                                                                <i class="fas fa-long-arrow-alt-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article><!-- #post -->
                                    </div>

                            <?php } kindori_posts_pagination();
                        }
                        else
                        {
                            get_template_part( 'template-parts/content', 'none' );
                        }

                    ?>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
</div>
<?php
get_footer();
