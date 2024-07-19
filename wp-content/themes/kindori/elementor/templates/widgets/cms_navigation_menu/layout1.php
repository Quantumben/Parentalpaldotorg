<?php
$default_settings = [
    'menu' => '',
    'style' => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings); 
if(!empty($menu)) : ?>
    <div class="cms-navigation-wrap <?php echo esc_attr($style); ?> <?php echo esc_attr($cms_animate); ?>">
        <div id="<?php echo esc_attr($html_id); ?>" class="cms-navigation-menu1 <?php echo esc_attr($style); ?>">
            <?php wp_nav_menu(array(
                    'fallback_cb' => '',
                    'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                    'menu'        => wp_get_nav_menu_object($menu),
                    'depth' => 1
                )
            ); ?>
        </div>
    </div>
<?php endif; ?>