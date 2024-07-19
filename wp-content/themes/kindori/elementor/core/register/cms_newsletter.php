<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_newsletter',
        'title' => esc_html__('Newsletter', 'kindori'),
        'icon' => 'eicon-envelope',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Color Settings', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'email_label',
                            'label' => esc_html__('Email Label', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'button_label',
                            'label' => esc_html__('Button Label', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'rows' => 10,
                            'show_label' => false,
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                            ],
                            'default' => 'style1',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);