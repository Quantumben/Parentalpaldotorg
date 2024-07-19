<?php
$default_settings = [
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

$arrows = $widget->get_setting('arrows');
$source = $widget->get_setting('source', '');
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$post_ids = $widget->get_setting('post_ids', '');
extract(etc_get_posts_of_grid('post', [
    'source' => $source,
    'orderby' => $orderby,
    'order' => $order,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));

$widget->add_render_attribute( 'inner', [
    'class' => 'cms-carousel-inner',
] );

$slides_to_show = $widget->get_setting('slides_to_show', '');
$slides_to_show_tablet = $widget->get_setting('slides_to_show_tablet', '');
$slides_to_show_mobile = $widget->get_setting('slides_to_show_mobile', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');
$slides_to_scroll_tablet = $widget->get_setting('slides_to_scroll_tablet', '');
$slides_to_scroll_mobile = $widget->get_setting('slides_to_scroll_mobile', '');

$slidesToShow = !empty($slides_to_show)?$slides_to_show:3;
$isSingleSlide = 1 === $slidesToShow;
$defaultLGDevicesSlidesCount = $isSingleSlide ? 1 : 2;
$slidesToShowTablet = !empty($slides_to_show_tablet)?$slides_to_show_tablet:$defaultLGDevicesSlidesCount;
$slidesToShowMobile = !empty($slides_to_show_mobile)?$slides_to_show_mobile:1;
if($isSingleSlide){
    $slidesToScroll = 1;
}
else{
    $slidesToScroll = !empty($slides_to_scroll)?$slides_to_scroll:$defaultLGDevicesSlidesCount;
}
$slidesToScrollTablet = !empty($slides_to_scroll_tablet)?$slides_to_scroll_tablet:$defaultLGDevicesSlidesCount;
$slidesToScrollMobile = !empty($slides_to_scroll_mobile)?$slides_to_scroll_mobile:1;

$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '500');
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => $autoplay,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => $infinite,
    'data-speed' => $speed,
    'data-slidesToShow' => $slidesToShow,
    'data-slidesToShowTablet' => $slidesToShowTablet,
    'data-slidesToShowMobile' => $slidesToShowMobile,
    'data-slidesToScroll' => $slidesToScroll,
    'data-slidesToScrollTablet' => $slidesToScrollTablet,
    'data-slidesToScrollMobile' => $slidesToScrollMobile,
    'data-appendArrows' => '#append-arrows-' . $html_id,
] );

$title_tag = $widget->get_setting('title_tag', 'h3');

$thumbnail_size = $widget->get_setting('thumbnail_size', 'full');
$thumbnail_custom_dimension = $widget->get_setting('thumbnail_custom_dimension', '');
if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = 'full';
}

?>
<?php if (is_array($posts)): ?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-post-carousel-layout1 cms-slick-slider">
    <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
        <div class="wrapper-arrows-custom">
            <div id="<?php echo esc_attr('append-arrows-' . $html_id); ?>" class="append-arrows-custom"></div>
        </div>
        <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>

        <?php
            foreach ($posts as $post):
            $img_id       = get_post_thumbnail_id( $post->ID );
            $img          = etc_get_image_by_size( array(
                'attach_id'  => $img_id,
                'thumb_size' => $img_size,
                'class'      => '',
            ) );
            $thumbnail    = $img['thumbnail'];
            $author = get_user_by('id', $post->post_author);
        ?>
            <div class="carousel-item slick-slide <?php echo esc_attr($cms_animate); ?>">
                <div class="carousel-item-inner">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $settings['show_thumbnail'] == 'true'): ?>
                        <div class="entry-featured">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                            <?php if($settings['show_post_date'] == 'true'): ?>
                                <div class="item-date">
                                    <?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-holder">
                        <?php if($settings['show_meta'] == 'true'): ?>
                            <ul class="entry-meta">
                                <?php if( $settings['show_author'] == 'true' ): ?>
                                    <li class="item-author">
                                        <?php echo get_avatar(get_post()->post_author);?> <span><?php echo esc_html__( 'By', 'kindori' ) ?></span>
                                        <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>">
                                            <?php echo esc_html($author->display_name); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if( $settings['show_comment'] == 'true' ): ?>
                                    <li class="item-comment">
                                        <a href="<?php the_permalink(); ?>">
                                            <i class="fa fa-comments"></i>
                                            <?php
                                                $comment_count = get_comments_number( $post->ID );
                                                if ( 1 === intval($comment_count) ) {
                                                    echo esc_html__( '1 Comment', 'kindori' );
                                                } else {
                                                    echo esc_attr( $comment_count ).' '.esc_html__('Comments', 'kindori');
                                                }
                                            ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if($settings['show_title'] == 'true'): ?>
                        <<?php etc_print_html($title_tag);?> class="entry-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></<?php etc_print_html($title_tag);?>>
                        <?php endif; ?>

                        <?php if($settings['show_excerpt'] == 'true'): ?>
                            <div class="entry-content">
                                <?php echo wp_trim_words( $post->post_excerpt, $settings['num_words'], $more = null ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if($settings['show_excerpt'] == 'true'): ?>
                            <div class="entry-content">
                                <?php
                                    if(!empty($post->post_excerpt)){
                                        echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
                                    }
                                    else{
                                        $content = strip_shortcodes( $post->post_content );
                                        $content = apply_filters( 'the_content', $content );
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        $content = wp_trim_words( $content, $num_words, '&hellip;' );
                                        echo wp_kses_post($content);
                                    }
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if($settings['show_button'] == 'true'): ?>
                            <div class="entry-readmore">
                                <a class="btn-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><i class="fas fa-long-arrow-alt-right"></i><?php echo esc_html__($settings['button_text'], 'kindori'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>