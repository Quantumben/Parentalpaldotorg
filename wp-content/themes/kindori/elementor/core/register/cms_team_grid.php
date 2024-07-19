<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_team_grid',
        'title' => esc_html__('Teacher Grid', 'kindori'),
        'icon' => 'eicon-user-circle-o',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_team_grid/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'kindori'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Teacher List', 'kindori'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Name', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'position',
                                    'label' => esc_html__('Position', 'kindori'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                                array(
                                    'name' => 'social',
                                    'label' => esc_html__( 'Social', 'kindori' ),
                                    'type' => Elementor_Theme_Core::ICONS_CONTROL,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
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
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'thumbnail',
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns XS Devices', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => esc_html__('1', 'kindori' ),
                                '2' => esc_html__('2', 'kindori' ),
                                '3' => esc_html__('3', 'kindori' ),
                                '4' => esc_html__('4', 'kindori' ),
                                '6' => esc_html__('6', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'col_sm',
                            'label' => esc_html__('Columns SM Devices', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '2',
                            'options' => [
                                '1' => esc_html__('1', 'kindori' ),
                                '2' => esc_html__('2', 'kindori' ),
                                '3' => esc_html__('3', 'kindori' ),
                                '4' => esc_html__('4', 'kindori' ),
                                '6' => esc_html__('6', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'col_md',
                            'label' => esc_html__('Columns MD Devices', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => esc_html__('1', 'kindori' ),
                                '2' => esc_html__('2', 'kindori' ),
                                '3' => esc_html__('3', 'kindori' ),
                                '4' => esc_html__('4', 'kindori' ),
                                '6' => esc_html__('6', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'col_lg',
                            'label' => esc_html__('Columns LG Devices', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '4',
                            'options' => [
                                '1' => esc_html__('1', 'kindori' ),
                                '2' => esc_html__('2', 'kindori' ),
                                '3' => esc_html__('3', 'kindori' ),
                                '4' => esc_html__('4', 'kindori' ),
                                '6' => esc_html__('6', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'col_xl',
                            'label' => esc_html__('Columns XL Devices', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '4',
                            'options' => [
                                '1' => esc_html__('1', 'kindori' ),
                                '2' => esc_html__('2', 'kindori' ),
                                '3' => esc_html__('3', 'kindori' ),
                                '4' => esc_html__('4', 'kindori' ),
                                '6' => esc_html__('6', 'kindori' ),
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);