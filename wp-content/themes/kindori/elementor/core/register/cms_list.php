<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_list',
        'title' => esc_html__('Lists', 'kindori'),
        'icon' => 'eicon-editor-list-ul',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Lists', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'list',
                            'label' => esc_html__('Info Lists', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'item_link',
                                    'label' => esc_html__('Link', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-list' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-list.style1 i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Styles', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                                'style4' => 'Style 4',
                                'style5' => 'Style 5',
                                'style6' => 'Style 6',
                                'style7' => 'Style 7',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'cicon_color',
                            'label' => esc_html__('Icon Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-list li:before' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style' => array('style1', 'style3'),
                            ],
                        ),

                        array(
                            'name' => 'bg_cicon_color',
                            'label' => esc_html__('Background Icon Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-list.style3 li:before' => 'background-color: {{VALUE}}!important;',
                            ],
                            'condition' => [
                                'style' => 'style3',
                            ],
                        ),
                        array(
                            'name' => 'item_top_space',
                            'label' => esc_html__('Bottom Spacing', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-list li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
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