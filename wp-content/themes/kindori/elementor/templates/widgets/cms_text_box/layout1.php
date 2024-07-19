<?php
$default_settings = [
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$widget->add_render_attribute( 'box_title', 'class', 'box-title' );
$widget->add_render_attribute( 'box_excperpt', 'class', 'box-excerpt' );

$widget->add_inline_editing_attributes( 'box_title', 'none' );
$widget->add_inline_editing_attributes( 'box_excperpt' );

?>
<div class="cms-textbox <?php echo esc_attr($cms_animate); ?>">
    <?php if(!empty($settings['box_title'])) : ?>
        <h3 <?php etc_print_html($widget->get_render_attribute_string( 'box_title' )); ?>>
            <?php echo esc_html($settings['box_title']); ?>
        </h3>
    <?php endif; ?>

    <?php if(!empty($settings['box_excperpt'])) : ?>
        <div <?php etc_print_html($widget->get_render_attribute_string( 'box_excperpt' )); ?>>
            <?php echo esc_html($settings['box_excperpt']); ?>
        </div>
    <?php endif; ?>
</div>
