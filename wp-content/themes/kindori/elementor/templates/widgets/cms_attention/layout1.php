<?php
$default_settings = [
    'list' => '',
    'box_title'    => '',
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
<div class="cms-attention <?php echo esc_attr($cms_animate); ?>">
    <?php if ( $box_title ) { ?>
        <h3 class="entry-title">
            <?php if ( $settings['icon_type'] == 'icon' && $has_icon ) : ?>
                <span class="item--icon">
                    <?php if($is_new):
                        \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        else: ?>
                        <i <?php cms_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
            <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
                <span class="item--icon">
                    <?php $img_icon  = etc_get_image_by_size( array(
                            'attach_id'  => $settings['icon_image']['id'],
                            'thumb_size' => 'full',
                            'class'      => '',
                        ) );
                        $thumbnail_icon    = $img_icon['thumbnail'];
                    echo wp_kses_post($thumbnail_icon); ?>
                </span>
            <?php endif; ?>
            <?php echo esc_attr($box_title); ?>    
        </h3>
    <?php } ?>

    <?php if(isset($settings['list']) && !empty($settings['list']) && count($settings['list'])): ?>
        <ol class="cms-list-items">
            <?php
                foreach ($settings['list'] as $key => $cms_list): 
                ?>
                <li class="<?php echo esc_attr($cms_animate); ?>">
                    <?php echo esc_html($cms_list['content']); ?>
               </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
</div>
