<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_contact_info',
        'title' => esc_html__('Contact Info', 'kindori'),
        'icon' => 'eicon-info-circle-o',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_contact_info/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_contact_info/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_contact_info/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_contact_info/layout-image/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_contact_info/layout-image/layout5.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_contact_info',
                    'label' => esc_html__('Contact Info', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Icon Type', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'icon' => 'Icon',
                                'image' => 'Image',
                            ],
                            'default' => 'icon',
                        ),
                        array(
                            'name' => 'selected_icon',
                            'label' => esc_html__('Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'icon_type' => 'icon',
                            ],
                        ),
                        array(
                            'name' => 'icon_image',
                            'label' => esc_html__( 'Icon Image', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'description' => esc_html__('Select image icon.', 'kindori'),
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                        array(
                            'name' => 'image_size',
                            'label' => esc_html__( 'Choose Image', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .item--icon i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_type'=> 'icon',
                                'layout' => array('5'),
                            ],
                        ),

                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__( 'Icon Size', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 6,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .item--icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type'=> 'icon',
                                'layout' => array('5'),
                            ],
                        ),
                        array(
                            'name' => 'icon_bottom_space',
                            'label' => esc_html__('Icon Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 22,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .box--icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type'=> 'icon',
                                'layout' => array('5'),
                            ],
                        ),
                        array(
                            'name' => 'box_title',
                            'label' => esc_html__('Title Box', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .entry-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_top_space',
                            'label' => esc_html__('Top Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 0,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .entry-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '3'),
                            ],
                        ),
                        array(
                            'name' => 'heading_bottom_space',
                            'label' => esc_html__('Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 20,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .entry-title',
                        ),
                        array(
                            'name' => 'description_text',
                            'label' => esc_html__('Description', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => '',
                            'label_block' => true,
                            'condition' => [
                                'layout' => array('4'),
                            ],
                        ),
                        array(
                            'name' => 'contact_info',
                            'label' => esc_html__('Info Lists', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'label',
                                    'label' => esc_html__('Label', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'cms_icon',
                                    'label' => esc_html__('Icon', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default'     => [
                                        'value'   => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ label }}}',
                        ),
                        array(
                            'name' => 'bottom_title',
                            'label' => esc_html__('Bottom Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'placeholder' => esc_html__('Enter your Bottom title', 'kindori' ),
                            'label_block' => true,
                            'condition' => [
                                'layout' => array('4'),
                            ],
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'kindori' ),
                            'condition' => [
                                'layout' => array('4'),
                            ],
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .list-li li' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Choose Image', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => array('4'),
                            ],
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => esc_html__('Image Size', 'kindori' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                            'condition' => [
                                'layout' => array('4'),
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Setting Options', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style_border',
                            'label' => esc_html__('Border Left & Right', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'border-none' => 'Hidden',
                                'border-show' => 'Show',
                            ],
                            'default' => 'border-none',
                            'condition' => [
                                'layout' => array('5'),
                            ],
                        ),
                        array(
                            'name' => 'show_title',
                            'label' => esc_html__('Show Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_icon',
                            'label' => esc_html__('Show Icon', 'kindori' ),
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