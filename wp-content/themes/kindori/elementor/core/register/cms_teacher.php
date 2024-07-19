<?php
// Register Banner Box Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_teacher',
        'title' => esc_html__('Teacher Ratings', 'kindori' ),
        'icon' => 'eicon-person',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Teacher Box', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Choose Avatar Teacher', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => esc_html__('Image Size', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Teacher Name', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('This is the Name Teacher', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Teacher Name Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .item-name' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'position',
                            'label' => esc_html__('Position', 'kindori'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                        array(
                            'name' => 'teaching_subject',
                            'label' => esc_html__('Teaching Subject', 'kindori'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'style_star',
                            'label' => esc_html__('Choose Star', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'one-star' => '1 Star',
                                'two-star' => '2 Star',
                                'three-star' => '3 Star',
                                'four-star' => '4 Star',
                                'five-star' => '5 Star',
                            ],
                            'default' => 'five-star',
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