<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

// Register Fancybox List Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_fancybox_carousel',
        'title' => esc_html__('Fancybox Carousel', 'kindori'),
        'icon' => 'eicon-ellipsis-h',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(
            'jquery-slick',
            'cms-post-carousel-widget-js',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancybox_carousel/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancybox_carousel/layout-image/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'fancybox_list',
                    'label' => esc_html__('Fancybox', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'fancybox_item',
                            'label' => esc_html__('Add Item', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'fancybox_title',
                                    'label' => esc_html__('Title', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description_text',
                                    'label' => esc_html__('Description', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'placeholder' => esc_html__('Enter your description', 'kindori' ),
                                    'rows' => 10,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                            ),
                            'title_field' => '{{{ fancybox_title }}}',
                            'condition' => [
                                'layout' => array('1'),
                            ],
                        ),
                        array(
                            'name' => 'style_layout',
                            'label' => esc_html__('Style Layout', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'layout-classic',
                            'options' => [
                                'layout-classic' => esc_html__('Classsic', 'kindori' ),
                                'layout-modern' => esc_html__('Modern', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' => array('1'),
                            ],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancybox-carousel .item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'des_color',
                            'label' => esc_html__('Description Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancybox-carousel .item--description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => esc_html__('Image Size', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
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
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'slides_to_show',
                            'label' => esc_html__('Slides to Show', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'options' => [
                                    '' => esc_html__('Default', 'kindori' ),
                                ] + $slides_to_show,
                        ),
                        array(
                            'name' => 'slides_to_scroll',
                            'label' => esc_html__('Slides to Scroll', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'options' => [
                                    '' => esc_html__('Default', 'kindori' ),
                                ] + $slides_to_show,
                            'condition' => [
                                'slides_to_show!' => '1',
                            ],
                        ),
                        array(
                            'name' => 'slides_gutter',
                            'label' => esc_html__('Gutter', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 15,
                            'condition' => [
                                'slides_to_show!' => '1',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide' => 'padding-left: {{VALUE}}px;',
                                '{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide' => 'padding-right: {{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'dots',
                            'label' => esc_html__('Show Dots', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'show_button',
                            'label' => esc_html__('Show Button', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'show_button' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Speed', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'true'
                            ]
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);