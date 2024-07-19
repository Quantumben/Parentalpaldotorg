<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_text_box',
        'title' => esc_html__('Text Box', 'kindori'),
        'icon' => 'eicon-text',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_text_box/layout-image/layout1.jpg'
                                ],

                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_text_box',
                    'label' => esc_html__('Text Box', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'box_title',
                            'label' => esc_html__('Box Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                            'condition' => [
                                'layout' => '1',
                            ],
                        ),
                        array(
                            'name' => 'box_excperpt',
                            'label' => esc_html__('Box Excerpt', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => '',
                            'placeholder' => esc_html__('Enter your excerpt', 'kindori' ),
                            'label_block' => true,
                            'condition' => [
                                'layout' => '1',
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
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title Style', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-textbox .box-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_bottom_space',
                            'label' => esc_html__('Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 15,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-textbox .box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .box-title',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);