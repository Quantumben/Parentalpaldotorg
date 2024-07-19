<?php
$default_settings = [
    'cms_animate' => '',
    'thumbnail_size' => '',
    'thumbnail_custom_dimension' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

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
<?php if(isset($settings['team']) && !empty($settings['team']) && count($settings['team'])): ?>
    <div class="cms-team-carousel1 cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['team'] as $key => $value): 
                    
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
                    $title = isset($value['title']) ? $value['title'] : '';
                    $position = isset($value['position']) ? $value['position'] : '';
                    
                    $image = isset($value['image']) ? $value['image'] : '';
                    $img = etc_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => $img_size,
                        'class'      => '',
                    ));
                    $thumbnail = $img['thumbnail'];
                    $social = isset($value['social']) ? $value['social'] : '';
                    ?>
                    <div class="slick-slide">
                        <div class="team-item">
                            <div class="item--inner <?php echo esc_attr($cms_animate); ?>">
                                <?php if(!empty($image)) { ?>
                                    <div class="item--image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php } ?>
                                <div class="item-holder">
                                    <?php if(!empty($title)) { ?>
                                        <h3 class="item--title">    
                                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                                <?php echo esc_attr($title); ?>
                                            </a>
                                        </h3>
                                    <?php } ?>
                                    <?php if(!empty($position)) { ?>
                                        <div class="item--position"><?php echo esc_attr($position); ?></div>
                                    <?php } ?>
                                    <?php if(!empty($social)):?>
                                        <div class="item--social">
                                            <div class="inner-social">
                                                <?php if(!empty($social)):
                                                    $team_social = json_decode($social, true);
                                                    foreach ($team_social as $value): ?>
                                                        <a href="<?php echo esc_url($value['url']); ?>">
                                                            <i class="<?php echo esc_attr($value['icon']); ?>"></i>
                                                        </a>
                                                    <?php endforeach;
                                                endif; ?>
                                            </div>
                                        </div>
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
