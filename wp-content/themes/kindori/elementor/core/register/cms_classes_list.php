<?php
// Post term options
$post_term_options = etc_get_grid_term_options('classes');

// Register Post Grid Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_classes_list',
        'title' => esc_html__('Classes List Post', 'kindori' ),
        'icon' => 'eicon-post-list',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => [
            'imagesloaded',
            'isotope',
            'cms-post-grid-widget-js',
        ],
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_classes_list/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'title_section',
                    'label' => esc_html__('Heading Layout', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'heading_text',
                            'label' => esc_html__('Heading', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => esc_html__('This is the heading', 'kindori' ),
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'heading_size',
                            'label' => esc_html__('Heading HTML Tag', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'span' => 'span',
                                'p' => 'p',
                            ],
                            'default' => 'h3',
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .custom-heading' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_bottom_space',
                            'label' => esc_html__('Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 15,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .custom-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .custom-heading',
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
                                '{{WRAPPER}} .custom-heading' => 'text-align: {{VALUE}};',
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
                            'name' => 'show_thumbnail',
                            'label' => esc_html__('Show Thumbnail', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'separator' => 'after',
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