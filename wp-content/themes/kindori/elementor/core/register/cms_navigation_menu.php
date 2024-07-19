<?php
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
            $custom_menus[ $single_menu->term_id ] = $single_menu->name;
        }
    }
} else {
    $custom_menus = '';
}
etc_add_custom_widget(
    array(
        'name' => 'cms_navigation_menu',
        'title' => esc_html__('Navigation Menu', 'kindori'),
        'icon' => 'eicon-menu-bar',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Select Menu', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => $custom_menus,
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-navigation-menu1 ul.menu li a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color Hover & Active', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-navigation-menu1 ul.menu li a:hover, {{WRAPPER}} .cms-navigation-menu1 ul.menu li.current_page_item > a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                          'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'kindori' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'kindori' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'kindori' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'kindori' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-navigation-menu1' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'cms_animate',
                            'label' => esc_html__('Theme Animate', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => kindori_animate(),
                            'default' => '',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);