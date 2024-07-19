<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Kindori
 */
?>
<div class="col-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class('archive-hentry archive-cmsevents-hentry'); ?>>
        <div class="grid-item-inner">
            <div class="cmsevents-item">
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