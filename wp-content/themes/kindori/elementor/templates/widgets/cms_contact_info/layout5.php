<?php
$default_settings = [
    'contact_info' => '',
    'box_title'    => '',
    'show_title'  => '',
    'style_border'  => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );

if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$icon_attributes = $widget->get_render_attribute_string( 'selected_icon' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-contact-info5 <?php echo esc_attr($style_border.' '.$cms_animate); ?>">

    <?php if ( $settings['icon_type'] == 'icon' && $has_icon ) : ?>
        <div class="item--icon">
            <?php if($is_new):
                \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                else: ?>
                <i <?php cms_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
        <div class="item--icon">
            <?php $img_icon  = etc_get_image_by_size( array(
                    'attach_id'  => $settings['icon_image']['id'],
                    'thumb_size' => 'full',
                    'class'      => '',
                ) );
                $thumbnail_icon    = $img_icon['thumbnail'];
            echo wp_kses_post($thumbnail_icon); ?>
        </div>
    <?php endif; ?>

    <?php if($settings['show_title'] == 'true'): ?>
        <?php if ( $box_title ) { ?>
            <h3 class="entry-title">
                <?php echo esc_attr($box_title); ?>    
            </h3>
        <?php } ?>
    <?php endif; ?>

    <?php if(isset($settings['contact_info']) && !empty($settings['contact_info']) && count($settings['contact_info'])): ?>
        <ul class="list-li">
            <?php foreach ($settings['contact_info'] as $key => $ct_info): ?>
                <li>
                    <?php echo esc_html($ct_info['content'])?>
               </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
