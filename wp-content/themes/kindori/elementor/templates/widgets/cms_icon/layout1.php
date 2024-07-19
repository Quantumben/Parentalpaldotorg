<?php
$default_settings = [
    'icons' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$has_icon = ! empty( $settings['cms_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['cms_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($icons) && !empty($icons) && count($icons)): ?>
    <div class="cms-icon1">
        <?php foreach ($settings['icons'] as $key => $value):
            $icon_key = $widget->get_repeater_setting_key( 'cms_icon', 'icons', $key );
            $has_icon = ! empty( $value['cms_icon'] );
            $widget->add_render_attribute( $icon_key, [
                'class' => $value['cms_icon'],
                'aria-hidden' => 'true',
            ] );

            $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
            if ( ! empty( $value['icon_link']['url'] ) ) {
                $widget->add_render_attribute( $link_key, 'href', $value['icon_link']['url'] );

                if ( $value['icon_link']['is_external'] ) {
                    $widget->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( $value['icon_link']['nofollow'] ) {
                    $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }
            }
            $link_attributes = $widget->get_render_attribute_string( $link_key );
            ?>
            <?php if ( $has_icon ) : ?>
                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                    <?php
                        if($is_new):
                            \Elementor\Icons_Manager::render_icon( $value['cms_icon'], [ 'aria-hidden' => 'true' ] );
                            \Elementor\Icons_Manager::render_icon( $value['cms_icon'], [ 'aria-hidden' => 'true' ] );
                    ?>
                    <?php else: ?>
                        <i <?php cms_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                        <i <?php cms_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>