<?php
$default_settings = [
    'icon_align' => 'left',
    'style_secondry'      => 'btn-secondary hv-primary',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

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
<?php if(!empty($settings['button_text'])) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-button-wrapper cms-button-layout2 <?php echo esc_attr($cms_animate); ?>">
        <a class="btn <?php echo esc_attr($style_secondry); ?>" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
            <?php if($icon_align == 'left') { ?>
                <span class="btn-icon icon-left">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="btn-text">
                    <?php echo esc_attr($settings['button_text']); ?>
                </span>
            <?php } ?> 
            <?php if($icon_align == 'right') { ?>
                <span class="btn-text">
                    <?php echo esc_attr($settings['button_text']); ?>
                </span>
                <span class="btn-icon icon-right">
                    <i class="fas fa-arrow-right"></i>
                </span>
            <?php } ?>

            <?php if($icon_align == 'hidden') { ?>
                <span class="btn-text">
                    <?php echo esc_attr($settings['button_text']); ?>
                </span>
            <?php } ?>
        </a>
    </div>
<?php endif; ?>
