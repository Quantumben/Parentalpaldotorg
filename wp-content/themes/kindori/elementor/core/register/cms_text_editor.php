<?php
// Register Heading Widget
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
$text_columns = range( 1, 10 );
$text_columns = array_combine( $text_columns, $text_columns );
$text_columns[''] = __( 'Default', 'kindori' );
etc_add_custom_widget(
    array(
        'name' => 'cms_text_editor',
        'title' => esc_html__( 'Text Editor', 'kindori' ),
        'icon' => 'eicon-text',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(

        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'editor_section',
                    'label' => esc_html__( 'Text Editor', 'kindori' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'text_editor',
                            'label' => '',
                            'type' => Controls_Manager::WYSIWYG,
                            'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'kindori' ),
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__( 'Content Alignment', 'kindori' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                          'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'kindori' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'kindori' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'kindori' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'kindori' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_color',
                            'label' => __( 'Text Color', 'kindori' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}}' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color hover', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} a:hover' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'type' => Group_Control_Typography::get_type(),
                            'control_type' => 'group',
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