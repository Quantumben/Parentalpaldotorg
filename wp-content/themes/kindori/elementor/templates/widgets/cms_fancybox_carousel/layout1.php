<?php
$default_settings = [
    'fancybox_item' => '',
    'cms_animate' => '',
    'thumbnail_size' => '',
    'show_button' => '',
    'button_text' => '',
    'style_layout'=> '',
    'thumbnail_custom_dimension' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$widget->add_render_attribute( 'inner', [
    'class' => 'cms-carousel-inner',
] );

if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = 'full';
}


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
$autoplay = $widget->get_setting('autoplay', '');
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
] );
?>
<?php if(isset($settings['fancybox_item']) && !empty($settings['fancybox_item']) && count($settings['fancybox_item'])): ?>
    <div class="cms-fancybox-carousel layout1 <?php echo esc_attr( $style_layout ); ?> cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['fancybox_item'] as $key => $value):
                    $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                    if ( ! empty( $value['link']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

                        if ( $value['link']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $value['link']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }

                    $link_attributes = $widget->get_render_attribute_string( $link_key );

                    $image = isset($value['image']) ? $value['image'] : '';
                    $img = etc_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => $img_size,
                        'class'      => '',
                    ));

                    $thumbnail = $img['thumbnail'];
                    preg_match_all( '@src="([^"]+)"@' , $thumbnail, $match );

                    $src = array_pop($match);
                    ?>
                    <div class="slick-slide">
                        <div class="fancybox-item <?php echo esc_attr($cms_animate); ?>">
                            <div class="inner-content">
                                <?php if(!empty($value['image']['id'])) { 
                                    ?>
                                    <div class="item--image" style="background-image: url(<?php echo esc_url($src[0]); ?>);">
                                    </div>
                                <?php } ?>
                                <div class="item-holder">
                                    <?php if ( $value['fancybox_title'] ) : ?>
                                        <h3 class="item--title">
                                            <?php if ( $link_attributes ) { ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php } ?>
                                                <?php echo esc_attr($value['fancybox_title']); ?>
                                            <?php if ( $link_attributes ) { ?></a><?php } ?>
                                        </h3>
                                    <?php endif; ?>
                                    
                                    <?php if ( $value['description_text'] ) : ?>
                                        <div class="item--description"><?php echo esc_attr($value['description_text']); ?></div>
                                    <?php endif; ?>
                                    <?php if($show_button == 'true'): ?>
                                        <?php if ( $button_text ) { ?>
                                            <?php if ( $link_attributes ) : ?>
                                                <div class="item--button">
                                                    <a class="btn-more" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                                        <?php echo esc_attr( $button_text ); ?>
                                                        <i class="fas fa-long-arrow-alt-right"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php } else { ?>
                                            <?php if ( $link_attributes ) : ?>
                                                <div class="item--button">
                                                    <a class="btn-more" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                                        <?php echo esc_html__( 'Read More', 'kindori') ?>
                                                        <i class="fas fa-long-arrow-alt-right"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php } ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
