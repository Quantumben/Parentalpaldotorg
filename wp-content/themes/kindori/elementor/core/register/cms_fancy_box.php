<?php
// Register Icon Box Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_fancy_box',
        'title' => esc_html__('Fancy Box', 'kindori' ),
        'icon' => 'eicon-icon-box',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout5.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Icon Box', 'kindori' ),
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
                            'label' => esc_html__( 'Image Size', 'kindori' ),
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
                                '{{WRAPPER}} .cms-fancy-box .item--icon i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_type' => 'icon',
                                'layout' => array('1', '2', '4', '5'),
                            ],
                        ),

                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__( 'IconSize', 'kindori' ),
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
                                '{{WRAPPER}} .cms-fancy-box .item--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_bottom_space',
                            'label' => esc_html__('Icon Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 15,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item--icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type' => 'icon',
                                'layout' => array('1', '4'),
                            ],
                        ),
                        array(
                            'name' => 'border_icon_color',
                            'label' => esc_html__('Border Icon Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item--icon:before' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2', '3'),
                            ],
                        ),
                        array(
                            'name' => 'bg_icon_color',
                            'label' => esc_html__('Background Icon Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item--icon .inner-icon' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('2', '3', '5'),
                            ],
                        ),
                        array(
                            'name' => 'style_box_icon',
                            'label' => esc_html__('Position Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'label_block' => true,
                            'default' => 'box-icon-left',
                            'options' => [
                                'box-icon-left' => esc_html__('Left', 'kindori' ),
                                'box-icon-right' => esc_html__('Right', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' => array('3'),
                            ],
                        ),
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('This is the heading', 'kindori' ),
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_bottom_space',
                            'label' => esc_html__('Title Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 15,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '4'),
                            ],
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
                            'name' => 'des_color',
                            'label' => esc_html__('Description Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item--description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'layout' => array('1', '4'),
                            ],
                            'default' => '',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'kindori' ),
                            'condition' => [
                                'layout' => array('1', '2', '4'),
                            ],
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                        array(
                            'name' => 'bg_color',
                            'label' => esc_html__('Background Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .inner-content' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '4'),
                            ],
                        ),
                        array(
                            'name' => 'button_color',
                            'label' => esc_html__('Button Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .btn-fcb' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '4'),
                            ],
                        ),
                        array(
                            'name' => 'border_bottom_color',
                            'label' => esc_html__('Border Bottom Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('1', '4'),
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
                                '{{WRAPPER}} .cms-fancy-box .inner-content' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => array('5'),
                            ],
                        ),
                        array(
                            'name' => 'line_ldp',
                            'label' => esc_html__('Line', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'label_block' => true,
                            'default' => 'line-desibal',
                            'options' => [
                                'line-enable' => esc_html__('Show ', 'kindori' ),
                                'line-desibal' => esc_html__('Hidden', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' => array('5'),
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