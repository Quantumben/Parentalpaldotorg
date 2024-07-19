<?php
$default_settings = [
    'contact_info' => '',
    'box_title'    => '',
    
    'description_text'  => '',
    'bottom_title'    => '',
    
    'show_title'  => '',
    'show_icon'  => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

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

$has_icon = ! empty( $settings['cms_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['cms_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$icon_tag = 'span';
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-contact-info4 <?php echo esc_attr($cms_animate); ?>">
    <div class="inner-box">
        <?php if($settings['show_title'] == 'true'): ?>
            <?php if ( $box_title ) { ?>
                <h3 class="entry-title">
                    <?php echo esc_attr($box_title); ?>    
                </h3>
            <?php } ?>
        <?php endif; ?>
        <?php if ( $description_text ) { ?>
            <div class="entry-description">
                <?php echo esc_attr($description_text); ?>    
            </div>
        <?php } ?>
        <?php if(isset($settings['contact_info']) && !empty($settings['contact_info']) && count($settings['contact_info'])): ?>
            <ul class="list-li">
                <?php foreach ($settings['contact_info'] as $key => $ct_info):
                        $icon_key = $widget->get_repeater_setting_key( 'cms_icon', 'contact_info', $key );
                        $has_icon = ! empty( $ct_info['cms_icon'] );
                        $widget->add_render_attribute( $icon_key, [
                            'class' => $ct_info['cms_icon'],
                            'aria-hidden' => 'true',
                        ] );
                    ?>
                    <li>
                        <?php if($settings['show_icon'] == 'true'): ?>
                            <?php if ( $has_icon ) : ?>
                                <span class="item--icon">
                                    <?php
                                        if($is_new):
                                            \Elementor\Icons_Manager::render_icon( $ct_info['cms_icon'], [ 'aria-hidden' => 'true' ] );
                                    ?>
                                    <?php else: ?>
                                        <i <?php etc_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo esc_html($ct_info['content'])?>
                   </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if ( $bottom_title ) { ?>
            <div class="entry-bottom-title">
                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                    <?php echo esc_attr($bottom_title); ?>    
                <?php if(!empty($link_attributes)) { ?></a><?php } ?>
            </div>
        <?php } ?>
        <?php if ( $image_html ) : ?>
            <div class="img-bg">
                <?php echo wp_kses_post($image_html); ?>    
            </div>
        <?php endif; ?>
    </div>
</div>

