<?php
// Register Video Player Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_video_player',
        'title' => esc_html__('Video Player', 'kindori' ),
        'icon' => 'eicon-play',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(

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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout6.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Video Player', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image', 
                            'label' => esc_html__('Choose Image Background', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => array('1', '2', '4','5', '6'),
                            ],
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => esc_html__('Image Size', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                            'condition' => [
                                'layout' => array('1', '2', '4','5', '6'),
                            ],
                        ),
                        array(
                            'name' => 'image_icon',
                            'label' => esc_html__('Choose Icon images', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => array('6'),
                            ],
                        ),
                        // Meta Icon
                        array(
                            'name' => 'video_link',
                            'label' => esc_html__('Link Video', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title Video', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                            'condition' => [
                                'layout' => array('1', '2', '4','5'),
                            ],
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .inner-layout .box-meta .item--title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '2', '4','5'),
                            ],
                            
                        ),
                        array(
                            'name' => 'position_button',
                            'label' => esc_html__('Position Button', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'top-left' => 'Top Left',
                                'top-right' => 'Top Right',
                                'bottom-left' => 'Bottom Left',
                                'bottom-right' => 'Bottom Ringt',
                            ],
                            'default' => 'top-left',
                            'condition' => [
                                'layout' => array( '2', '4' ),
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
                            'condition' => [
                                'layout' => array( '5' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wp-box-meta' => 'text-align: {{VALUE}};',
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