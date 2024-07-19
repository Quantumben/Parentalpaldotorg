<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_social_share',
        'title' => esc_html__('Social Share', 'kindori'),
        'icon' => 'eicon-social-icons',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Social Share', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'label_social',
                            'label' => esc_html__('Label Socials Share', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Label Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .entry-label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'show_facebook',
                            'label' => esc_html__('Show Facebook Share', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_twiter',
                            'label' => esc_html__('Show Twiter Share', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_gg',
                            'label' => esc_html__('Show Google Plus Share', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'separator' => 'after',
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