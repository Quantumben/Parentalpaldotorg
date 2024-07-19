<?php
$default_settings = [
    'cms_animate' => '',
    'animation_effects' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

if ( ! empty( $settings['image']['url'] ) ) {
    $widget->add_render_attribute( 'image', 'src', $settings['image']['url'] );
    $widget->add_render_attribute( 'image', 'alt', \Elementor\Control_Media::get_image_alt( $settings['image'] ) );
    $widget->add_render_attribute( 'image', 'title', \Elementor\Control_Media::get_image_title( $settings['image'] ) );
}

$image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

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

?>
<div class="cms-image-single <?php echo esc_attr( $animation_effects.' '.$cms_animate); ?>">
    <?php if ( $image_html ) : ?>
        <div class="cms-img-box">
            <?php if(!empty($link_attributes)) { ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php } ?>
                <?php echo wp_kses_post($image_html); ?>
            <?php if(!empty($link_attributes)) { ?></a><?php } ?>
        </div>
    <?php endif; ?>
</div>