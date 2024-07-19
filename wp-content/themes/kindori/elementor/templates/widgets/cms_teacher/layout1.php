<?php
$default_settings = [
    'cms_animate' => '',
    'title' => '',
    'position' => '',
    
    'style_star'  => 'five-star',
    'teaching_subject'  => '',
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
<div class="cms-teacher <?php echo esc_attr($cms_animate); ?>">
	<div class="inner-box">
	    <?php if ( $image_html ) : ?>
	        <div class="item-avatar">
	            <?php echo wp_kses_post($image_html); ?>
	        </div>
	    <?php endif; ?>
	    <div class="item-holder">
	        <?php if(!empty($title)) { ?>
	            <h3 class="item-name">    
	                <?php if(!empty($link_attributes)) { ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php } ?>
	                    <?php echo esc_attr($title); ?>
	                <?php if(!empty($link_attributes)) { ?></a><?php } ?>
	            </h3>
	        <?php } ?>
	        <?php if(!empty($position)) { ?>
	            <div class="item-position"><?php echo esc_attr($position); ?></div>
	        <?php } ?>
	    </div>
	    
	    <div class="item-meta">
	        <?php if(!empty($teaching_subject)) { ?>
	            <div class="item-tearch-subject">
	            	<i class="fas fa-file-alt"></i>
	            	<?php echo esc_attr($teaching_subject); ?>
	            </div>
	        <?php } ?>
	        <div class="item-star <?php echo esc_attr($style_star); ?>">
				<i class="fas fa-star"></i>
			    <i class="fas fa-star"></i>
			    <i class="fas fa-star"></i>
			    <i class="fas fa-star"></i>
			    <i class="fas fa-star"></i>
	        </div>
	    </div>
	</div>
</div>