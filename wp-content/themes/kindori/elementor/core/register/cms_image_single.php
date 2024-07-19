<?php
// Register Single Box Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_image_single',
        'title' => esc_html__('Single Image', 'kindori' ),
        'icon' => 'eicon-info-box',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Single Image', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Choose Image', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => esc_html__('Image Size', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                        array(
                            'name' => 'image_max_height',
                            'label' => esc_html__('Max Height', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-image-single img' => 'max-height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
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
                                '{{WRAPPER}} .cms-image-single' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'animation_effects',
                            'label' => esc_html__('Animation Effects', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'animation-none' => 'None',
                                'cms-animation-left-to-right' => 'Fly Left To Right',
                                'cms-animation-bottom-to-top' => 'Fly Bottom To Top 1',
                                'cms-animation-bottom-to-top2' => 'Fly Bottom To Top 2',
                            ],
                            'default' => 'animation-none',
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