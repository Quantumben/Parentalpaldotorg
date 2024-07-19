<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_classes_info',
        'title' => esc_html__('Classes Info', 'kindori'),
        'icon' => 'eicon-price-list',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_classes_info/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Classes Info', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'classes_price',
                            'label' => esc_html__('Price', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'placeholder' => esc_html__('Enter your Price', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_student',
                            'label' => esc_html__('Student', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_lectures',
                            'label' => esc_html__('Lectures ', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_time',
                            'label' => esc_html__('Time', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_learnday',
                            'label' => esc_html__('Learn day', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_language',
                            'label' => esc_html__('Language', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_size',
                            'label' => esc_html__('Size', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'classes_age',
                            'label' => esc_html__('Age', 'kindori' ),
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
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);