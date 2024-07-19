<?php
$default_settings = [
    'list' => '',
    'style' => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<?php if(isset($settings['list']) && !empty($settings['list']) && count($settings['list'])): ?>
    <ul class="cms-list <?php echo esc_attr($style); ?>">
        <?php
        	foreach ($settings['list'] as $key => $cms_list): 
        	$link_key = $widget->get_repeater_setting_key( 'list', 'value', $key );
            if ( ! empty( $cms_list['item_link']['url'] ) ) {
                $widget->add_render_attribute( $link_key, 'href', $cms_list['item_link']['url'] );

                if ( $cms_list['item_link']['is_external'] ) {
                    $widget->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( $cms_list['item_link']['nofollow'] ) {
                    $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }
            }
            $link_attributes = $widget->get_render_attribute_string( $link_key );
        	?>
            <li class="<?php echo esc_attr($cms_animate); ?>">
				<a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
            		<?php echo esc_html($cms_list['content']); ?>
            	</a>
           </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
