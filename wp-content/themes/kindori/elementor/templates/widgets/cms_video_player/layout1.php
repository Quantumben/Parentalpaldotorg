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

$widget->add_inline_editing_attributes( 'title_text', 'none' );
?>
<div class="cms-video-player layout1 <?php echo esc_attr($cms_animate); ?>">
    <?php if ( ! empty( $settings['image']['url'] ) ) { echo wp_kses_post($image_html); } ?>    
    <div class="wp-box-meta">
        <?php if(!empty($settings['video_link'])) : ?>
            <a class="btn-video" href="<?php echo esc_url($settings['video_link']); ?>">
                <i class="fac fac-play"></i>
                <span class="line-video-animation line-video-1"></span>
                <span class="line-video-animation line-video-2"></span>
                <span class="line-video-animation line-video-3"></span>
            </a>
        <?php endif; ?>
        <?php if(!empty($settings['title_text'])) : ?>
            <h3 class="item--title">
                <?php echo esc_html($settings['title_text']); ?>
            </h3>
        <?php endif; ?>
    </div>
</div>