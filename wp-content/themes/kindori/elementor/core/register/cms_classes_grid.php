<?php
// Post term options
$post_term_options = etc_get_grid_term_options('classes');

// Register Post Grid Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_classes_grid',
        'title' => esc_html__('Classes Grid', 'kindori' ),
        'icon' => 'eicon-gallery-grid',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_classes_grid/layout-image/layout1.jpg'
                                ],
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
                            'name' => 'filter',
                            'label' => esc_html__('Filter on Masonry', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'true' => esc_html__('Enable', 'kindori' ),
                                'false' => esc_html__('Disable', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'filter_default_title',
                            'label' => esc_html__('Filter Default Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('All', 'kindori' ),
                            'condition' => [
                                'filter' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'filter_alignment',
                            'label' => esc_html__('Filter Alignment', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'center',
                            'options' => [
                                'center' => esc_html__('Center', 'kindori' ),
                                'left' => esc_html__('Left', 'kindori' ),
                                'right' => esc_html__('Right', 'kindori' ),
                            ],
                            'condition' => [
                                'filter' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'pagination_type',
                            'label' => esc_html__('Pagination Type', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'pagination' => esc_html__('Pagination', 'kindori' ),
                                'loadmore' => esc_html__('Loadmore', 'kindori' ),
                                'false' => esc_html__('Disable', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'loadmore_style',
                            'label' => esc_html__('Loadmore Style', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default( Primary )', 'kindori' ),
                                'btn-outline' => esc_html__('Primary Outline', 'kindori' ),
                                'btn-primary-noborder' => esc_html__('Primary No Border', 'kindori' ),
                                'btn-white' => esc_html__('White', 'kindori' ),
                                'btn-outline-white' => esc_html__('White Outline', 'kindori' ),
                                'btn-outline-white' => esc_html__('White Outline', 'kindori' ),
                                'btn-white-noborder' => esc_html__('White No Border', 'kindori' ),
                                'btn-secondary' => esc_html__('Secondary', 'kindori' ),
                                'btn-outline-secondary style-1' => esc_html__('Secondary Outline 1', 'kindori' ),
                                'btn-outline-secondary style-2' => esc_html__('Secondary Outline 2', 'kindori' ),
                                'btn-secondary-noborder' => esc_html__('Secondary No Border 1', 'kindori' ),
                                'btn-secondary-noborder style2' => esc_html__('Secondary No Border 2', 'kindori' ),
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Item Gap', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 15,
                            'selectors' => [
                                '{{WRAPPER}} .cms-grid .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;',
                            ],
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
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Display Options', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'show_thumbnail',
                            'label' => esc_html__('Show Thumbnail', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_title',
                            'label' => esc_html__('Show Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('HTML Tag', 'kindori'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default'       => 'h3',
                            'options'       => [
                                'h1'    => 'H1',
                                'h2'    => 'H2',
                                'h3'    => 'H3',
                                'h4'    => 'H4',
                                'h5'    => 'H5',
                                'h6'    => 'H6',
                            ],
                            'condition' => [
                                'show_title' => 'true'
                            ],
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_excerpt',
                            'label' => esc_html__('Show Excerpt', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout' => '1',
                            ],
                        ),
                        array(
                            'name' => 'num_words',
                            'label'=> esc_html__('Number of Words', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 25,
                            'condition' => [
                                'show_excerpt' => 'true',
                                'layout' => '1',
                            ],
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_age',
                            'label' => esc_html__('Show Age', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name'  => 'show_button',
                            'label' => esc_html__('Show Action Button', 'kindori' ),
                            'type'  => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Read more', 'kindori'),
                            'condition' => [
                                'show_button' => 'true',
                                'layout' => '2',
                            ],
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_categories',
                            'label' => esc_html__('Show Categories', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
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