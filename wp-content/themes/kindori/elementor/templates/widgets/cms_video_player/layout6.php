<?php 
$default_settings = [
    'overlay_style'   => '',
    'cms_animate'   => '',

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

if ( ! empty( $settings['image_icon']['url'] ) ) {
    $widget->add_render_attribute( 'image_icon', 'src', $settings['image_icon']['url'] );
    $widget->add_render_attribute( 'image_icon', 'alt', \Elementor\Control_Media::get_image_alt( $settings['image_icon'] ) );
    $widget->add_render_attribute( 'image_icon', 'title', \Elementor\Control_Media::get_image_title( $settings['image_icon'] ) );
}
$image_icon_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image_icon' );


$widget->add_inline_editing_attributes( 'title_text', 'none' );
?>
<div class="cms-video-player layout6 <?php echo esc_attr($cms_animate); ?>">
    <?php if ( ! empty( $settings['image']['url'] ) ) { echo wp_kses_post($image_html); } ?>    
    <div class="wp-box-meta">
        <?php if(!empty($settings['video_link'])) : ?>
            <a class="btn-video" href="<?php echo esc_url($settings['video_link']); ?>">
                <?php if ( ! empty( $settings['image_icon']['url'] ) ) { echo wp_kses_post($image_icon_html); } ?>    
            </a>
        <?php endif; ?>
    </div>
</div>