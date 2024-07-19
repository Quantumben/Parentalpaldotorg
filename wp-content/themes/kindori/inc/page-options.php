<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  CMS_Post_Metabox $metabox
 */
function kindori_get_nav_menu(){

    $menus = array(
        '' => esc_html__('Default', 'kindori')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }
    return $menus;
}
add_action( 'cms_post_metabox_register', 'kindori_page_options_register' );

function kindori_page_options_register( $metabox ) {

	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'kindori' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'product' ) ) {
		$metabox->set_args( 'product', array(
			'opt_name'            => 'product_option',
			'display_name'        => esc_html__( 'Product Settings', 'kindori' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => kindori_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'kindori' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_audio' ) ) {
		$metabox->set_args( 'cms_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'kindori' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_link' ) ) {
		$metabox->set_args( 'cms_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'kindori' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_quote' ) ) {
		$metabox->set_args( 'cms_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'kindori' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_video' ) ) {
		$metabox->set_args( 'cms_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'kindori' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_gallery' ) ) {
		$metabox->set_args( 'cms_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'kindori' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/* Extra Post Type */

	if ( ! $metabox->isset_args( 'portfolio' ) ) {
		$metabox->set_args( 'portfolio', array(
			'opt_name'            => 'portfolio_option',
			'display_name'        => esc_html__( 'Portfolio Study Settings', 'kindori' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'classes' ) ) {
		$metabox->set_args( 'classes', array(
			'opt_name'            => 'classes_option',
			'display_name'        => esc_html__( 'Classes Settings', 'kindori' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cmsevents' ) ) {
		$metabox->set_args( 'cmsevents', array(
			'opt_name'            => 'cmsevents_option',
			'display_name'        => esc_html__( 'Events Settings', 'kindori' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/**
	 * Config post meta options
	 *
	 */
	$metabox->add_section( 'post', array(
		'title'  => esc_html__( 'Post Settings', 'kindori' ),
		'icon'   => 'el el-refresh',
		'fields' => array(
	        array(
	            'id'      => 'custom_header_seciton',
	            'title'   => esc_html__('Seciton Header', 'kindori'),
	            'type'    => 'section',
	            'indent'  => true
	        ),
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'kindori' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'kindori' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
					'4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
					'5' => get_template_directory_uri() . '/assets/images/header-layout/h5.jpg',
				),
				'default'      => kindori_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
			),
	        array(
	            'id'      => 'custom_pagetitle_ss',
	            'title'   => esc_html__('Page Title', 'kindori'),
	            'type'    => 'section',
	            'indent'  => true
	        ),
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'kindori' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'kindori' ),
					'show'  => esc_html__( 'Custom', 'kindori' ),
					'hide'  => esc_html__( 'Hide', 'kindori' ),
				),
				'default'      => 'themeoption',
			),

			array(
	            'id'       => 'ptitle_layout',
	            'type'     => 'image_select',
	            'title'    => esc_html__('Layout', 'kindori'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'kindori'),
	            'options'  => array(
	                '' => get_template_directory_uri() . '/assets/images/ptitle-layout/p0.jpg',
	                '1' => get_template_directory_uri() . '/assets/images/ptitle-layout/p1.jpg',
	            ),
	            'default'  => '',
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
	        array(
	            'id'      => 'post_content_padding_ss',
	            'title'   => esc_html__('Content', 'kindori'),
	            'type'    => 'section',
	            'indent'  => true
	        ),
			array(
				'id'             => 'post_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-post #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'kindori' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'kindori' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'kindori' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
	        array(
	            'id'      => 'show_sidebar_post_ss',
	            'title'   => esc_html__('Custom Sidebar', 'kindori'),
	            'type'    => 'section',
	            'indent'  => true
	        ),
			array(
				'id'      => 'show_sidebar_post',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Sidebar', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_post_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'kindori' ),
				'options'      => array(
					'left'  => esc_html__('Left', 'kindori'),
	                'right' => esc_html__('Right', 'kindori'),
	                'none'  => esc_html__('Disabled', 'kindori')
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_post', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );
	/**
	 * Config page meta options
	 *
	 */
	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Header', 'kindori' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'kindori' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'kindori' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'kindori' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
				),
				'default'      => kindori_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),

            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => esc_html__('Logo', 'kindori'),
            ),

            array(
                'id'       => 'logo_light',
                'type'     => 'media',
                'title'    => esc_html__('Logo Light', 'kindori'),
                'desc'           => esc_html__('Apply for Header Transparent', 'kindori'),
            ),
            array(
                'id'       => 'logo_mobile',
                'type'     => 'media',
                'title'    => esc_html__('Logo Mobile & Tablet', 'kindori'),
            ),
            array(
                'id' => 'page_one_page',
                'type' => 'switch',
                'title' => esc_html__('One Page', 'kindori'),
                'subtitle' => esc_html__('Enable one page mode for current page.', 'kindori'),
                'default' => false,
            ),
            array(
                'id'       => 'header_menu',
                'type'     => 'select',
                'title'    => esc_html__( 'Select Menu', 'kindori' ),
                'subtitle' => esc_html__( 'custom menu for current page', 'kindori' ),
                'options'  => kindori_get_nav_menu(),
                'default' => '',
                'required'     => array( 0 => 'page_one_page', 1 => 'equals', 2 => '1' ),
                'force_output' => true
            ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Page Title', 'kindori' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'kindori' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'kindori' ),
					'show'  => esc_html__( 'Custom', 'kindori' ),
					'hide'  => esc_html__( 'Hide', 'kindori' ),
				),
				'default'      => 'themeoption',
			),

			array(
	            'id'       => 'ptitle_layout',
	            'type'     => 'image_select',
	            'title'    => esc_html__('Layout', 'kindori'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'kindori'),
	            'options'  => array(
	                '' => get_template_directory_uri() . '/assets/images/ptitle-layout/p0.jpg',
	                '1' => get_template_directory_uri() . '/assets/images/ptitle-layout/p1.jpg',
	            ),
	            'default'  => '',
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),

			array(
				'id'           => 'custom_title',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Title', 'kindori' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
				'id'           => 'title_font_size',
				'type'         => 'text',
				'title'        => esc_html__( 'Title Font Size', 'kindori' ),
				'subtitle'     => esc_html__('Enter number.', 'kindori'),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
	        array(
	            'id'           => 'title_line_hegiht',
	            'type'         => 'text',
	            'title'        => esc_html__('Line Height', 'kindori'),
	            'validate'     => 'numeric',
	            'desc'         => esc_html__('Enter number','kindori'),
	            'msg'          => esc_html__('Please enter number','kindori'),
	            'default'      => ''
	        ),
			array(
				'id'           => 'sub_title',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Sub Title', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
				'id'           => 'sub_title_position',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sub Title Position', 'kindori' ),
				'options'      => array(
					'top-title'  => esc_html__( 'Top Title', 'kindori' ),
					'bottom-title'  => esc_html__( 'Bottom Title', 'kindori' ),
				),
				'default'      => 'bottom-title',
				'required'     => array( 0 => 'ptitle_layout', 1 => '=', 2 => '2' ),
				'force_output' => true
			),
			array(
	            'id'       => 'ptitle_bg',
	            'type'     => 'background',
	            'background-color'     => false,
	            'background-repeat'     => false,
	            'background-size'     => false,
	            'background-attachment'     => false,
	            'background-position'     => false,
	            'title'    => esc_html__('Background', 'kindori'),
	            'subtitle' => esc_html__('Page title background image.', 'kindori'),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
	        array(
	            'id'             => 'ptitle_padding',
	            'type'           => 'spacing',
	            'output'         => array('.site #pagetitle.page-title'),
	            'right'   => false,
	            'left'    => false,
	            'mode'           => 'padding',
	            'units'          => array('px'),
	            'units_extended' => 'false',
	            'title'          => esc_html__('Page Title Padding', 'kindori'),
	            'desc'           => esc_html__('Default: Top-406px, Bottom-86px', 'kindori'),
	            'default'            => array(
	                'padding-top'   => '',
	                'padding-bottom'   => '',
	                'units'          => 'px',
	            ),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Content', 'kindori' ),
		'desc'   => esc_html__( 'Settings for content area.', 'kindori' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'kindori' ),
				'subtitle' => esc_html__( 'Content background color.', 'kindori' ),
				'output'   => array( 'background-color' => 'body' )
			),
			array(
				'id'             => 'content_padding',
				'type'           => 'spacing',
				'output'         => array( '#content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'kindori' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'kindori' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_page',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Sidebar', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_page_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'kindori' ),
				'options'      => array(
					'left'  => esc_html__( 'Left', 'kindori' ),
					'right' => esc_html__( 'Right', 'kindori' ),
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_page', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );
	$metabox->add_section( 'page', array(
	    'title'  => esc_html__('Footer', 'kindori'),
	    'icon'   => 'el el-website',
	    'fields' => array(
            array(
                'id'       => 'custom_footer',
                'type'     => 'switch',
                'title'    => esc_html__('Custom Footer', 'kindori'),
                'default'  => false,
                'indent' => true
            ),
	        array(
	            'id'          => 'footer_layout_custom',
	            'type'        => 'select',
	            'title'       => esc_html__('Layout', 'kindori'),
	            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','kindori'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
	            'options'     => kindori_list_post('footer'),
	            'default'     => '',
	            'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
	            'force_output' => true,
	        ),
	    )
	));

	$metabox->add_section( 'product', array(
		'title'  => esc_html__( 'Header', 'kindori' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'kindori' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'kindori' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'kindori' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
				),
				'default'      => kindori_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
		)
	) );


	/**
	 * Config post format meta options
	 *
	 */

	$metabox->add_section( 'cms_pf_video', array(
		'title'  => esc_html__( 'Video', 'kindori' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'kindori' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'kindori' )
			),

			array(
				'id'    => 'post-video-file',
				'type'  => 'editor',
				'title' => esc_html__( 'Video Upload', 'kindori' ),
				'desc'  => esc_html__( 'Upload video file', 'kindori' )
			),

			array(
				'id'    => 'post-video-html',
				'type'  => 'textarea',
				'title' => esc_html__( 'Embadded video', 'kindori' ),
				'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'kindori' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'kindori' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lightbox?', 'kindori' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'kindori' ),
				'default'  => true
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'kindori' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'kindori' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'kindori' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Audio URL', 'kindori' ),
				'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'kindori' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_link', array(
		'title'  => esc_html__( 'Link', 'kindori' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'kindori' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_quote', array(
		'title'  => esc_html__( 'Quote', 'kindori' ),
		'fields' => array(
			array(
				'id'    => 'post-quote-cite',
				'type'  => 'text',
				'title' => esc_html__( 'Cite', 'kindori' )
			)
		)
	) );

	/**
	 * Config classes meta options
	 *
	 */
	$metabox->add_section( 'classes', array(
		'title'  => esc_html__( 'General', 'kindori' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'kindori' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'kindori' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
				),
				'default'      => kindori_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
		)
	) );
	$metabox->add_section( 'classes', array(
		'title'  => esc_html__( 'Classes Meta', 'kindori' ),
		'icon'   => 'el el-align-left',
		'fields' => array(
			array(
				'id'       => 'classes_price',
				'type'     => 'text',
				'title'    => esc_html__( 'Price', 'kindori' ),
			),
			array(
				'id'       => 'classes_student',
				'type'     => 'text',
				'title'    => esc_html__( 'Student', 'kindori' ),
			),
			array(
				'id'       => 'classes_lectures',
				'type'     => 'text',
				'title'    => esc_html__( 'Lectures', 'kindori' ),
			),
			array(
				'id'       => 'classes_Time',
				'type'     => 'text',
				'title'    => esc_html__( 'Time', 'kindori' ),
			),
			array(
				'id'       => 'classes_learn_day',
				'type'     => 'text',
				'title'    => esc_html__( 'Learn day', 'kindori' ),
			),
			array(
				'id'       => 'classes_language',
				'type'     => 'text',
				'title'    => esc_html__( 'Language', 'kindori' ),
				'desc'           => esc_html__('Enter Language', 'kindori'),
			),
			array(
				'id'       => 'classes_size',
				'type'     => 'text',
				'title'    => esc_html__( 'Size', 'kindori' ),
			),
			array(
				'id'       => 'classes_age',
				'type'     => 'text',
				'title'    => esc_html__( 'Age', 'kindori' ),
			),
		)
	) );
	$metabox->add_section( 'classes', array(
		'title'  => esc_html__( 'Page Title', 'kindori' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'kindori' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'kindori' ),
					'show'  => esc_html__( 'Custom', 'kindori' ),
					'hide'  => esc_html__( 'Hide', 'kindori' ),
				),
				'default'      => 'hide',
			),

			array(
	            'id'       => 'ptitle_layout',
	            'type'     => 'image_select',
	            'title'    => esc_html__('Layout', 'kindori'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'kindori'),
	            'options'  => array(
	                '' => get_template_directory_uri() . '/assets/images/ptitle-layout/p0.jpg',
	                '1' => get_template_directory_uri() . '/assets/images/ptitle-layout/p1.jpg',
	            ),
	            'default'  => '',
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),

			array(
				'id'           => 'custom_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Title', 'kindori' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
				'id'           => 'sub_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Sub Title', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_description',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Description', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
	            'id'       => 'ptitle_bg',
	            'type'     => 'background',
	            'background-color'     => false,
	            'background-repeat'     => false,
	            'background-size'     => false,
	            'background-attachment'     => false,
	            'background-position'     => false,
	            'title'    => esc_html__('Background', 'kindori'),
	            'subtitle' => esc_html__('Page title background image.', 'kindori'),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
	        array(
	            'id'             => 'ptitle_padding',
	            'type'           => 'spacing',
	            'output'         => array('.site #pagetitle.page-title'),
	            'right'   => false,
	            'left'    => false,
	            'mode'           => 'padding',
	            'units'          => array('px'),
	            'units_extended' => 'false',
	            'title'          => esc_html__('Page Title Padding', 'kindori'),
	            'desc'           => esc_html__('Default: Top-406px, Bottom-86px', 'kindori'),
	            'default'            => array(
	                'padding-top'   => '',
	                'padding-bottom'   => '',
	                'units'          => 'px',
	            ),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
		)
	) );
	$metabox->add_section( 'classes', array(
		'title'  => esc_html__( 'Content', 'kindori' ),
		'desc'   => esc_html__( 'Settings for content area.', 'kindori' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'kindori' ),
				'subtitle' => esc_html__( 'Content background color.', 'kindori' ),
				'output'   => array( 'background-color' => 'body' )
			),
			array(
				'id'             => 'portfolio_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-classes #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'kindori' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'kindori' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'kindori' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );
	$metabox->add_section( 'classes', array(
		'title'  => esc_html__( 'Footer', 'kindori' ),
		'desc'   => esc_html__( 'Settings for footer area.', 'kindori' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'      => 'custom_footer',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Layout', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
	        array(
	            'id'          => 'footer_layout_custom',
	            'type'        => 'select',
	            'title'       => esc_html__('Footer Top Content Extra', 'kindori'),
	            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','kindori'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
	            'options'     => kindori_list_post('footer'),
	            'default'     => '',
	            'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
	            'force_output' => true
	        ),
	    )
	) );
	/**
	 * Config Events meta options
	 *
	 */
	$metabox->add_section( 'cmsevents', array(
		'title'  => esc_html__( 'General', 'kindori' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'kindori' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'kindori' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
				),
				'default'      => kindori_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
		)
	) );
	$metabox->add_section( 'cmsevents', array(
		'title'  => esc_html__( 'Events Meta', 'kindori' ),
		'icon'   => 'el el-align-left',
		'fields' => array(
			array(
				'id'       => 'cmsevents_price',
				'type'     => 'text',
				'title'    => esc_html__( 'Price', 'kindori' ),
			),
			array(
				'id'       => 'cmsevents_orgainzer',
				'type'     => 'text',
				'title'    => esc_html__( 'Organizer Name', 'kindori' ),
			),
			array(
				'id'       => 'cmsevents_phone',
				'type'     => 'text',
				'title'    => esc_html__( 'Phone', 'kindori' ),
			),
			array(
				'id'       => 'cmsevents_mail',
				'type'     => 'text',
				'title'    => esc_html__( 'Mail', 'kindori' ),
			),
			array(
				'id'       => 'cmsevents_startday',
				'type'     => 'text',
				'title'    => esc_html__( 'Start day', 'kindori' ),
			),
			array(
				'id'       => 'cmsevents_endtday',
				'type'     => 'text',
				'title'    => esc_html__( 'End day', 'kindori' ),
			),
            // array(
            //     'id'       => 'datetime',
            //     'type'     => 'cms_datetime',
            //     'title'    => esc_html__('Date/Time', 'kindori'),
            // ),
			array(
				'id'       => 'cmsevents_time',
				'type'     => 'text',
				'title'    => esc_html__( 'Time', 'kindori' ),
				'desc'           => esc_html__('Enter Time', 'kindori'),
			),
			array(
				'id'       => 'cmsevents_place',
				'type'     => 'text',
				'title'    => esc_html__( 'Place', 'kindori' ),
			),
			array(
				'id'       => 'cmsevents_location',
				'type'     => 'text',
				'title'    => esc_html__( 'Location', 'kindori' ),
			),
		)
	) );
	$metabox->add_section( 'cmsevents', array(
		'title'  => esc_html__( 'Page Title', 'kindori' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'kindori' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'kindori' ),
					'show'  => esc_html__( 'Custom', 'kindori' ),
					'hide'  => esc_html__( 'Hide', 'kindori' ),
				),
				'default'      => 'hide',
			),

			array(
	            'id'       => 'ptitle_layout',
	            'type'     => 'image_select',
	            'title'    => esc_html__('Layout', 'kindori'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'kindori'),
	            'options'  => array(
	                '' => get_template_directory_uri() . '/assets/images/ptitle-layout/p0.jpg',
	                '1' => get_template_directory_uri() . '/assets/images/ptitle-layout/p1.jpg',
	            ),
	            'default'  => '',
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),

			array(
				'id'           => 'custom_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Title', 'kindori' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
				'id'           => 'sub_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Sub Title', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_description',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Description', 'kindori' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
	            'id'       => 'ptitle_bg',
	            'type'     => 'background',
	            'background-color'     => false,
	            'background-repeat'     => false,
	            'background-size'     => false,
	            'background-attachment'     => false,
	            'background-position'     => false,
	            'title'    => esc_html__('Background', 'kindori'),
	            'subtitle' => esc_html__('Page title background image.', 'kindori'),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
	        array(
	            'id'             => 'ptitle_padding',
	            'type'           => 'spacing',
	            'output'         => array('.site #pagetitle.page-title'),
	            'right'   => false,
	            'left'    => false,
	            'mode'           => 'padding',
	            'units'          => array('px'),
	            'units_extended' => 'false',
	            'title'          => esc_html__('Page Title Padding', 'kindori'),
	            'desc'           => esc_html__('Default: Top-406px, Bottom-86px', 'kindori'),
	            'default'            => array(
	                'padding-top'   => '',
	                'padding-bottom'   => '',
	                'units'          => 'px',
	            ),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
		)
	) );
	$metabox->add_section( 'cmsevents', array(
		'title'  => esc_html__( 'Content', 'kindori' ),
		'desc'   => esc_html__( 'Settings for content area.', 'kindori' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'kindori' ),
				'subtitle' => esc_html__( 'Content background color.', 'kindori' ),
				'output'   => array( 'background-color' => 'body' )
			),
			array(
				'id'             => 'portfolio_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-cmsevents #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'kindori' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'kindori' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'kindori' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );
	$metabox->add_section( 'cmsevents', array(
		'title'  => esc_html__( 'Footer', 'kindori' ),
		'desc'   => esc_html__( 'Settings for footer area.', 'kindori' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'      => 'custom_footer',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Layout', 'kindori' ),
				'default' => false,
				'indent'  => true
			),
	        array(
	            'id'          => 'footer_layout_custom',
	            'type'        => 'select',
	            'title'       => esc_html__('Footer Top Content Extra', 'kindori'),
	            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','kindori'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
	            'options'     => kindori_list_post('footer'),
	            'default'     => '',
	            'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
	            'force_output' => true
	        ),
	    )
	) );
}
function kindori_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( kindori_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}