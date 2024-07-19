<?php
$default_settings = [
    'contact_info' => '',
    'box_title'    => '',
    'show_title'  => '',
    
    'show_icon'  => '',

    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$has_icon = ! empty( $settings['cms_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['cms_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$icon_tag = 'span';
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($settings['contact_info']) && !empty($settings['contact_info']) && count($settings['contact_info'])): ?>
    <div class="cms-contact-info1 <?php echo esc_attr($cms_animate); ?>">
        <?php if($settings['show_title'] == 'true'): ?>
            <?php if ( $box_title ) { ?>
                <h3 class="entry-title">
                    <?php echo esc_attr($box_title); ?>    
                </h3>
            <?php } ?>
        <?php endif; ?>
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
                    <?php if ($ct_info['label']): ?>
                        <label><?php echo esc_html($ct_info['label'])?></label>    
                    <?php endif ?>
                    <?php echo esc_html($ct_info['content'])?>
               </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
