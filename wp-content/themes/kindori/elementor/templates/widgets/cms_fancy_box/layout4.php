<?php
$default_settings = [
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );

if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}

if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }
}
$link_attributes = $widget->get_render_attribute_string( 'link' );

$icon_attributes = $widget->get_render_attribute_string( 'selected_icon' );

$widget->add_render_attribute( 'description_text', 'class', 'item--description' );

$widget->add_inline_editing_attributes( 'title_text', 'none' );
$widget->add_inline_editing_attributes( 'description_text' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-fancy-box layout4 <?php echo esc_attr($cms_animate); ?>">
    <div class="inner-content">
        <?php if ( $settings['icon_type'] == 'icon' && $has_icon ) : ?>
            <div class="item--icon icon-font">
                <div class="circle"></div>
                <div class="inner-icon">
                    <?php if($is_new):
                        \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        else: ?>
                        <i <?php cms_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
            <div class="item--icon icon-image">
                <div class="circle"></div>
                <div class="inner-icon">
                    <?php $img_icon  = etc_get_image_by_size( array(
                            'attach_id'  => $settings['icon_image']['id'],
                            'thumb_size' => 'full',
                            'class'      => '',
                        ) );
                        $thumbnail_icon    = $img_icon['thumbnail'];
                    echo wp_kses_post($thumbnail_icon); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(!empty($settings['title_text'])) : ?>
            <h3 class="item--title">
                <?php echo esc_html($settings['title_text']); ?>
            </h3>
        <?php endif; ?>
        <?php if(!empty($settings['description_text'])) : ?>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'description_text' )); ?>>
                <?php echo wp_kses_post($settings['description_text']); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($settings['button_text'])) : ?>
            <div class="item--button">
                <a class="btn-fcb" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                    <?php echo esc_attr($settings['button_text']); ?>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>