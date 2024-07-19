<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Kindori
 */
$post_date_on = kindori_get_opt( 'post_date_on', true );

$post_navigation_on = kindori_get_opt( 'post_navigation_on', false );
$post_feature_image_on = kindori_get_opt( 'post_feature_image_on', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-hentry'); ?>>
    <?php if (has_post_thumbnail() && $post_feature_image_on == true) {
        echo '<div class="entry-featured"><div class="post-image">'; ?>
            <?php if($post_date_on) : ?>
                <div class="item-date"><?php echo get_the_date(); ?></div>
            <?php endif; ?>
            <?php the_post_thumbnail('post-single'); ?>
        <?php echo '</div></div>';
    } ?>
    <div class="entry-body">
        <div class="entry-content clearfix">
            <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php if($post_navigation_on) : ?>
            <div class="entry-navigation">
                <?php kindori_post_nav_default(); ?>
            </div>
        <?php endif; ?>
    </div>
</article><!-- #post -->