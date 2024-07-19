<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/libs/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'kindori_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
*/
function kindori_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        /* CMS Plugin */
        array(
            'name'               => esc_html__('1 Redux Framework', 'kindori'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Elementor', 'kindori'),
            'slug'               => 'elementor',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Elementor Theme Core', 'kindori'),
            'slug'               => 'elementor-theme-core',
            'source'             => esc_url('https://cmssuperheroes.com/plugins/elementor/elementor-theme-core.zip'),
            'required'           => true,
        ),
        
        array(
            'name'               => esc_html__('Import Export', 'kindori'),
            'slug'               => 'swa-import-export',
            'source'             => esc_url('https://cmssuperheroes.com/plugins/elementor/swa-import-export.zip'),
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Revolution Slider', 'kindori'),
            'slug'               => 'revslider',
            'source'             => esc_url('https://cmssuperheroes.com/plugins/revslider.zip'),
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Timetable', 'kindori'),
            'slug'               => 'timetable',
            'source'             => esc_url('https://cmssuperheroes.com/plugins/timetable.zip'),
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Contact Form 7', 'kindori'),
            'slug'               => 'contact-form-7',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Newsletter', 'kindori'),
            'slug'               => 'newsletter',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('WooCommerce', 'kindori'),
            'slug'               => "woocommerce",
            'required'           => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
    */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.

    );

    tgmpa( $plugins, $config );

}