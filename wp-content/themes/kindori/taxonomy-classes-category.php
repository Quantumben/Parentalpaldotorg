<?php
/**
 * The template for displaying archive pages
 *
 * @package Kindori
 */
$classes_price = get_post_meta($post->ID, 'classes_price', true);
$classes_size = get_post_meta($post->ID, 'classes_size', true);
$classes_age = get_post_meta($post->ID, 'classes_age', true);
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
                                        <article id="post-<?php the_ID(); ?>" class="archive-hentry archive-classes-hentry">
                                            <div class="grid-item-inner">
                                                <div class="classes-item">
                                                    <?php if (has_post_thumbnail()) {
                                                        echo '<div class="entry-featured image-light-box"><div class="post-image">'; ?>
                                                            <?php the_post_thumbnail('kindori-blog'); ?>
                                                            <a class="light-box" href="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), $size = 'full') ?>">+</a>
                                                        <?php echo '</div></div>';
                                                    } ?>

                                                    <div class="entry-body">
                                                        <div class="entry-holder">
                                                            <h2 class="entry-title">
                                                                <a href="<?php echo esc_url( get_permalink()); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h2>
                                                        </div>
                                                        <div class="entry-content">
                                                            <?php kindori_entry_excerpt();?>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <?php if(!empty($classes_age)): ?>
                                                                <div class="item-box">
                                                                    <label><?php echo esc_html__( 'Age', 'kindori') ?></label>
                                                                    <div class="box-value">
                                                                        <span><?php echo esc_attr( $classes_age );?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if(!empty($classes_size)): ?>
                                                                <div class="item-box">
                                                                    <label><?php echo esc_html__( 'Size', 'kindori') ?></label>
                                                                    <div class="box-value">
                                                                        <span><?php echo esc_attr( $classes_size );?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if(!empty($classes_price)): ?>
                                                                <div class="item-box">
                                                                    <label><?php echo esc_html__( 'Price', 'kindori') ?></label>
                                                                    <div class="box-value">
                                                                        <span><?php echo esc_attr( $classes_price );?></span>
                                                                        <span><?php echo esc_html__( ' /Day', 'kindori' ) ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
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
