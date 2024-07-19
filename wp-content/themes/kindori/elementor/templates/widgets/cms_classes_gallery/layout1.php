<?php
$default_settings = [
    'cms_animate' => '',
    'thumbnail_size' => '',
    'thumbnail_custom_dimension' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

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
$autoplay_speed = $widget->get_setting('autoplay_speed', '8000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '800');
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => 'true',
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => '0',
    'data-speed' => $speed,
    'data-slidesToShow' => 'true',
    'data-slidesToShowTablet' => 'true',
    'data-slidesToShowMobile' => 'true',
    'data-slidesToScroll' => 'true',
    'data-slidesToScrollTablet' => 'true',
    'data-slidesToScrollMobile' => 'true',
    'data-appendArrows' => '#append-arrows-' . $html_id,
] );
?>
<?php if(isset($settings['classes']) && !empty($settings['classes']) && count($settings['classes'])): ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-classes-gallery cms-slick-slider <?php echo esc_attr($cms_animate); ?>">
        <div class="classes-inner">
            <div class="classes-carousel-inner">
                <div class="cms-slick-primary">
                    <div id="<?php echo esc_attr('append-arrows-' . $html_id); ?>" class="append-arrows-custom"></div>
                    <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                        <?php foreach ($settings['classes'] as $value):
                            $image = isset($value['image']) ? $value['image'] : '';
                            $img = etc_get_image_by_size( array(
                                'attach_id'  => $image['id'],
                                'thumb_size' => $img_size,
                                'class'      => '',
                            ));

                            $thumbnail = $img['thumbnail']; ?>
                            <div class="slick-slide">
                                <?php if(!empty($value['image']['id'])) { ?>
                                    <div class="classes-image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="cms-slick-nav" data-nav="<?php echo esc_attr($settings['nav']); ?>">
                    <?php foreach ($settings['classes'] as $value_nav): 
                        $img = etc_get_image_by_size( array(
                            'attach_id'  => $value_nav['image']['id'],
                            'thumb_size' => '500x350',
                            'class'      => '',
                        ));
                        $thumbnail = $img['thumbnail'];
                        ?>
                            <div class="slick-slide">
                                <?php if(!empty($value_nav['image']['id'])) { ?>
                                    <div class="classes-image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
