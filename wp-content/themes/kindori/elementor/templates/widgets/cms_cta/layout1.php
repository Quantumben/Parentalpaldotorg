<?php
$default_settings = [
    'style_btn' => '',
    'cms_animate' => '',
    'style_box_shadow' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

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


$widget->add_inline_editing_attributes( 'title_text', 'none' );
$widget->add_render_attribute( 'title_text', 'class', 'item--title' );

$widget->add_render_attribute( 'description_text', 'class', 'item--description' );
$widget->add_inline_editing_attributes( 'description_text' );

?>
<div class="cms-cta layout1 <?php echo esc_attr($cms_animate); ?>">
    <div class="inner-cms-cta">
        <div class="col-content">
            <?php if(!empty($settings['title_text'])) : ?>
                <h3 <?php etc_print_html($widget->get_render_attribute_string( 'title_text' )); ?>>
                    <?php echo wp_kses_post($settings['title_text']); ?>
                </h3>
            <?php endif; ?>
            <?php if(!empty($settings['description_text'])) : ?>
                <div <?php etc_print_html($widget->get_render_attribute_string( 'description_text' )); ?>>
                    <?php echo wp_kses_post($settings['description_text']); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if(!empty($settings['button_text'])) : ?>
            <div class="item--button">
                <a class="btn-cta <?php echo esc_attr($style_btn.' '.$style_box_shadow); ?>" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                    <span><?php echo esc_attr($settings['button_text']); ?></span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
