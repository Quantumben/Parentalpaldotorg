<?php
$default_settings = [
    'contact_info2' => '',
    'box_title'    => '',
    'show_title'  => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$has_icon = ! empty( $settings['cms_icon2'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['cms_icon2'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$icon_attributes = $widget->get_render_attribute_string( 'cms_icon2' );
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>

    <div class="cms-contact-info2 <?php echo esc_attr($cms_animate); ?>">
        <?php if ( $has_icon ) : ?>
            <div class="item--icon">
                <?php
                    if($is_new):
                        \Elementor\Icons_Manager::render_icon( $settings['cms_icon2'], [ 'aria-hidden' => 'true' ] );
                ?>
                <?php else: ?>
                    <i <?php etc_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if(isset($settings['contact_info2']) && !empty($settings['contact_info2']) && count($settings['contact_info2'])): ?>        
            <ul class="list-li">
                <?php foreach ($settings['contact_info2'] as $key => $ct_info):?>
                    <li><?php echo esc_html($ct_info['content2'])?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
