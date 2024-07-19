<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_attention',
        'title' => esc_html__('Attention', 'kindori'),
        'icon' => 'eicon-editor-list-ul',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Attention', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'box_title',
                            'label' => esc_html__('Title Box', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .entry-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_top_space',
                            'label' => esc_html__('Top Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 0,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .entry-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '3'),
                            ],
                        ),
                        array(
                            'name' => 'heading_bottom_space',
                            'label' => esc_html__('Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 20,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .entry-title',
                        ),
                        array(
                            'name' => 'list',
                            'label' => esc_html__('Item', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-list-items li' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Icon Type', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'icon' => 'Icon',
                                'image' => 'Image',
                            ],
                            'default' => 'icon',
                        ),
                        array(
                            'name' => 'selected_icon',
                            'label' => esc_html__('Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'icon_type' => 'icon',
                            ],
                        ),
                        array(
                            'name' => 'icon_image',
                            'label' => esc_html__( 'Icon Image', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'description' => esc_html__('Select image icon.', 'kindori'),
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                        array(
                            'name' => 'image_size',
                            'label' => esc_html__( 'Choose Image', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .item--icon i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_type'=> 'icon',
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