<?php

// Register Google Maps Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_google_map',
        'title' => esc_html__( 'Google Maps', 'kindori' ),
        'icon' => 'eicon-google-maps',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(
            'maps-googleapis',
            'custom-gm-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__( 'Source Settings', 'kindori' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'address',
                            'label' => esc_html__( 'Address', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'coordinate',
                            'label' => esc_html__( 'Coordinate', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '51.505858, -0.123633',
                        ),
                        array(
                            'name' => 'infoclick',
                            'label' => esc_html__( 'Click Show Info Window', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'markercoordinate',
                            'label' => esc_html__( 'Marker Coordinate', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'kindori')
                        ),
                        array(
                            'name' => 'markertitle',
                            'label' => esc_html__( 'Marker Title', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'markerdesc',
                            'label' => esc_html__( 'Marker Description', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'description' => esc_html__('Enter Description Info windows for marker', 'kindori')
                        ),
                        array(
                            'name' => 'markericon',
                            'label' => esc_html__( 'Marker Icon', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'description' => esc_html__('Select image icon for marker', 'kindori')
                        ),
                        array(
                            'name' => 'markerlist',
                            'label' => esc_html__( 'Marker List', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'coordinate',
                                    'label' => esc_html__( 'Coordinate', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__( 'Title', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__( 'Description', 'kindori' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                ),
                            ),
                        ),
                        array(
                            'name' => 'infowidth',
                            'label' => esc_html__( 'Info Window Max Width', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => esc_html__('Set max width for info window', 'kindori')
                        ),
                        array(
                            'name' => 'type',
                            'label' => esc_html__( 'Map Type', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'ROADMAP' => 'ROADMAP',
                                'HYBRID' => 'HYBRID',
                                'SATELLITE' => 'SATELLITE',
                                'TERRAIN' => 'TERRAIN'
                            ],
                            'default' => 'ROADMAP',
                            'description' => esc_html__('Select the map type.', 'kindori')
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__( 'Style Template', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => 'Google Default',
                                'light-monochrome' => 'Light Monochrome',
                                'blue-water' => 'Blue water',
                                'midnight-commander' => 'Midnight Commander',
                                'paper' => 'Paper',
                                'red-hues' => 'Red Hues',
                                'hot-pink' => 'Hot Pink',
                                'custom' => 'Custom',
                            ],
                            'default' => '',
                            'description' => esc_html__('Select the map template.', 'kindori')
                        ),
                        array(
                            'name' => 'content',
                            'label' => esc_html__( 'Custom Template', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::CODE,
                            'language' => 'json',
                            'description' => esc_html__('Get template from //snazzymaps.com', 'kindori'),
                            'condition' => [
                                'style' => 'custom',
                            ],
                        ),
                        array(
                            'name' => 'zoom',
                            'label' => esc_html__( 'Zoom', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => 13,
                            'description' => esc_html__('Set max width for info window', 'kindori')
                        ),
                        array(
                            'name' => 'width',
                            'label' => esc_html__( 'Width', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => 'auto',
                            'description' => esc_html__('Width of map without pixel, default is auto', 'kindori')
                        ),
                        array(
                            'name' => 'height',
                            'label' => esc_html__( 'Height', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '350px',
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'scrollwheel',
                            'label' => esc_html__( 'Scroll Wheel', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'pancontrol',
                            'label' => esc_html__( 'Pan Control', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'zoomcontrol',
                            'label' => esc_html__( 'Zoom Control', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'scalecontrol',
                            'label' => esc_html__( 'Scale Control', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'maptypecontrol',
                            'label' => esc_html__( 'Map Type Control', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'streetviewcontrol',
                            'label' => esc_html__( 'Street View Control', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                        array(
                            'name' => 'overviewmapcontrol',
                            'label' => esc_html__( 'Over View Map Control', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'kindori')
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);