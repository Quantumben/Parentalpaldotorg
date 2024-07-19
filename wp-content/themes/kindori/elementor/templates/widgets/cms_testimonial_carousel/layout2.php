<?php
$default_settings = [
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

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
$autoplay_speed = $widget->get_setting('autoplay_speed', '8000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '800');
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => $autoplay,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => '0',
    'data-speed' => $speed,
    'data-slidesToShow' => '1',
    'data-slidesToShowTablet' => '1',
    'data-slidesToShowMobile' => '1',
    'data-slidesToScroll' => '1',
    'data-slidesToScrollTablet' => '1',
    'data-slidesToScrollMobile' => '1',
] );
?>
<?php if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="cms-testimonial-carousel2 cms-slick-slider <?php echo esc_attr($cms_animate); ?>">
        <div class="testimonial-inner">
            
            <div class="testimonial-carousel-inner">
                <div class="cms-slick-nav" data-nav="<?php echo esc_attr($settings['nav']); ?>">
                    <?php foreach ($settings['testimonial'] as $value_nav): 
                        $img = etc_get_image_by_size( array(
                            'attach_id'  => $value_nav['image']['id'],
                            'thumb_size' => '120x120',
                            'class'      => '',
                        ));
                        $thumbnail = $img['thumbnail'];
                        ?>
                            <div class="slick-slide">
                                <?php if(!empty($value_nav['image']['id'])) { ?>
                                    <div class="testimonial-image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php endforeach; ?>
                </div>

                <div class="cms-slick-primary">
                    <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                        <?php foreach ($settings['testimonial'] as $value):
                            $style_star = isset($value['style_star']) ? $value['style_star'] : '';
                            ?>
                            <div class="slick-slide">
                                <?php if(!empty($value['wg_title'])) { ?>
                                    <div class="widget-title"><?php echo esc_attr($value['wg_title']); ?></div>
                                <?php } ?>
                                <?php if(!empty($value['description'])) { ?>
                                    <div class="testimonial-desc">
                                        <span class="icon-qouter qouter-1">
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
                                        <?php echo esc_attr($value['description']); ?>
                                        <span class="icon-qouter qouter-2">
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
                                    </div>
                                <?php } ?>
                                <?php if(!empty($value['title'])) { ?>
                                    <h3 class="testimonial-title"><?php echo esc_attr($value['title']); ?></h3>
                                <?php } ?>
                                
                                <span class="item-star <?php echo esc_attr( $style_star ); ?>">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                
                                <?php if(!empty($value['position'])) { ?>
                                    <span class="testimonial-position"><?php echo esc_attr($value['position']); ?></span>
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
<?php endif; ?>
