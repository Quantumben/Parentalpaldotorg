<?php
$default_settings = [
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$editor_content = $widget->get_settings_for_display( 'text_editor' );

$editor_content = $widget->parse_text_editor( $editor_content );

$widget->add_render_attribute( 'text_editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix', $cms_animate ] );

$widget->add_inline_editing_attributes( 'text_editor', 'advanced' );
?>
    <div <?php echo ''.$widget->get_render_attribute_string( 'text_editor' ); ?>><?php echo wp_kses_post($editor_content); ?></div>