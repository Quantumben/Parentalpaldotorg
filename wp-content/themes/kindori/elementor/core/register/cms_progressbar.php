<?php

// Register Progress Bar Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_progressbar',
        'title' => esc_html__( 'Progress Bar', 'kindori' ),
        'icon' => 'eicon-skill-bar',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(
            'cms-progressbar-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__( 'Source Settings', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'progressbar_list',
                            'label' => esc_html__( 'Progress Bar Lists', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__( 'Title', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'placeholder' => esc_html__( 'Enter your title', 'kindori' ),
                                    'default' => esc_html__( 'My Skill', 'kindori' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'percent',
                                    'label' => esc_html__( 'Percentage', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'default' => [
                                        'size' => 50,
                                        'unit' => '%',
                                    ],
                                    'label_block' => true,
                                ),
                            ),
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