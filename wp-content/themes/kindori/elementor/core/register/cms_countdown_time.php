<?php
// Register Icon Box Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_countdown_time',
        'title' => esc_html__('Countdown Time', 'kindori' ),
        'icon' => 'eicon-countdown',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(
            'cms-countdown-time-widget-js',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_countdown_time/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_countdown_time/layout-image/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Time to', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('This is the heading', 'kindori' ),
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'time_to',
                            'label' => esc_html__('Enter the time', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::DATE_TIME,
                            'default' => '09/19/2020 00:00 AM',
                            'label_block' => true,
                            'description' => 'Time Format: 09/19/2020 00:00 AM'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title Box', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => array('2'),
                    ],
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .item--title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        array(
                            'name' => 'title_bottom_space',
                            'label' => esc_html__('Title Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 35,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-count-down .item--title',
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_number',
                    'label' => esc_html__('Countdown Number', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'number_background',
                            'label' => esc_html__('Number Background', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .inner-number' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '2'),
                            ],
                        ),
                        array(
                            'name' => 'number_color',
                            'label' => esc_html__('Number Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .inner-number' => 'color: {{VALUE}};',
                            ],
                        ),
                        // Day color setting
                        array(
                            'name' => 'background_color_item1',
                            'label' => esc_html__('Day - Border color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(1) .time-item-inner' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(1) .time-item-inner .inner-text' => 'border-top-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        array(
                            'name' => 'background_color_day',
                            'label' => esc_html__('Day - Background Number', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(1) .time-item-inner .day' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        // Hours color setting
                        array(
                            'name' => 'background_color_item2',
                            'label' => esc_html__('Hours - Border color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(2) .time-item-inner' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(2) .time-item-inner .inner-text' => 'border-top-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        array(
                            'name' => 'background_color_hours',
                            'label' => esc_html__('Hours - Background Number', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(2) .time-item-inner .hour' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        // Hours color setting
                        array(
                            'name' => 'background_color_item3',
                            'label' => esc_html__('Minute - Border color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(3) .time-item-inner' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(3) .time-item-inner .inner-text' => 'border-top-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        array(
                            'name' => 'background_color_minute',
                            'label' => esc_html__('Minute - Background Number', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(3) .time-item-inner .minute' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),

                        // Second color setting
                        array(
                            'name' => 'background_color_item4',
                            'label' => esc_html__('Second - Border color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(4) .time-item-inner' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(4) .time-item-inner .inner-text' => 'border-top-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        array(
                            'name' => 'background_color_second',
                            'label' => esc_html__('Second - Background color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .time-item:nth-child(4) .time-item-inner .second' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2'),
                            ],
                        ),
                        
                        
                    ),
                ),

                array(
                    'name' => 'section_style_text',
                    'label' => esc_html__('Countdown Text', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_background',
                            'label' => esc_html__('Text Background', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .inner-text' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Text Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cms-count-down .inner-text' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);