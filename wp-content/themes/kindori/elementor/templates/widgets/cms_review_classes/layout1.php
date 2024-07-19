<?php
    $default_settings = [
        'testimonial_list' => '',
        'thumbnail_size' => '',
        'thumbnail_custom_dimension' => '',
        'cms_animate' => '',
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

    $widget->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation'] );
    $icon_tag = 'span';

    $icon_attributes = $widget->get_render_attribute_string( 'icon' );
    $has_heading = ! empty( $settings['heading_text'] );
    $widget->add_inline_editing_attributes( 'heading_text', 'none' );

?>

<div class="cms-classes-review">
    <?php if ( $has_heading ) : ?>
        <<?php etc_print_html($settings['heading_size']); ?> class="custom-heading">
            <<?php echo implode( ' ', [ $icon_tag ] ); ?>
                <?php etc_print_html($widget->get_render_attribute_string( 'heading_text' )); ?>>
                <?php echo wp_kses_post($settings['heading_text']); ?></<?php etc_print_html($icon_tag); ?>>
        </<?php etc_print_html($settings['heading_size']); ?>>
    <?php endif; ?>
    <?php if(isset($settings['testimonial_list']) && !empty($settings['testimonial_list']) && count($settings['testimonial_list'])): ?>
        <div class="list-review">
            <?php foreach ($settings['testimonial_list'] as $key => $value):
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
                $description = isset($value['description']) ? $value['description'] : '';
                $style_star = isset($value['style_star']) ? $value['style_star'] : '';

                $image = isset($value['image']) ? $value['image'] : '';
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                ?>
                <div class="item-inner <?php echo esc_attr($cms_animate); ?>">
                    <?php if(!empty($image)) { ?>
                        <div class="item-image">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </div>
                    <?php } ?>
                    <div class="item-holder">
                        <div class="inner-item-holder">
                            <?php if(!empty($title)) { ?>
                                <h3 class="item-title">    
                                    <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                        <?php echo esc_attr($title); ?>
                                    </a>
                                    <span class="item-star <?php echo esc_attr( $style_star ); ?>">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                </h3>
                            <?php } ?>
                            <?php if(!empty($description)) { ?>
                                <div class="item-description"><?php echo esc_attr($description); ?></div>
                            <?php } ?>
                            <div class="item-bullet"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
