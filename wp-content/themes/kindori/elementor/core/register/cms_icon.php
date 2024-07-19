<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_icon',
        'title' => esc_html__('Icons', 'kindori'),
        'icon' => 'eicon-alert',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_icon',
                    'label' => esc_html__('Icons', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'icons',
                            'label' => esc_html__('Icons', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'cms_icon',
                                    'label' => esc_html__('Icon', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'icon_link',
                                    'label' => esc_html__('Icon Link', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                        ),
                        array(
                            'name' => 'color',
                            'label' => esc_html__('Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-icon1 a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'bg_color',
                            'label' => esc_html__('Background Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-icon1 a' => 'background-color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'color_hover',
                            'label' => esc_html__('Color Hover', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-icon1 a:hover' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'bg_color_hover',
                            'label' => esc_html__('Background Color Hover', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-icon1 a:hover' => 'background-color: {{VALUE}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__('Content Alignment', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__('Left', 'kindori' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'kindori' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'kindori' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-icon1' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);