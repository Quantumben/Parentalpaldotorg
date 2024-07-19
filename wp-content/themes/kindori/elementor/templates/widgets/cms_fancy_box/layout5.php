<?php
$default_settings = [
    'cms_animate' => '',
    'line_ldp' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );

if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}

$icon_attributes = $widget->get_render_attribute_string( 'selected_icon' );

$widget->add_render_attribute( 'description_text', 'class', 'item--description' );

$widget->add_inline_editing_attributes( 'title_text', 'none' );
$widget->add_inline_editing_attributes( 'description_text' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-fancy-box layout5 <?php echo esc_attr($cms_animate); ?>">
    <div class="inner-content <?php echo esc_attr($line_ldp); ?>">
        <?php if ( $settings['icon_type'] == 'icon' && $has_icon ) : ?>
            <div class="item--icon icon-font">
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

        <div class="entry-meta">
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
        </div>
    </div>
</div>