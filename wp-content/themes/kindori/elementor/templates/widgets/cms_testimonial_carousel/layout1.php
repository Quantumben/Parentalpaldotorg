<?php
$default_settings = [
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);

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
] );
?>
<?php if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="cms-testimonial-carousel1 cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['testimonial'] as $value): 
                    $img = etc_get_image_by_size( array(
                        'attach_id'  => $value['image']['id'],
                        'thumb_size' => '300x300',
                        'class'      => '',
                    ));
                    $style_star = isset($value['style_star']) ? $value['style_star'] : '';
                    $thumbnail = $img['thumbnail'];
                    ?>
                        <div class="slick-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-inner">
                                    <div class="testimonial-meta">
                                        <div class="testimonial-meta">
                                            <?php if(!empty($value['image']['id'])) { ?>
                                                <div class="testimonial-image">
                                                    <?php echo wp_kses_post($thumbnail); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="testimonial-holder">
                                                <span class="arrow-quote">
                                                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                     width="28.000000pt" height="18.000000pt" viewBox="0 0 28.000000 18.000000"
                                                     preserveAspectRatio="xMidYMid meet">

                                                        <g transform="translate(0.000000,18.000000) scale(0.100000,-0.100000)" stroke="none">
                                                        <path d="M39 166 c-44 -22 -35 -106 12 -106 30 0 22 -20 -11 -27 -33 -6 -46
                                                        -18 -31 -28 16 -9 77 21 95 46 19 28 21 92 4 106 -24 18 -45 21 -69 9z"/>
                                                        <path d="M188 166 c-43 -22 -33 -106 13 -106 30 0 22 -20 -11 -27 -33 -6 -46
                                                        -18 -31 -28 14 -8 73 18 92 41 55 64 7 155 -63 120z"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                                <h3 class="testimonial-title"><?php echo esc_attr($value['title']); ?></h3>
                                                <span class="item-star <?php echo esc_attr( $style_star ); ?>">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial-desc"><?php echo esc_attr($value['description']); ?></div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
