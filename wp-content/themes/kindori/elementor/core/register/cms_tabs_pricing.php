<?php
$elementor_templates = get_posts([
    'post_type' => 'elementor_library',
    'numberposts' => -1,
    'post_status' => 'publish',
]);
$elementor_templates_opt = [
    '' => esc_html__( 'Select Template', 'kindori' ),
];
if($elementor_templates){
    foreach ($elementor_templates as $template) {
        $elementor_templates_opt[$template->ID] = $template->post_title;
    }
}
// Register Tabs Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_tabs_pricing',
        'title' => esc_html__( 'Tabs Pricing', 'kindori' ),
        'icon' => 'eicon-tabs',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => [
            'cms-tabs-widget-js',
            'jquery-slick',
            'cms-teams-list-widget-js',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__( 'Layout', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__( 'Templates', 'kindori' ),
                            'type' => Elementor_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'kindori' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_tabs_pricing/layout1.png'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_tabs',
                    'label' => esc_html__( 'Tabs', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'active_tab',
                            'label' => esc_html__( 'Active Tab', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__( 'Tabs Items', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'tab_title',
                                    'label' => esc_html__( 'Title & Description', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__( 'Tab Title', 'kindori' ),
                                    'placeholder' => esc_html__( 'Tab Title', 'kindori' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'content_type',
                                    'label' => esc_html__( 'Content Type', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'template',
                                    'options' => [
                                        'template' => esc_html__( 'Template', 'kindori' ),
                                        'text_editor' => esc_html__( 'Text Editor', 'kindori' ),
                                    ],
                                ),
                                array(
                                    'name' => 'tab_content_template',
                                    'label' => esc_html__( 'Template', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => '',
                                    'options' => $elementor_templates_opt,
                                    'condition' => [
                                        'content_type' => 'template'
                                    ],
                                ),
                                array(
                                    'name' => 'tab_content',
                                    'label' => esc_html__( 'Content', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'default' => esc_html__( 'Tab Content', 'kindori' ),
                                    'placeholder' => esc_html__( 'Tab Content', 'kindori' ),
                                    'show_label' => false,
                                    'condition' => [
                                        'content_type' => 'text_editor'
                                    ],
                                ),
                            ),
                            'default' => [
                                [
                                    'tab_title' => esc_html__( 'Tab #1', 'kindori' ),
                                    'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                                ],
                                [
                                    'tab_title' => esc_html__( 'Tab #2', 'kindori' ),
                                    'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                                ],
                            ],
                            'title_field' => '{{{ tab_title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_tabs_style',
                    'label' => esc_html__( 'Tabs', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'navigation_width',
                            'label' => esc_html__( 'Navigation Width', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'default' => [
                                'unit' => '%',
                            ],
                            'range' => [
                                '%' => [
                                    'min' => 10,
                                    'max' => 50,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs-title' => 'width: {{SIZE}}{{UNIT}}',
                            ],
                            'condition' => [
                                'type' => 'vertical',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'default' => [
                                'size' => 1,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 10,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs-title, {{WRAPPER}} .cms-tab-content, {{WRAPPER}}.cms-tabs-view-vertical .cms-tab-title' => 'border-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs-title, {{WRAPPER}} .cms-tab-content, {{WRAPPER}}.cms-tabs-view-vertical .cms-tab-title' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__( 'Background Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tab-title.active' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .cms-tab-content' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_title_style',
                    'label' => esc_html__( 'Title', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'tab_color',
                            'label' => esc_html__( 'Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tab-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'tab_active_color',
                            'label' => esc_html__( 'Active Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tab-title.active' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'tab_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-tab-title',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content_style',
                    'label' => esc_html__( 'Content', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__( 'Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tab-content' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'content_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-tab-content',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);