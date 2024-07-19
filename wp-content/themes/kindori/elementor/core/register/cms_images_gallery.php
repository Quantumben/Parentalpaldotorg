<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

// Register Classes Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_images_gallery',
        'title' => esc_html__('Image Gallery', 'kindori'),
        'icon' => 'eicon-slider-push',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_images_gallery/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'content_list',
                    'label' => esc_html__('Images Item', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'images_gallery',
                            'label' => esc_html__('Add Item', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'label_block' => true,
                                ),
                            ),
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => esc_html__('Image Size', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),

                        array(
                            'name' => 'show_thumbnail',
                            'label' => esc_html__('Show Thumbnail', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
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
                        array(
                            'name' => 'nav',
                            'label' => esc_html__('Nav Slides To Show', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                            ],
                            'default' => '3',
                            'condition' => [
                                'layout' => ['1','2','3'],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);