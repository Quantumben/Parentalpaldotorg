<?php
//Register Counter Widget
 etc_add_custom_widget(
    array(
        'name' => 'cms_counter',
        'title' => esc_html__('Counter', 'kindori'),
        'icon' => 'eicon-counter-circle',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(
            'jquery-numerator',
            'cms-counter-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'kindori' ),
                            'type' => Elementor_Theme_Core::LAYOUT_CONTROL,
                            // 'prefix_class' => 'cms-counter-layout',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_counter/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_counter/layout-image/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_counter',
                    'label' => esc_html__('Counter', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'starting_number',
                            'label' => esc_html__('Starting Number', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                        ),
                        array(
                            'name' => 'ending_number',
                            'label' => esc_html__('Ending Number', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 100,
                        ),
                        array(
                            'name' => 'prefix',
                            'label' => esc_html__('Number Prefix', 'kindori'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => '1',
                        ),
                        array(
                            'name' => 'suffix',
                            'label' => esc_html__('Number Suffix', 'kindori'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => '+',
                        ),
                        array(
                            'name' => 'duration',
                            'label' => esc_html__('Animation Duration', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 2000,
                            'min' => 100,
                            'step' => 100,
                        ),
                        array(
                            'name' => 'thousand_separator',
                            'label' => esc_html__('Thousand Separator', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'thousand_separator_char',
                            'label' => esc_html__('Separator', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'condition' => [
                                'thousand_separator' => 'true',
                            ],
                            'options' => [
                                '' => 'Default',
                                '.' => 'Dot',
                                ' ' => 'Space',
                            ],
                            'default' => '',
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'kindori'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('Counter', 'kindori' ),
                            'placeholder' => esc_html__('Counter Title', 'kindori' ),
                        ),
                        array(
                            'name' => 'show_icon',
                            'label' => esc_html__('Show Icon', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Icon Type', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'icon' => esc_html__('Icon', 'kindori'),
                                'image' => esc_html__('Image', 'kindori'),
                            ],
                            'default' => 'icon',
                            'condition' => [
                                'show_icon' => 'true'
                            ]
                        ),
                        array(
                            'name' => 'counter_icon',
                            'label' => esc_html__('Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'show_icon' => 'true',
                                'icon_type' => 'icon'
                            ]
                        ),
                        array(
                            'name' => 'icon_image',
                            'label' => esc_html__('Icon Image', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'default' => '',
                            'condition' => [
                                'show_icon' => 'true',
                                'icon_type' => 'image'
                            ]
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'show_icon' => 'true',
                                'icon_type' => 'icon'
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-counter-icon i' => 'color: {{VALUE}};',
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
                array(
                    'name' => 'section_number',
                    'label' => esc_html__('Number', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'number_color',
                            'label' => esc_html__('Text Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-counter-number-wrapper .elementor-counter-number' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'number_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .elementor-counter-number',
                        ),
                        array(
                            'name' => 'counter_padding',
                            'label' => esc_html__('Padding', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .cms-counter-number-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_title',
                    'label' => esc_html__('Title', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Text Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-counter-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'typography_title',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-counter-title',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);