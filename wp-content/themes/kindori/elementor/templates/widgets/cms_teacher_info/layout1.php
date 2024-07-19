<?php
$default_settings = [
    'teacher_title' => '',
    'teacher_name' => '',
    'teacher_phone' => '',
    'teacher_email' => '',
    'teacher_degree' => '',
    'teacher_experience' => '',
    'teacher_address' => '',
    // Social
    'icons' => '',
    'cms_animate' => '',
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
<div class="cms-teacher-info">
    <div class="inner-layout">
        <?php if ( $teacher_title ) { ?>
            <div class="class-el-title">
                <span><?php echo esc_attr($teacher_title); ?></span>
            </div>
        <?php } ?>
        <ul class="teacher-list">
            <?php if ( $teacher_name ) { ?>
                <li class="teacher-item-info">
                    <label><?php echo esc_html__( 'Name: ', 'kindori' ) ?></label><?php echo esc_attr($teacher_name); ?>
               </li>
            <?php } ?>
            <?php if ( $teacher_phone ) { ?>
                <li class="teacher-item-info">
                    <label><?php echo esc_html__( 'Phone: ', 'kindori' ) ?></label><?php echo esc_attr($teacher_phone); ?>    
               </li>
            <?php } ?>
            <?php if ( $teacher_email ) { ?>
                <li class="teacher-item-info">
                    <label><?php echo esc_html__( 'Email: ', 'kindori' ) ?></label><?php echo esc_attr($teacher_email); ?>    
               </li>
            <?php } ?>
            <?php if ( $teacher_address ) { ?>
                <li class="teacher-item-info">
                    <label><?php echo esc_html__( 'Address: ', 'kindori' ) ?></label><?php echo esc_attr($teacher_address); ?>    
               </li>
            <?php } ?>
            <?php if ( $teacher_degree ) { ?>
                <li class="teacher-item-info">
                    <label><?php echo esc_html__( 'Degree: ', 'kindori' ) ?></label><?php echo esc_attr($teacher_degree); ?>    
               </li>
            <?php } ?>
            <?php if ( $teacher_experience ) { ?>
                <li class="teacher-item-info">
                    <label><?php echo esc_html__( 'Experience: ', 'kindori' ) ?></label><?php echo esc_attr($teacher_experience); ?>    
               </li>
            <?php } ?>
        </ul>
        <?php if(isset($icons) && !empty($icons) && count($icons)): ?>
            <div class="cms-social-teacher">
                <label><?php echo esc_html__( 'Contact: ', 'kindori' ) ?></label>
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
                            ?>
                            <?php else: ?>
                                <i <?php cms_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

