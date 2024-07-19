<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}

if(class_exists('Newsletter')) {
    $forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $newsletter_forms = array(
        'default' => esc_html__( 'Default Form', 'kindori' )
    );

    if ( $forms )
    {
        $index = 1;
        foreach ( $forms as $key => $form )
        {
            $newsletter_forms[ $key ] = sprintf( esc_html__( 'Form %s', 'kindori' ), $index );
            $index ++;
        }
    }
} else {
    $newsletter_forms = '';
}

$opt_name = kindori_get_opt_name();
$theme = wp_get_theme();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('Elementor_Theme_Core') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'kindori'),
    'page_title'           => esc_html__('Theme Options', 'kindori'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('Elementor_Theme_Core') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
    'templates_path'       => get_template_directory() . '/inc/templates/redux/'
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'kindori'),
    'icon'   => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => esc_html__('Favicon', 'kindori'),
            'default' => ''
        ),
        array(
            'id'       => 'show_page_loading',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Page Loading', 'kindori'),
            'subtitle' => esc_html__('Enable page loading effect when you load site.', 'kindori'),
            'default'  => false
        ),
        array(
            'id'       => 'smoothscroll',
            'type'     => 'switch',
            'title'    => esc_html__('Smooth Scroll', 'kindori'),
            'default'  => false
        ),
        array(
            'id'       => 'dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'kindori'),
            'description' => 'no minimize , generate css over time...',
            'default'  => false
        ),
    )
));

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'kindori'),
    'icon'   => 'el-icon-website',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'kindori'),
            'subtitle' => esc_html__('Select a layout for header.', 'kindori'),
            'options'  => array(
                '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'sticky_on',
            'type'     => 'switch',
            'title'    => esc_html__('Sticky Header', 'kindori'),
            'subtitle' => esc_html__('Header will be sticked when applicable.', 'kindori'),
            'default'  => false
        ),
        array(
            'id'       => 'search_on',
            'type'     => 'switch',
            'title'    => esc_html__('Search Icon', 'kindori'),
            'default'  => false
        ),
        array(
            'id'       => 'social_share_on',
            'title'    => esc_html__('Socials Share', 'kindori'),
            'subtitle' => esc_html__('Show socials share on Header.', 'kindori'),
            'type'     => 'switch',
            'default'  => false
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Top Bar', 'kindori'),
    'icon'       => 'el el-website',
    'subsection' => true,
    'fields'     => array(
        //Phone
        array(
            'id' => 't_setion_phone',
            'type'  => 'section',
            'title' => esc_html__('Phone Section', 'kindori'),
            'indent' => true
        ),
        array(
            'id' => 'top_bar_phone',
            'type' => 'text',
            'title' => esc_html__('Phone Number', 'kindori'),
            'default' => '',
        ),
        array(
            'id' => 'top_bar_phone_link',
            'type' => 'text',
            'title' => esc_html__('Phone Link', 'kindori'),
            'default' => '#',
        ),
        //Time work
        array(
            'id' => 't_setion_address',
            'type'  => 'section',
            'indent' => true,
            'title' => esc_html__('Address Section', 'kindori'),
        ),

        array(
            'id' => 'top_bar_adress',
            'type' => 'text',
            'title' => esc_html__('Address', 'kindori'),
            'default' => '',
        ),
        //Time work
        array(
            'id' => 't_setion_worktime',
            'type'  => 'section',
            'indent' => true,
            'title' => esc_html__('Work Time', 'kindori'),
        ),

        array(
            'id' => 'top_bar_worktime',
            'type' => 'text',
            'title' => esc_html__('Open Time', 'kindori'),
            'default' => '',
        ),
        array(
            'id'       => 'social_share_on',
            'title'    => esc_html__('Socials Share', 'kindori'),
            'subtitle' => esc_html__('Show socials share on Header.', 'kindori'),
            'type'     => 'switch',
            'default'  => false
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Logo', 'kindori'),
    'icon'       => 'el el-picture',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'logo_light',
            'type'     => 'media',
            'title'    => esc_html__('Logo Light', 'kindori'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-light.png'
            )
        ),
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'title'    => esc_html__('Logo Dark', 'kindori'),
             'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_mobile',
            'type'     => 'media',
            'title'    => esc_html__('Logo Tablet & Mobile', 'kindori'),
             'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_maxh',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max height', 'kindori'),
            'subtitle' => esc_html__('Enter number.', 'kindori'),
            'width'    => false,
            'unit'     => 'px'
        ),
        array(
            'id'       => 'logo_maxh_sm',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max height Tablet & Mobile', 'kindori'),
            'subtitle' => esc_html__('Enter number.', 'kindori'),
            'width'    => false,
            'unit'     => 'px'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Navigation', 'kindori'),
    'icon'       => 'el el-lines',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'font_menu',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Google Font', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'font-style'  => false,
            'font-weight'  => true,
            'text-align'  => false,
            'font-size'  => false,
            'line-height'  => false,
            'color'  => false,
            'output'      => array('.primary-menu > li > a, body .primary-menu .sub-menu li a'),
            'units'       => 'px',
        ),
        array(
            'id'       => 'menu_font_size',
            'type'     => 'text',
            'title'    => esc_html__('Font Size', 'kindori'),
            'validate' => 'numeric',
            'desc'     => 'Enter number',
            'msg'      => 'Please enter number',
            'default'  => ''
        ),
        array(
            'id'       => 'menu_text_transform',
            'type'     => 'select',
            'title'    => esc_html__('Text Transform', 'kindori'),
            'options'  => array(
                '' => esc_html__('Uppercase', 'kindori'),
                'capitalize'  => esc_html__('Capitalize', 'kindori'),
                'lowercase'  => esc_html__('Lowercase', 'kindori'),
                'initial'  => esc_html__('Initial', 'kindori'),
                'inherit'  => esc_html__('Inherit', 'kindori'),
                'none'  => esc_html__('None', 'kindori'),
            ),
            'default'  => ''
        ),
        array(
            'title' => esc_html__('Main Menu', 'kindori'),
            'type'  => 'section',
            'id' => 'main_menu',
            'indent' => true
        ),
        array(
            'id'      => 'main_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Color', 'kindori'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'title' => esc_html__('Sticky Menu', 'kindori'),
            'type'  => 'section',
            'id' => 'sticky_menu',
            'indent' => true
        ),
        array(
            'id'      => 'sticky_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Color', 'kindori'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'title' => esc_html__('Button Navigation', 'kindori'),
            'type'  => 'section',
            'id' => 'button_navigation',
            'indent' => true
        ),
        array(
            'id'       => 'h_btn_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Show/Hide Button', 'kindori'),
            'options'  => array(
                'show'  => esc_html__('Show', 'kindori'),
                'hide'  => esc_html__('Hide', 'kindori')
            ),
            'default'  => 'hide',
        ),
        array(
            'id' => 'h_btn_text',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'kindori'),
            'default' => '',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_link_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Link Type', 'kindori'),
            'options'  => array(
                'page'  => esc_html__('Page', 'kindori'),
                'custom'  => esc_html__('Custom', 'kindori')
            ),
            'default'  => 'page',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'    => 'h_btn_link',
            'type'  => 'select',
            'title' => esc_html__( 'Page Link', 'kindori' ), 
            'data'  => 'page',
            'args'  => array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ),
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'page' ),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_link_custom',
            'type' => 'text',
            'title' => esc_html__('Custom Link', 'kindori'),
            'default' => '',
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_target',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Target', 'kindori'),
            'options'  => array(
                '_self'  => esc_html__('Self', 'kindori'),
                '_blank'  => esc_html__('Blank', 'kindori')
            ),
            'default'  => '_self',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'kindori'),
    'icon'   => 'el-icon-map-marker',
    'fields' => array(

        array(
            'id'           => 'pagetitle',
            'type'         => 'button_set',
            'title'        => esc_html__( 'Page Title', 'kindori' ),
            'options'      => array(
                'show'  => esc_html__( 'Show', 'kindori' ),
                'hide'  => esc_html__( 'Hide', 'kindori' ),
            ),
            'default'      => 'show',
        ),

        array(
            'id'       => 'ptitle_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'kindori'),
            'subtitle' => esc_html__('Select a layout for page title.', 'kindori'),
            'options'  => array(
                '1' => get_template_directory_uri() . '/assets/images/ptitle-layout/p1.jpg',
            ),
            'default'  => '1',
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),

        array(
            'id'       => 'ptitle_bg',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'kindori'),
            'subtitle' => esc_html__('Page title background.', 'kindori'),
            'output'   => array('body #pagetitle'),
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'pagetitle_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Background Color Overlay', 'kindori'),
            'output' => array('background-color' => 'body #pagetitle.bg-overlay:before'),
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'ptitle_color',
            'type'     => 'color',
            'title'    => esc_html__('Title Color', 'kindori'),
            'subtitle' => esc_html__('Page title color.', 'kindori'),
            'output'   => array('body #pagetitle h1.page-title'),
            'default'  => '',
            'transparent' => false,
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id' => 'title_font_size',
            'type' => 'text',
            'title' => esc_html__('Font Size', 'kindori'),
            'validate' => 'numeric',
            'desc' => esc_html__('Enter number','kindori'),
            'msg' => esc_html__('Please enter number','kindori'),
            'default' => ''
        ),
        array(
            'id' => 'title_line_hegiht',
            'type' => 'text',
            'title' => esc_html__('Line Height', 'kindori'),
            'validate' => 'numeric',
            'desc' => esc_html__('Enter number','kindori'),
            'msg' => esc_html__('Please enter number','kindori'),
            'default' => ''
        ),
        array(
            'id'       => 'ptitle_breadcrumb_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Breadcrumb', 'kindori'),
            'options'  => array(
                'show'  => esc_html__('Show', 'kindori'),
                'hidden'  => esc_html__('Hidden', 'kindori'),
            ),
            'default'  => 'show',
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'kindori'),
    'icon'  => 'el-icon-pencil',
    'fields'     => array(
        array(
            'id'       => 'content_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Background Color', 'kindori'),
            'subtitle' => esc_html__('Content background color.', 'kindori'),
            'output' => array('background-color' => 'body')
        ),
        array(
            'id'             => 'content_padding',
            'type'           => 'spacing',
            'output'         => array('#content'),
            'right'   => false,
            'left'    => false,
            'mode'           => 'padding',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => esc_html__('Content Padding', 'kindori'),
            'desc'           => esc_html__('Default: Top-90px, Bottom-90px', 'kindori'),
            'default'            => array(
                'padding-top'   => '',
                'padding-bottom'   => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'search_field_placeholder',
            'type'    => 'text',
            'title'   => esc_html__('Search Form - Text Placeholder', 'kindori'),
            'default' => '',
            'desc'           => esc_html__('Default: Search Keywords...', 'kindori'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'kindori'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'archive_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'kindori'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'kindori'),
            'options'  => array(
                'left'  => esc_html__('Left', 'kindori'),
                'right' => esc_html__('Right', 'kindori'),
                'none'  => esc_html__('Disabled', 'kindori')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'kindori'),
            'subtitle' => esc_html__('Show author name on each post.', 'kindori'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'kindori'),
            'subtitle' => esc_html__('Show date posted on each post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'kindori'),
            'subtitle' => esc_html__('Show category names on each post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'kindori'),
            'subtitle' => esc_html__('Show comments count on each post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true,
        ),
    )
));
// Single Post
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'kindori'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'post_bg_color',
            'type'        => 'color',
            'title'       => esc_html__('Content Background Color', 'kindori'),
            'transparent' => false,
            'default'     => '',
            'required' => array( 0 => 'single_post_layout', 1 => 'equals', 2 => 'real-estate' ),
            'force_output' => true
        ),
        array(
            'id'       => 'post_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'kindori'),
            'subtitle' => esc_html__('Select a sidebar position', 'kindori'),
            'options'  => array(
                'left'  => esc_html__('Left', 'kindori'),
                'right' => esc_html__('Right', 'kindori'),
                'none'  => esc_html__('Disabled', 'kindori')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'post_author_on',
            'title'    => esc_html__('Author', 'kindori'),
            'subtitle' => esc_html__('Show author name on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_author_info_on',
            'title'    => esc_html__('Author Info', 'kindori'),
            'subtitle' => esc_html__('Show author info name on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => false
        ),
        array(
            'id'       => 'post_date_on',
            'title'    => esc_html__('Date', 'kindori'),
            'subtitle' => esc_html__('Show date on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_categories_on',
            'title'    => esc_html__('Categories', 'kindori'),
            'subtitle' => esc_html__('Show category names on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_tags_on',
            'title'    => esc_html__('Tags', 'kindori'),
            'subtitle' => esc_html__('Show tag names on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_social_share_on',
            'title'    => esc_html__('Social Share', 'kindori'),
            'subtitle' => esc_html__('Show social share on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'post_comments_on',
            'title'    => esc_html__('Comments', 'kindori'),
            'subtitle' => esc_html__('Show comments count on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => false
        ),
        array(
            'id'       => 'post_navigation_on',
            'title'    => esc_html__('Navigation', 'kindori'),
            'subtitle' => esc_html__('Show navigation on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'post_comments_form_on',
            'title'    => esc_html__('Comments Form', 'kindori'),
            'subtitle' => esc_html__('Show comments form on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_feature_image_on',
            'title'    => esc_html__('Feature Image', 'kindori'),
            'subtitle' => esc_html__('Show feature image on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_related_on',
            'title'    => esc_html__('Post Related', 'kindori'),
            'subtitle' => esc_html__('Show Post Related on single post.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),
    )
));
//Single Portfolio
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Classes Studies', 'kindori'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'classes_tag_on',
            'title'    => esc_html__('Tag', 'kindori'),
            'subtitle' => esc_html__('Show Classes Single Tag botton single Classes Single.', 'kindori'),
            'type'     => 'switch',
            'default'  => true
        ),

        array(
            'id'       => 'classes_social_on',
            'title'    => esc_html__('Social Connect', 'kindori'),
            'subtitle' => esc_html__('Show social connect on Single Classes Single.', 'kindori'),
            'type'     => 'switch',
            'default'  => true,
            'force_output' => true
        ),
        array(
            'id'       => 'classes_navigation_on',
            'title'    => esc_html__('Navigation', 'kindori'),
            'subtitle' => esc_html__('Show navigation on single Classes Single.', 'kindori'),
            'type'     => 'switch',
            'default'  => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Footer', 'kindori'),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'          => 'footer_layout_custom',
            'type'        => 'select',
            'title'       => esc_html__('Footer Custom Extra', 'kindori'),
            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','kindori'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
            'options'     => kindori_list_post('footer'),
            'default'     => '',
        ),
        array(
            'id'       => 'back_totop_on',
            'type'     => 'switch',
            'title'    => esc_html__('Back to Top Button', 'kindori'),
            'subtitle' => esc_html__('Show back to top button when scrolled down.', 'kindori'),
            'default'  => true,
        ),
    )
));
/*--------------------------------------------------------------
# Shop
--------------------------------------------------------------*/
if(class_exists('Woocommerce')) {
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Shop', 'kindori'),
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
            array(
                'id'       => 'sidebar_shop',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Position', 'kindori'),
                'subtitle' => esc_html__('Select a sidebar position for archive shop.', 'kindori'),
                'options'  => array(
                    'left'  => esc_html__('Left', 'kindori'),
                    'right' => esc_html__('Right', 'kindori'),
                    'none'  => esc_html__('Disabled', 'kindori')
                ),
                'default'  => 'right'
            ),
            array(
                'title' => esc_html__('Products displayed per page', 'kindori'),
                'id' => 'product_per_page',
                'type' => 'slider',
                'subtitle' => esc_html__('Number product to show', 'kindori'),
                'default' => 8,
                'min'  => 4,
                'step' => 1,
                'max' => 50,
                'display_value' => 'text'
            ),
        )
    ));
}
/* Social Media */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Social Media', 'kindori'),
    'icon' => 'el el-twitter',
    'subsection' => false,
    'fields' => array(
        array(
            'id' => 'social_media',
            'type' => 'sorter',
            'title' => 'Enable and Sort',
            'desc' => 'Choose which social networks are displayed and edit where they link to.',
            'options' => array(
                'enabled' => array(
                    'instagram' => 'Instagram',
                    'twitter' => 'Twitter',
                ),
                'disabled' => array(
                    'facebook' => 'Facebook',
                    'tripadvisor' => 'Tripadvisor',
                    'google' => 'Google',
                    'youtube' => 'Youtube',
                    'vimeo' => 'Vimeo',
                    'tumblr' => 'Tumblr',
                    'pinterest' => 'Pinterest',
                    'yelp' => 'Yelp',
                    'skype' => 'Skype',
                    'linkedin' => 'Linkedin',
                    'rss' => 'Rss',
                )
            ),
        ),
        array(
            'id'      => 'social_facebook_url',
            'type'    => 'text',
            'title'   => esc_html__('Facebook URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_twitter_url',
            'type'    => 'text',
            'title'   => esc_html__('Twitter URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_inkedin_url',
            'type'    => 'text',
            'title'   => esc_html__('Inkedin URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_rss_url',
            'type'    => 'text',
            'title'   => esc_html__('Rss URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_instagram_url',
            'type'    => 'text',
            'title'   => esc_html__('Instagram URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_google_url',
            'type'    => 'text',
            'title'   => esc_html__('Google URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_skype_url',
            'type'    => 'text',
            'title'   => esc_html__('Skype URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_pinterest_url',
            'type'    => 'text',
            'title'   => esc_html__('Pinterest URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_vimeo_url',
            'type'    => 'text',
            'title'   => esc_html__('Vimeo URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_youtube_url',
            'type'    => 'text',
            'title'   => esc_html__('Youtube URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_yelp_url',
            'type'    => 'text',
            'title'   => esc_html__('Yelp URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tumblr_url',
            'type'    => 'text',
            'title'   => esc_html__('Tumblr URL', 'kindori'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tripadvisor_url',
            'type'    => 'text',
            'title'   => esc_html__('Tripadvisor URL', 'kindori'),
            'default' => '',
        ),
    )
));
/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'kindori'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'kindori'),
            'transparent' => false,
            'default'     => '#ff4880'
        ),
        array(
            'id'          => 'secondary_color',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color', 'kindori'),
            'transparent' => false,
            'default'     => '#271344'
        ),

        array(
            'id'          => 'third_color',
            'type'        => 'color',
            'title'       => esc_html__('Third Color', 'kindori'),
            'transparent' => false,
            'default'     => '#ffc000'
        ),
        
        array(
            'id'          => 'four_color',
            'type'        => 'color',
            'title'       => esc_html__('Four Color', 'kindori'),
            'transparent' => false,
            'default'     => '#abcd52'
        ),

        array(
            'id'          => 'five_color',
            'type'        => 'color',
            'title'       => esc_html__('Five Color', 'kindori'),
            'transparent' => false,
            'default'     => '#1ab9ff'
        ),

        array(
            'id'          => 'regular_color',
            'type'        => 'color',
            'title'       => esc_html__('Body Color', 'kindori'),
            'transparent' => false,
            'default'     => '#777777'
        ),
        array(
            'id'      => 'link_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Link Colors', 'kindori'),
            'default' => array(
                'regular' => '#ff4880',
                'hover'   => '#ff4880',
                'active'  => '#ff4880'
            ),
            'output'  => array('a')
        )
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
$custom_font_selectors_1 = Redux::getOption($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'kindori'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'       => 'body_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Body Default Font', 'kindori'),
            'options'  => array(
                'Prompt'  => esc_html__('Default', 'kindori'),
                'Google-Font'  => esc_html__('Google Font', 'kindori'),
            ),
            'default'  => 'Prompt',
        ),
        array(
            'id'          => 'font_main',
            'type'        => 'typography',
            'title'       => esc_html__('Body Google Font', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'line-height'  => true,
            'font-size'  => true,
            'text-align'  => false,
            'output'      => array('body'),
            'units'       => 'px',
            'required' => array( 0 => 'body_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'       => 'heading_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Heading Default Font', 'kindori'),
            'options'  => array(
                'Fredoka'  => esc_html__('Default', 'kindori'),
                'Google-Font'  => esc_html__('Google Font', 'kindori'),
            ),
            'default'  => 'Fredoka',
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('H1', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font for all H1 tags of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h1', '.h1', '.text-heading'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('H2', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font for all H2 tags of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h2', '.h2'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('H3', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font for all H3 tags of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h3', '.h3'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('H4', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font for all H4 tags of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h4', '.h4'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('H5', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font for all H5 tags of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h5', '.h5'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('H6', 'kindori'),
            'subtitle'    => esc_html__('This will be the default font for all H6 tags of your website.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h6', '.h6'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Fonts Selectors', 'kindori'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'kindori'),
            'subtitle'    => esc_html__('This will be the font that applies to the class selector.', 'kindori'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',

        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'kindori'),
            'subtitle' => esc_html__('Add class selectors to apply above font.', 'kindori'),
            'validate' => 'no_html'
        )
    )
));

/* Google Maps /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Google Maps', 'kindori'),
    'icon'   => 'el el-map-marker',
    'fields' => array(
        array(
            'id'       => 'gm_api_key',
            'type'     => 'text',
            'title'    => esc_html__('API Key', 'kindori'),
            'default' => 'AIzaSyC08_qdlXXCWiFNVj02d-L2BDK5qr6ZnfM',
            'desc' => esc_html__('Register a Google Maps Api key then put it in here.', 'kindori')
        ),
    ),
));

/* 404 Page /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('404 Page', 'kindori'),
    'icon'   => 'el-cog-alt el',
    'fields' => array(
        array(
            'id'       => 'img_404',
            'type'     => 'media',
            'title'    => esc_html__('Image 404', 'kindori'),
            'subtitle' => esc_html__('Select image for page 404', 'kindori'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/image-404.png'
            )
        ),
        array(
            'id'       => 'title_404',
            'type'     => 'text',
            'title'    => esc_html__('Title 404', 'kindori'),
            'default' => '',
            'desc' => esc_html__('Default: OOPS! Page Not Found!', 'kindori')
        ),
        array(
            'id'       => 'content_404_page',
            'type'     => 'textarea',
            'title'    => esc_html__('Content', 'kindori'),
            'default' => '',
        ),
        array(
            'id'       => 'btn_text_404_page',
            'type'     => 'text',
            'title'    => esc_html__('Button Text', 'kindori'),
            'default' => '',
        ),
        array(
            'id'       => 'bg_404_page',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'kindori'),
            'output'   => array('body.error404 .error-404'),
            'background-color' => false
        ),
    ),
));

/* Custom Code /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom Code', 'kindori'),
    'icon'   => 'el-icon-edit',
    'fields' => array(

        array(
            'id'       => 'site_header_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Header Custom Codes', 'kindori'),
            'subtitle' => esc_html__('It will insert the code to wp_head hook.', 'kindori'),
        ),
        array(
            'id'       => 'site_footer_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Footer Custom Codes', 'kindori'),
            'subtitle' => esc_html__('It will insert the code to wp_footer hook.', 'kindori'),
        ),

    ),
));

/* Custom CSS /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom CSS', 'kindori'),
    'icon'   => 'el-icon-adjust-alt',
    'fields' => array(

        array(
            'id'   => 'customcss',
            'type' => 'info',
            'desc' => esc_html__('Custom CSS', 'kindori')
        ),

        array(
            'id'       => 'site_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'kindori'),
            'subtitle' => esc_html__('Advanced CSS Options. You can paste your custom CSS Code here.', 'kindori'),
            'mode'     => 'css',
            'validate' => 'css',
            'theme'    => 'chrome',
            'default'  => ""
        ),

    ),
));