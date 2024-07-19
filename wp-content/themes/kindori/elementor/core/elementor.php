<?php

$files = scandir(get_template_directory() . '/elementor/core/register');

foreach ($files as $file){
    $pos = strrpos($file, ".php");
    if($pos !== false){
        require_once get_template_directory() . '/elementor/core/register/' . $file;
    }
}

if(!function_exists('kindori_register_custom_icon_library')){
    add_filter('elementor/icons_manager/native', 'kindori_register_custom_icon_library');
    function kindori_register_custom_icon_library($tabs){
        $custom_tabs = [
            'extra_icon1' => [
                'name' => 'material',
                'label' => esc_html__( 'Material Design Iconic', 'kindori' ),
                'url' => get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css',
                'enqueue' => [  ],
                'prefix' => 'zmdi zmdi-',
                'displayPrefix' => 'material',
                'labelIcon' => 'zmdi zmdi-collection-text',
                'ver' => '1.0.0',
                'fetchJson' => get_template_directory_uri() . '/assets/elementor-icon/materialdesign.js',
                'native' => true,
            ],

            'extra_icon2' => [
                'name' => 'flaticon',
                'label' => esc_html__( 'Flaticon', 'kindori' ),
                'url' => get_template_directory_uri() . '/assets/css/flaticon.css',
                'enqueue' => [  ],
                'prefix' => 'flaticon-',
                'displayPrefix' => 'flaticon',
                'labelIcon' => 'zmdi zmdi-collection-text',
                'ver' => '2.2.0',
                'fetchJson' => get_template_directory_uri() . '/assets/elementor-icon/flaticon.js',
                'native' => true,
            ],
        ];

        $tabs = array_merge($custom_tabs, $tabs);

        return $tabs;
    }
}