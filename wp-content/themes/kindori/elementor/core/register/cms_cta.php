<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_cta',
        'title' => esc_html__('Call To Action', 'kindori'),
        'icon' => 'eicon-image-rollover',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_cta/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_cta/layout-image/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('This is the heading', 'kindori' ),
                            'placeholder' => esc_html__('Enter your title', 'kindori' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'description_text',
                            'label' => esc_html__('Sub Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => esc_html__('Click edit button to change this text.', 'kindori' ),
                            'placeholder' => esc_html__('Enter your sub title', 'kindori' ),
                            'rows' => 10,
                            'show_label' => false,
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
                        ),
                        array(
                            'name' => 'cms_animate',
                            'label' => esc_html__('Theme Animate', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => kindori_animate(),
                            'default' => '',
                        ),
                    ),
                    'title_field' => '{{{ content }}}',
                ),

                array(
                    'name' => 'heading_style',
                    'label' => esc_html__('Heading Style', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-cta .item--title' => 'color: {{VALUE}};',
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
                                '{{WRAPPER}} .cms-cta .item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-cta .item--title',
                        ),
                    ),
                ),
                array(
                    'name' => 'sub_style',
                    'label' => esc_html__('Sub Heading Style', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'des_color',
                            'label' => esc_html__('Subt Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-cta .item--description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_bottom_space',
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
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-cta .item--description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'sub_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-cta .item--description',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Button Style', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'button_color',
                            'label' => esc_html__('Buttom Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-cta .item--button a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_color_hv',
                            'label' => esc_html__('Buttom Color Hover', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-cta .item--button a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'style_btn',
                            'label' => esc_html__('Background Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'label_block' => true,
                            'default' => 'btn-primary hv-secondary',
                            'options' => [
                                'btn-primary hv-secondary' => esc_html__('Default( Primary )', 'kindori' ),
                                'btn-primary hv-primary' => esc_html__('Default( Primary color hover )', 'kindori' ),
                                'btn-primary hv-third' => esc_html__('Default( Third Color Hover )', 'kindori' ),
                                'btn-primary hv-four' => esc_html__('Default( Four Color Hover )', 'kindori' ),
                                'btn-primary hv-five' => esc_html__('Default( Five Color Hover )', 'kindori' ),
                                'btn-primary hv-white' => esc_html__('Default( White Color Hover )', 'kindori' ),

                                'btn-secondary hv-primary' => esc_html__('Secondry - Primary Hover', 'kindori' ),
                                'btn-secondary hv-third' => esc_html__('Secondry - Third color Hover', 'kindori' ),
                                'btn-secondary hv-four' => esc_html__('Secondry -  Four color Hover', 'kindori' ),
                                'btn-secondary hv-five' => esc_html__('Secondry - Five color Hover', 'kindori' ),
                                'btn-secondary hv-white' => esc_html__('Secondry - White color Hover', 'kindori' ),

                                'btn-third hv-primary'      => esc_html__('Third Color - Primary Color Hover', 'kindori' ),
                                'btn-third hv-secondary'      => esc_html__('Third Color - Secondary Color Hover', 'kindori' ),
                                'btn-third hv-four'      => esc_html__('Third Color - Four Color Hover', 'kindori' ),
                                'btn-third hv-five'      => esc_html__('Third Color - Five Color Hover', 'kindori' ),
                                'btn-third hv-white'      => esc_html__('Third Color - White Color Hover', 'kindori' ),

                                'btn-four hv-primary'      => esc_html__('Four Color - Primary Hover', 'kindori' ),
                                'btn-four hv-secondary'      => esc_html__('Four Color - Secondary Color Hover', 'kindori' ),
                                'btn-four hv-third'      => esc_html__('Four Color - Third Color Hover', 'kindori' ),
                                'btn-four hv-five'      => esc_html__('Four Color - Five Color Hover', 'kindori' ),
                                'btn-four hv-white'      => esc_html__('Four Color - White Color Hover', 'kindori' ),

                                'btn-five hv-primary'      => esc_html__('Five Color - Primary color Hover', 'kindori' ),
                                'btn-five hv-secondary'      => esc_html__('Five Color - Secondary color Hover', 'kindori' ),
                                'btn-five hv-third'      => esc_html__('Five Color - Third color Hover', 'kindori' ),
                                'btn-five hv-four'      => esc_html__('Five Color -  Four Color Hover', 'kindori' ),
                                'btn-five hv-white'      => esc_html__('Five Color - White Color Hover', 'kindori' ),

                                'btn-white hv-primary'      => esc_html__('White Color - Primary color Hover', 'kindori' ),
                                'btn-white hv-secondary'      => esc_html__('White Color - Secondary color Hover', 'kindori' ),
                                'btn-white hv-third'      => esc_html__('White Color - Third color Hover', 'kindori' ),
                                'btn-white hv-four'      => esc_html__('White Color -  Four Color Hover', 'kindori' ),
                                'btn-white hv-five'      => esc_html__('White Color -  Five Color Hover', 'kindori' ),
                                'btn-white hv-extra'      => esc_html__('White Color -  Gradient Hover 1', 'kindori' ),
                                'btn-white hv-extra2'      => esc_html__('White Color -  Gradient Hover 2', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'style_box_shadow',
                            'label' => esc_html__('Shadow Bottom hover', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'label_block' => true,
                            'default' => 'shadow-off',
                            'options' => [
                                'shadow-off' => esc_html__('Off', 'kindori' ),
                                'shadow-on' => esc_html__('On', 'kindori' ),
                            ],
                            'condition' => [
                                'layout' => '1',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);