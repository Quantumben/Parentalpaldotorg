<?php
$default_settings = [
    'cms_animate' => '',
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


$widget->add_inline_editing_attributes( 'heading_text', 'none' );
$widget->add_inline_editing_attributes( 'number_text', 'none' );

?>
<div class="cms-banner layout2 <?php echo esc_attr($cms_animate); ?>">
	<div class="inner-layout">
	    <?php if ( $image_html ) : ?>
	        <div class="img-bg">
	        	<div class="item-image"></div>
	            <?php echo wp_kses_post($image_html); ?>
	        </div>
	    <?php endif; ?>
	    <div class="item--holder">
		    <?php if(!empty($settings['heading_text'])) : ?>
		        <h3 class="item--title">
		            <?php echo esc_html($settings['heading_text']); ?>
		        </h3>
		    <?php endif; ?>
		    <?php if(!empty($settings['number_text'])) : ?>
		        <div class="item-nummber">
		            <?php echo wp_kses_post($settings['number_text']); ?>
		        </div>
		    <?php endif; ?>
	    </div>
	</div>
</div>