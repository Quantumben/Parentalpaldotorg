<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
	return;
}

class CSS_Generator {
	/**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	/**
	 * Constructor
	 */
	function __construct() {
		$this->opt_name = kindori_get_opt_name();

		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = kindori_get_opt( 'dev_mode', '0' ) === '1' ? true : false;
		add_filter( 'cms_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
	}

	/**
	 * init hook - 10
	 */
	function init() {
		if ( ! class_exists( 'scssc' ) ) {
			return;
		}

		$this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
			$this->generate_file();
		} );
	}

	function generate_with_dev_mode() {
		if ( $this->dev_mode === true ) {
			$this->generate_file();
		}
	}

	/**
	 * Generate options and css files
	 */
	function generate_file() {
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

		$this->scssc = new scssc();
		$this->scssc->setImportPaths( $scss_dir );

		$_options = $scss_dir . 'variables.scss';

		$this->redux->filesystem->execute( 'put_contents', $_options, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
		) );
		$css_file = $css_dir . 'theme.css';

		$this->scssc->setFormatter( 'scss_formatter' );
		$this->redux->filesystem->execute( 'put_contents', $css_file, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
		) );
	}

	/**
	 * Output options to _variables.scss
	 *
	 * @access protected
	 * @return string
	 */
	protected function options_output() {
		ob_start();

		//Primary Color
		$primary_color = kindori_get_opt( 'primary_color', '#ff4880' );
		if ( ! kindori_is_valid_color( $primary_color ) ) {
			$primary_color = '#ff4880';
		}
		printf( '$primary_color: %s;', esc_attr( $primary_color ) );

		//Secondary Color
		$secondary_color = kindori_get_opt( 'secondary_color', '#271344' );
		if ( ! kindori_is_valid_color( $secondary_color ) ) {
			$secondary_color = '#271344';
		}
		printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );
		
		//Third Color
		$third_color = kindori_get_opt( 'third_color', '#ffc000' );
		if ( ! kindori_is_valid_color( $third_color ) ) {
			$third_color = '#ffc000';
		}
		printf( '$third_color: %s;', esc_attr( $third_color ) );

		//Four Color
		$four_color = kindori_get_opt( 'four_color', '#abcd52' );
		if ( ! kindori_is_valid_color( $four_color ) ) {
			$four_color = '#abcd52';
		}
		printf( '$four_color: %s;', esc_attr( $four_color ) );

		//Five Color
		$five_color = kindori_get_opt( 'five_color', '#1ab9ff' );
		if ( ! kindori_is_valid_color( $five_color ) ) {
			$five_color = '#1ab9ff';
		}
		printf( '$five_color: %s;', esc_attr( $five_color ) );

		//Regular Color
		$regular_color = kindori_get_opt( 'regular_color', '#777777' );
		if ( ! kindori_is_valid_color( $regular_color ) ) {
			$regular_color = '#777777';
		}
		printf( '$regular_color: %s;', esc_attr( $regular_color ) );

		$link_color = kindori_get_opt( 'link_color', '#ff4880' );
		if ( ! empty( $link_color['regular'] ) && isset( $link_color['regular'] ) ) {
			printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
		} else {
			echo '$link_color: #ff4880;';
		}

		$link_color_hover = kindori_get_opt( 'link_color', '#ff4880' );
		if ( ! empty( $link_color['hover'] ) && isset( $link_color['hover'] ) ) {
			printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
		} else {
			echo '$link_color_hover: #ff4880;';
		}

		$link_color_active = kindori_get_opt( 'link_color', '#ff4880' );
		if ( ! empty( $link_color['active'] ) && isset( $link_color['active'] ) ) {
			printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
		} else {
			echo '$link_color_active: #ff4880;';
		}

		/* Font */
		$body_default_font = kindori_get_opt( 'body_default_font', 'Prompt' );
		if ( isset( $body_default_font ) ) {
			echo '
                $body_default_font: ' . esc_attr( $body_default_font ) . ';
            ';
		}

		$heading_default_font = kindori_get_opt( 'heading_default_font', 'Fredoka' );
		if ( isset( $heading_default_font ) ) {
			echo '
                $heading_default_font: ' . esc_attr( $heading_default_font ) . ';
            ';
		}

		return ob_get_clean();
	}

	/**
	 * Hooked wp_enqueue_scripts - 20
	 * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
	 */
	function enqueue() {
		$css = $this->inline_css();
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'kindori-theme', $this->dev_mode ? $css : kindori_css_minifier( $css ) );
		}
	}

	/**
	 * Generate inline css based on theme options
	 */
	protected function inline_css() {
		ob_start();
		/* Logo */
		$logo_maxh = kindori_get_opt( 'logo_maxh' );

		if ( ! empty( $logo_maxh['height'] ) && $logo_maxh['height'] != 'px' ) {
			printf( '#site-header-wrap .site-branding a img { max-height: %s; }', esc_attr( $logo_maxh['height'] ) );
		} ?>

		<?php $logo_maxh_sm = kindori_get_opt( 'logo_maxh_sm' );
		if ( ! empty( $logo_maxh_sm['height'] ) && $logo_maxh_sm['height'] != 'px' ) {
			printf( '@media screen and (max-width: 1199px) { #site-header-wrap .site-branding a img { max-height: %s; } }', esc_attr( $logo_maxh_sm['height'] ) );
		} ?>

		<?php /* Menu */
		$menu_text_transform = kindori_get_opt( 'menu_text_transform' );
		if ( ! empty( $menu_text_transform ) ) {
			printf( '.primary-menu > li > a { text-transform: %s !important; }', esc_attr( $menu_text_transform ) );
		}
		$menu_font_size = kindori_get_opt( 'menu_font_size' );
		if ( ! empty( $menu_font_size ) ) {
			printf( '.primary-menu > li > a { font-size: %s' . 'px !important; }', esc_attr( $menu_font_size ) );
		}
		$main_menu_color = kindori_get_opt( 'main_menu_color' );
		if ( ! empty( $main_menu_color['regular'] ) ) {
			printf( '.primary-menu > li > a { color: %s !important; }', esc_attr( $main_menu_color['regular'] ) );
		}
		if ( ! empty( $main_menu_color['hover'] ) ) {
			printf( '.primary-menu > li > a:hover { color: %s !important; }', esc_attr( $main_menu_color['hover'] ) );
		}
		if ( ! empty( $main_menu_color['active'] ) ) {
			printf( '.primary-menu > li.current_page_item > a, .primary-menu > li.current-menu-item > a, .primary-menu > li.current_page_ancestor > a, .primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $main_menu_color['active'] ) );
		}
		$sticky_menu_color = kindori_get_opt( 'sticky_menu_color' );
		if ( ! empty( $sticky_menu_color['regular'] ) ) {
			printf( '#site-header.h-fixed .primary-menu > li > a { color: %s !important; }', esc_attr( $sticky_menu_color['regular'] ) );
		}
		if ( ! empty( $sticky_menu_color['hover'] ) ) {
			printf( '#site-header.h-fixed .primary-menu > li > a:hover { color: %s !important; }', esc_attr( $sticky_menu_color['hover'] ) );
		}
		if ( ! empty( $sticky_menu_color['active'] ) ) {
			printf( '#site-header.h-fixed .primary-menu > li.current_page_item > a, #site-header.h-fixed .primary-menu > li.current-menu-item > a, #site-header.h-fixed .primary-menu > li.current_page_ancestor > a, #site-header.h-fixed .primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $sticky_menu_color['active'] ) );
		}

		/* Page Title */
		$ptitle_bg = kindori_get_page_opt( 'ptitle_bg' );
		$title_font_size = kindori_get_page_opt( 'title_font_size' );
		if ( ! empty( $ptitle_bg['background-image'] ) ) {
			echo 'body #pagetitle.page-title {
                background-image: url(' . esc_attr( $ptitle_bg['background-image'] ) . ');
            }';
		}
		$custom_pagetitle = kindori_get_page_opt( 'custom_pagetitle', false );
        $title_font_size = kindori_get_opt( 'title_font_size' );
        $page_title_font_size = kindori_get_page_opt( 'title_font_size' );
        if($custom_pagetitle && !empty($page_title_font_size)) {
            $title_font_size = $page_title_font_size;
        }
        if ( !empty( $title_font_size ) ) {
            printf( '#pagetitle h1.page-title { font-size: %s'.'px; }', esc_attr($title_font_size) );
        }


        $title_line_hegiht = kindori_get_opt( 'title_line_hegiht' );
        $page_title_line_hegiht = kindori_get_page_opt( 'title_line_hegiht' );
        if($custom_pagetitle && !empty($page_title_line_hegiht)) {
            $title_line_hegiht = $page_title_line_hegiht;
        }
        if ( !empty( $title_line_hegiht ) ) {
            printf( '#pagetitle h1.page-title { line-height: %s'.'px; }', esc_attr($title_line_hegiht) );
        }


		/* Content */
		$content_bg_color = kindori_get_page_opt( 'content_bg_color' );
		if ( ! empty( $content_bg_color['color'] ) ) {
			echo '#pagetitle svg path {
                fill: ' . esc_attr( $content_bg_color['color'] ) . ';
            }';
		}

		/* Footer */
		$footer_bg_color_top      = kindori_get_opt( 'footer_bg_color_top' );
		$footer_top_heading_color = kindori_get_opt( 'footer_top_heading_color' );
		$footer_top_heading_fs    = kindori_get_opt( 'footer_top_heading_fs' );
		$footer_top_heading_tt    = kindori_get_opt( 'footer_top_heading_tt' );
		if ( ! empty( $footer_bg_color_top ) ) {
			echo '.site-footer:before {
                background-color: ' . esc_attr( $footer_bg_color_top['rgba'] ) . ' !important;
            }';
		}
		if ( ! empty( $footer_top_heading_color ) ) {
			echo '.footer-layout1 .top-footer .footer-widget-title {
                color: ' . esc_attr( $footer_top_heading_color ) . ' !important;
            }';
		}
		if ( ! empty( $footer_top_heading_fs ) ) {
			echo '.top-footer .footer-widget-title {
                font-size: ' . esc_attr( $footer_top_heading_fs ) . 'px !important;
            }';
		}
		if ( ! empty( $footer_top_heading_tt ) ) {
			echo '.top-footer .footer-widget-title {
                text-transform: ' . esc_attr( $footer_top_heading_tt ) . ' !important;
            }';
		}
		/* Custom Css */
		$custom_css = kindori_get_opt( 'site_css' );
		if ( ! empty( $custom_css ) ) {
			echo esc_attr( $custom_css );
		}

		return ob_get_clean();
	}
}

new CSS_Generator();