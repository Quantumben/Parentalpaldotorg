<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_teacher_info',
        'title' => esc_html__('Teacher Info', 'kindori'),
        'icon' => 'eicon-nerd-wink',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
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
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_teacher_info/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Teacher Contact', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'teacher_title',
                            'label' => esc_html__('Title Box', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'placeholder' => esc_html__('Enter your Price', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'teacher_name',
                            'label' => esc_html__('Teacher Name', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'teacher_phone',
                            'label' => esc_html__('Phone ', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'teacher_email',
                            'label' => esc_html__('Email', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'teacher_address',
                            'label' => esc_html__('Address', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'teacher_degree',
                            'label' => esc_html__('Degree', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'teacher_experience',
                            'label' => esc_html__('Experience', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
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
                    'name' => 'section_icon',
                    'label' => esc_html__('Social Info', 'kindori'),
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
                    'label' => esc_html__('Social Alignment', 'kindori' ),
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