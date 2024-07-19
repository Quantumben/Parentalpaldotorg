<?php

// Register Contact Form 7 Widget
if(class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->ID] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'kindori')] = 0;
    }

    etc_add_custom_widget(
        array(
            'name' => 'cms_ctf7',
            'title' => esc_html__('Contact Form 7', 'kindori'),
            'icon' => 'eicon-form-horizontal',
            'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
            'scripts' => array(),
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
                                        'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_ctf7/layout-image/layout1.jpg'
                                    ],
                                ],
                            ),
                        ),
                    ),
                    array(
                        'name' => 'source_section',
                        'label' => esc_html__('Source Settings', 'kindori'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                        'controls' => array(
                            array(
                                'name' => 'style',
                                'label' => esc_html__('Style', 'kindori' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'style1' => 'Style 1',
                                    'style2' => 'Style 2',
                                    'style3' => 'Style 3',
                                ],
                                'default' => 'style1',
                            ),
                            array(
                                'name' => 'ctf7_title',
                                'label' => esc_html__('Title', 'kindori' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'heading_bottom_space',
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
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .cms-contact-form .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'ctf7_description',
                                'label' => esc_html__('Description', 'kindori' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 10,
                                'show_label' => false,
                            ),
                            array(
                                'name' => 'ctf7_id',
                                'label' => esc_html__('Select Form', 'kindori'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => $contact_forms,
                            ),
                            array(
                                'name' => 'button_style',
                                'label' => esc_html__('Button Style', 'kindori' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'button-style1' => 'Inline Block',
                                    'button-style2' => 'Block',
                                ],
                                'default' => 'button-style1',
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
}