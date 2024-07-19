<?php
// Register Accordion Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_accordion',
        'title' => esc_html__('Accordion', 'kindori' ),
        'icon' => 'eicon-accordion',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(
            'cms-accordion-widget-js'
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
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_accordion/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_accordion/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_accordion/layout-image/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'active_section',
                            'label' => esc_html__('Active section', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after',
                        ),
                        // Layout 1,2
                        array(
                            'name' => 'cms_accordion',
                            'label' => esc_html__('Accordion Items', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [
                                [
                                    'ac_title' => esc_html__('Accordion #1', 'kindori' ),
                                    'ac_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                                ],
                                [
                                    'ac_title' => esc_html__('Accordion #2', 'kindori' ),
                                    'ac_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'ac_title',
                                    'label' => esc_html__('Title', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'ac_content',
                                    'label' => esc_html__('Content', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                ),
                            ),
                            'title_field' => '{{{ ac_title }}}',
                            'separator' => 'after',
                            'condition' => [
                                'layout' =>array('1','2'),
                            ],
                        ),
                        // Layout 3
                        array(
                            'name' => 'cms_accordion2',
                            'label' => esc_html__('Accordion Items', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [
                                [
                                    'ac_title' => esc_html__('Accordion #1', 'kindori' ),
                                    'ac_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                                ],
                                [
                                    'ac_title' => esc_html__('Accordion #2', 'kindori' ),
                                    'ac_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'ac_title',
                                    'label' => esc_html__('Title', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'ac_content',
                                    'label' => esc_html__('Content', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                ),
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ ac_title }}}',
                            'separator' => 'after',
                            'condition' => [
                                'layout' =>'3',
                            ],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-accordion .cms-ac-title a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'active_title_color',
                            'label' => esc_html__('Title Color Active', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-accordion .cms-accordion-item.active .cms-ac-title a' => 'color: {{VALUE}};',
                            ],
                        ),

                        array(
                            'name' => 'bg_title_color',
                            'label' => esc_html__('Background Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-accordion .cms-ac-title' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' =>'2',
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-accordion .cms-ac-title',
                            'condition' => [
                                'layout' =>'3',
                            ],
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-accordion .cms-ac-content' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'bg_color',
                            'label' => esc_html__('Background Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-accordion .inner-layout' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' =>'3',
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