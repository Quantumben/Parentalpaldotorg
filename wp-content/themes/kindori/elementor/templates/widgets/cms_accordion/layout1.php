<?php
$default_settings = [
    'active_section' => '',
    'cms_accordion' => '',
    'main_icon' => '',
    'icon_active' => '',
    'title_html_tag' => 'div',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);
$active_section = intval($active_section);
$accordions = $widget->get_settings('cms_accordion');
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
if(!empty($accordions)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-accordion layout1">
        <?php foreach ($accordions as $key => $value):
            $is_active = ($key + 1) == $active_section;
            $_id = isset($value['_id']) ? $value['_id'] : '';
            $ac_title = isset($value['ac_title']) ? $value['ac_title'] : '';
            $ac_content = isset($value['ac_content']) ? $value['ac_content'] : '';

            $title_key = $widget->get_repeater_setting_key( 'ac_title', 'cms_accordion', $key );
            $widget->add_render_attribute( $title_key, [
                'class' => [ 'cms-ac-title-text' ],
            ] );
            $widget->add_inline_editing_attributes( $title_key, 'basic' );

            $content_key = $widget->get_repeater_setting_key( 'ac_content', 'cms_accordion', $key );
            $widget->add_render_attribute( $content_key, [
                'id' => $_id.$html_id,
                'class' => [ 'cms-ac-content' ],
            ] );
            if($is_active){
                $widget->add_render_attribute( $content_key, 'style', 'display:block;' );
            }
            $widget->add_inline_editing_attributes( $content_key, 'basic' );
        ?>
            <div class="cms-accordion-item <?php echo esc_attr($cms_animate); ?> <?php echo esc_attr($is_active?'active':''); ?>">
                <<?php etc_print_html($title_html_tag); ?> class="cms-ac-title <?php echo esc_attr($is_active?'active':''); ?>" data-target="<?php echo esc_attr('#' . $_id.$html_id); ?>">
                    <a <?php etc_print_html($widget->get_render_attribute_string( $title_key )); ?>><?php echo esc_html($ac_title); ?></a>
                </<?php etc_print_html($title_html_tag); ?>>
                <div <?php etc_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php echo wp_kses_post(nl2br($ac_content)); ?></div>
            </div>
        <?php
            endforeach;
        ?>
    </div>
<?php endif; ?>