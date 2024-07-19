<?php
// Post term options
$post_term_options = etc_get_grid_term_options('gallery');
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
etc_add_custom_widget(
    array(
        'name' => 'cms_gallery_carousel',
        'title' => esc_html__('Gallery Carousel', 'kindori' ),
        'icon' => 'eicon-posts-carousel',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_gallery_carousel/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
  
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'thumbnail',
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                        array(
                            'name' => 'source',
                            'label' => esc_html__('Select Categories', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options' => $post_term_options,
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => esc_html__('Order By', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'date',
                            'options' => [
                                'date' => esc_html__('Date', 'kindori' ),
                                'ID' => esc_html__('ID', 'kindori' ),
                                'author' => esc_html__('Author', 'kindori' ),
                                'title' => esc_html__('Title', 'kindori' ),
                                'rand' => esc_html__('Random', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'order',
                            'label' => esc_html__('Sort Order', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'kindori' ),
                                'asc' => esc_html__('Ascending', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('Total items', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '6',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                                '{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide' => 'padding-left: {{VALUE}}px;padding-right: {{VALUE}}px;',
                                '{{WRAPPER}} .cms-slick-slider .cms-carousel-inner' => 'margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'dots',
                            'label' => esc_html__('Show Dots', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
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
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'kindori'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                        array(
                            'name' => 'dir',
                            'label' => esc_html__('Direction', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'ltr' => esc_html__('Left', 'kindori'),
                                'rtl' => esc_html__('Right', 'kindori'),
                            ],
                            'default' => 'ltr',
                        ),
                    ),
                ),
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Display Options', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'show_categories',
                            'label' => esc_html__('Show Categories', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
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