<?php
// Register Button Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_button',
        'title' => esc_html__('Button', 'kindori' ),
        'icon' => 'eicon-button',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_button/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_button/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_button/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_button/layout-image/layout4.jpg'
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
                        //Primary
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Button Primary Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-primary hv-secondary',
                            'options' => [
                                'btn-primary hv-secondary' => esc_html__('Default( Primary )', 'kindori' ),
                                'btn-primary hv-dark' => esc_html__('Primary - Hover Dark', 'kindori' ),
                                'btn-primary hv-white hv-color-primary' => esc_html__('Primary - Hover White 1', 'kindori' ),
                                'btn-primary hv-white hv-color-secon' => esc_html__('Primary - Hover White 2', 'kindori' ),
                                'btn-primary hv-regular' => esc_html__('Primary - Hover Reguler', 'kindori' ),
                                //Primary Outline
                                'btn-primary-ol hv-primary' => esc_html__('Primary Outline - Hover Primary', 'kindori' ),
                                'btn-primary-ol hv-secondary' => esc_html__('Primary Outline - Hover Secondary', 'kindori' ),
                                'btn-primary-ol hv-white hv-color-primary' => esc_html__('Primary Outline - Hover White Color 1', 'kindori' ),
                                'btn-primary-ol hv-white hv-color-secon' => esc_html__('Primary Outline - Hover White Color 2', 'kindori' ),
                                'btn-primary-ol hv-regular' => esc_html__('Primary Outline - Hover Regular Color', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' =>'1',
                            ],
                        ),
                        //Secondary
                        array(
                            'name' => 'style_secondry',
                            'label' => esc_html__('Button Secondary Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-secondary hv-primary',
                            'options' => [
                                'btn-secondary hv-primary' => esc_html__('Secondry', 'kindori' ),
                                'btn-secondary hv-dark' => esc_html__('Secondry - Hover Dark', 'kindori' ),
                                'btn-secondary hv-regular' => esc_html__('Secondry - Hover Regular', 'kindori' ),
                                //Hv White
                                'btn-secondary hv-white hv-white-pr' => esc_html__('Secondry - Hover White 1', 'kindori' ),
                                'btn-secondary hv-white hv-white-sc' => esc_html__('Secondry - Hover White 2', 'kindori' ),
                                //Outline
                                'btn-secondary-ol hv-primary' => esc_html__('Secondry Outline - Hover Primary', 'kindori' ),
                                'btn-secondary-ol hv-secondary' => esc_html__('Secondry Outline - Hover Secondary', 'kindori' ),
                                'btn-secondary-ol hv-white hv-color-primary' => esc_html__('Secondry Outline - Hover White1', 'kindori' ),
                                'btn-secondary-ol hv-white hv-color-secon' => esc_html__('Secondry Outline - Hover White2', 'kindori' ),
                                'btn-secondary-ol hv-regular' => esc_html__('Secondry Outline - Hover Regular', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' =>'2',
                            ],
                        ),

                        //White
                        array(
                            'name' => 'style_white',
                            'label' => esc_html__('Button White Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-white hv-primary',
                            'options' => [
                                'btn-white hv-primary'      => esc_html__('White - Hover Primary', 'kindori' ),
                                'btn-white hv-secondary'    => esc_html__('White - Hover Secondry', 'kindori' ),
                                'btn-white hv-regular'      => esc_html__('White - Hover Regular', 'kindori' ),
                                'btn-white-sc hv-primary'   => esc_html__('White Secondary - Hover Primary', 'kindori' ),
                                'btn-white-sc hv-secondary' => esc_html__('White Secondary - Hover Secondry', 'kindori' ),
                                'btn-white-sc hv-regular'   => esc_html__('White Secondary - Hover Regular', 'kindori' ),
                                'btn-white-sc hv-white'   => esc_html__('White Secondary - Hover White', 'kindori' ),
                                //Outline
                                'btn-white-ol hv-primary' => esc_html__('White Outline - Hover Primary', 'kindori' ),
                                'btn-white-ol hv-primary' => esc_html__('White Outline - Hover Primary', 'kindori' ),
                                'btn-white-ol hv-secondary' => esc_html__('White Outline - Hover Secondary', 'kindori' ),
                                'btn-white-ol hv-regular' => esc_html__('White Outline - Hover Regular', 'kindori' ),
                                'btn-white-ol hv-white' => esc_html__('White Outline - Hover White 1', 'kindori' ),
                                'btn-white-ol hv-white color-primary' => esc_html__('White Outline - Hover White 2', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' =>'3',
                            ],
                        ),

                        //Button No Border
                        array(
                            'name' => 'btn_noborder',
                            'label' => esc_html__('Button No Border Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-noborder-pr hv-secondary',
                            'options' => [
                                'btn-noborder-pr hv-secondary' => esc_html__('Button Primary No Border - Hover Secondry', 'kindori' ),
                                'btn-noborder-pr hv-white' => esc_html__('Button Primary No Border - Hover White', 'kindori' ),
                                'btn-noborder-pr hv-regular' => esc_html__('Button Primary No Border - Hover Regular', 'kindori' ),

                                'btn-noborder-sc hv-primary' => esc_html__('Button Secondary No Border - Hover Primary', 'kindori' ),
                                'btn-noborder-sc hv-white' => esc_html__('Button Secondary No Border - Hover White', 'kindori' ),
                                'btn-noborder-sc hv-regular' => esc_html__('Button Secondary No Border - Hover Regular', 'kindori' ),

                                'btn-noborder-wt hv-primary' => esc_html__('Button White No Border - Hover Primary', 'kindori' ),
                                'btn-noborder-wt hv-secondary' => esc_html__('Button White No Border - Hover Secondary', 'kindori' ),
                                'btn-noborder-wt hv-regular' => esc_html__('Button White No Border - Hover Regular', 'kindori' ),
                                'btn-noborder-wt hv-white color-primary' => esc_html__('Button White 1 No Border - Hover White', 'kindori' ),
                                'btn-noborder-wt hv-white color-secondary' => esc_html__('Button White 2 No Border - Hover White', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' =>'4',
                            ],
                        ),

                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__('https://your-link.com', 'kindori' ),
                            'default' => [
                                'url' => '#',
                            ],
                        ),

                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'left',
                            'options' => [
                                'left' => esc_html__('Before', 'kindori' ),
                                'right' => esc_html__('After', 'kindori' ),
                                'hidden' => esc_html__('Hidden', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'icon-larger',
                            'options' => [
                                'icon-small' => esc_html__('Small', 'kindori' ),
                                'icon-larger' => esc_html__('Larger', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' =>'4',
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
                                '{{WRAPPER}} .cms-button-wrapper' => 'text-align: {{VALUE}};',
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