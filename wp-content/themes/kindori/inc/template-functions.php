<?php
/**
 * Helper functions for the theme
 *
 * @package Kindori
 */

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function kindori_get_opt( $opt_id, $default = false ) {
	$opt_name = kindori_get_opt_name();
	if ( empty( $opt_name ) ) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function kindori_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = kindori_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	// Get page option for Shop Page
    if(class_exists('WooCommerce') && is_shop()){
        $id = get_option( 'woocommerce_shop_page_id' );
    }

	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 *
 * Get post format values.
 *
 * @param $post_format_key
 * @param bool $default
 *
 * @return bool|mixed
 */
function kindori_get_post_format_value( $post_format_key, $default = false ) {
	global $post;

	return $value = ! empty( $post->ID ) ? get_post_meta( $post->ID, $post_format_key, true ) : $default;
}

/**
 * Get Post List 
*/
if(!function_exists('kindori_list_post')){
    function kindori_list_post($post_type = 'post', $default = false){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        return $post_list;
    }
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function kindori_get_opt_name() {
	return apply_filters( 'kindori_opt_name', 'cms_theme_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function kindori_get_page_opt_name() {
	return apply_filters( 'kindori_page_opt_name', 'cms_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function kindori_get_post_opt_name() {
	return apply_filters( 'kindori_post_opt_name', 'kindori_post_options' );
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title'
 */
function kindori_get_page_titles() {
	$title = '';

	// Default titles
	if ( ! is_archive() ) {
		// Posts page view
		if ( is_home() ) {
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
				$title = get_post_meta( $page_for_posts, 'custom_title', true );
				if ( empty( $title ) ) {
					$title = get_the_title( $page_for_posts );
				}
			}
			if ( is_front_page() ) {
				$title = esc_html__( 'Blog', 'kindori' );
			}
		} // Single page view
        elseif ( is_page() ) {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		} elseif ( is_404() ) {
			$title = esc_html__( '404', 'kindori' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'kindori' );
		} else {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		}
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author:', 'kindori' ) . ' ' . get_the_author();
	} // Author
	else {
		$title = get_the_archive_title();
		if( (class_exists( 'WooCommerce' ) && is_shop()) ) {
			$title = esc_html__( 'Our Products', 'kindori' );
		}
	}

	return array(
		'title' => $title,
	);
}

/**
 * Generates an excerpt from the post content with custom length.
 * Default length is 55 words, same as default the_excerpt()
 *
 * The excerpt words amount will be 55 words and if the amount is greater than
 * that, then the string '&hellip;' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as it is.
 *
 * @param int $length Optional. Custom excerpt length, default to 55.
 * @param int|WP_Post $post Optional. You will need to provide post id or post object if used outside loops.
 *
 * @return string           The excerpt with custom length.
 */
function kindori_get_the_excerpt( $length = 55, $post = null ) {
	$post = get_post( $post );

	if ( empty( $post ) || 0 >= $length ) {
		return '';
	}

	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'kindori' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$excerpt_more = apply_filters( 'kindori_excerpt_more', '&hellip;' );
	$excerpt      = wp_trim_words( $content, $length, $excerpt_more );

	return $excerpt;
}


/**
 * Check if provided color string is valid color.
 * Only supports 'transparent', HEX, RGB, RGBA.
 *
 * @param  string $color
 *
 * @return boolean
 */
function kindori_is_valid_color( $color ) {
	$color = preg_replace( "/\s+/m", '', $color );

	if ( $color === 'transparent' ) {
		return true;
	}

	if ( '' == $color ) {
		return false;
	}

	// Hex format
	if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color ) ) {
		return true;
	}

	// rgb or rgba format
	if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color ) ) {
		preg_match_all( "/\d+\.*\d*/", $color, $matches );
		if ( empty( $matches ) || empty( $matches[0] ) ) {
			return false;
		}

		$red   = empty( $matches[0][0] ) ? $matches[0][0] : 0;
		$green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
		$blue  = empty( $matches[0][2] ) ? $matches[0][2] : 0;
		$alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

		if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) {
			return false;
		}
	} else {
		return false;
	}

	return true;
}

/**
 * Minify css
 *
 * @param  string $css
 *
 * @return string
 */
function kindori_css_minifier( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Header Tracking Code to wp_head hook.
 */
function kindori_header_code() {
	$site_header_code = kindori_get_opt( 'site_header_code' );
	if ( $site_header_code !== '' ) {
		print wp_kses( $site_header_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_head', 'kindori_header_code' );

/**
 * Custom Comment List
 */
function kindori_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner">
		        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 90); ?>
		        <div class="comment-content">
		        	<span class="comment-bullet"></span>
		        	<div class="comment-meta">
			            <h4 class="comment-title">
			            	<?php printf( '%s', get_comment_author_link() ); ?>
			            </h4>
		            	<span class="comment-date">
	                        <?php echo get_comment_date().' - '.get_comment_time(); ?>
	                    </span>
		        	</div>
		            <div class="comment-text"><?php comment_text(); ?></div>
		            <div class="comment-reply">
		            	<i class="fa fa-reply"></i>
						<?php comment_reply_link( array_merge( $args, array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth']
						) ) ); ?>
		            </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}

function kindori_comment_reply_text( $link ) {
$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'kindori'), $link );
return $link;
}
add_filter( 'comment_reply_link', 'kindori_comment_reply_text' );

/**
 * Add field subtitle to post.
 */
function kindori_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr__( 'Subtitle', 'kindori' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}

add_action( 'edit_form_after_title', 'kindori_add_subtitle_field' );

/**
 * Save custom theme meta
 */
function kindori_save_meta_boxes( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_subtitle'] ) ) {
		update_post_meta( $post_id, 'post_subtitle', $_POST['post_subtitle'] );
	}
}

add_action( 'save_post', 'kindori_save_meta_boxes' );


add_filter( 'cms_extra_post_types', 'kindori_add_posttype' );
function kindori_add_posttype( $postypes ) {
	$postypes['portfolio'] = array(
		'status' => false,
		'args'       => array(
			'rewrite'             => array(
                'slug'       => ''
 		 	),
		),
	);

	$classes_slug = kindori_get_opt( 'classes_slug', 'classes' );
	$postypes['classes'] = array(
		'status'     => true,
		'item_name'  => esc_attr__( 'CMS Classes', 'kindori' ),
		'items_name' => esc_attr__( 'CMS Classes', 'kindori' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-store',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
				'excerpt',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $classes_slug
 		 	),
		),
		'labels'     => array()
	);

	$cmsevents_slug = kindori_get_opt( 'cmsevents_slug', 'cmsevents' );
	$postypes['cmsevents'] = array(
		'status'     => true,
		'item_name'  => esc_attr__( 'CMS Events', 'kindori' ),
		'items_name' => esc_attr__( 'CMS Events', 'kindori' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-megaphone',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
				'excerpt',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $cmsevents_slug
 		 	),
		),
		'labels'     => array()
	);

	$footer = kindori_get_opt( 'footer_slug', 'footer' );
	$postypes['footer'] = array(
		'status'     => true,
		'item_name'  => esc_attr__( 'Footer', 'kindori' ),
		'items_name' => esc_attr__( 'Footer', 'kindori' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-editor-insertmore',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $footer
 		 	),
		),
		'labels'     => array()
	);

	$gallery_slug = kindori_get_opt( 'gallery_slug', 'gallery' );
	$postypes['gallery'] = array(
		'status'     => true,
		'item_name'  => esc_attr__( 'Gallery', 'kindori' ),
		'items_name' => esc_attr__( 'Galleries', 'kindori' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-images-alt2',
			'supports'           => array(
				'title',
				'thumbnail',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $gallery_slug
 		 	),
		),
		'labels'     => array()
	);
	return $postypes;
}

add_filter( 'cms_extra_taxonomies', 'kindori_add_tax' );
function kindori_add_tax( $taxonomies ) {

	$taxonomies['classes-category'] = array(
		'status'     => true,
		'post_type'  => array( 'classes' ),
		'taxonomy' => esc_attr__( 'Classes Category', 'kindori' ),
		'taxindusticmy'   => esc_attr__( 'Classes Category', 'kindori' ),
		'taxonomies' => esc_attr__( 'Classes Categories', 'kindori' ),
		'args'       => array(),
		'labels'     => array()
	);

	$taxonomies['cmsevents-category'] = array(
		'status'     => true,
		'post_type'  => array( 'cmsevents' ),
		'taxonomy' => esc_attr__( 'CMS Events Category', 'kindori' ),
		'taxindusticmy'   => esc_attr__( 'CMS Events Category', 'kindori' ),
		'taxonomies' => esc_attr__( 'CMS Events Categories', 'kindori' ),
		'args'       => array(),
		'labels'     => array()
	);

	$taxonomies['gallery-category'] = array(
		'status'     => true,
		'post_type'  => array( 'gallery' ),
		'taxonomy' => esc_attr__( 'Gallery Category', 'kindori' ),
		'taxindusticmy'   => esc_attr__( 'Gallery Category', 'kindori' ),
		'taxonomies' => esc_attr__( 'Gallery Categories', 'kindori' ),
		'args'       => array(),
		'labels'     => array()
	);
	
	return $taxonomies;
}

add_filter( 'cms_enable_megamenu', 'kindori_enable_megamenu' );
function kindori_enable_megamenu() {
	return false;
}
add_filter( 'cms_enable_onepage', 'kindori_enable_onepage' );
function kindori_enable_onepage() {
	return true;
}

/* Add default pagram Carousel */
function kindori_get_param_carousel( $atts ) {
	$default  = array(
		'col_xs'           => '1',
		'col_sm'           => '2',
		'col_md'           => '3',
		'col_lg'           => '4',
		'col_xl'           => '4',
		'col_xxl'           => '4',
		'margin'           => '30',
		'loop'             => 'false',
		'autoplay'         => 'false',
		'autoplay_timeout' => '5000',
		'smart_speed'      => '250',
		'center'           => 'false',
		'stage_padding'    => '0',
		'arrows'           => 'false',
		'bullets'          => 'false',
	);
	$new_data = array_merge( $default, $atts );
	extract( $new_data );
	$carousel      = array(
		'data-item-xs' => $col_xs,
		'data-item-sm' => $col_sm,
		'data-item-md' => $col_md,
		'data-item-lg' => $col_lg,
		'data-item-xl' => $col_xl,
		'data-item-xxl' => $col_xxl,

		'data-margin'          => $margin,
		'data-loop'            => $loop,
		'data-autoplay'        => $autoplay,
		'data-autoplaytimeout' => $autoplay_timeout,
		'data-smartspeed'      => $smart_speed,
		'data-center'          => $center,
		'data-arrows'          => $arrows,
		'data-bullets'         => $bullets,
		'data-stagepadding'    => $stage_padding,
		'data-rtl'             => is_rtl() ? 'true' : 'false',
	);
	$carousel_data = '';
	foreach ( $carousel as $key => $value ) {
		if ( isset( $value ) ) {
			$carousel_data .= $key . '=' . $value . ' ';
		}
	}
	$new_data['carousel_data'] = $carousel_data;

	return $new_data;
}

/* Show/hide CMS Carousel */
add_filter( 'enable_cms_carousel', 'kindori_enable_cms_carousel' );
function kindori_enable_cms_carousel() {
	return false;
}

/*
 * Set post views count using post meta
 */
function kindori_set_post_views( $postID ) {
	$countKey = 'post_views_count';
	$count    = get_post_meta( $postID, $countKey, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $countKey );
		add_post_meta( $postID, $countKey, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $countKey, $count );
	}
}

/* Dashboard Theme */
add_filter('cms_documentation_link',function(){
     return 'https://doc.cmssuperheroes.com/wordpress/kindori';
});

add_filter('cms_ticket_link', 'kindori_add_cms_ticket_link');
function kindori_add_cms_ticket_link($url)
{
    $url = array('type' => 'url', 'link' => '#');
    return $url;
}
add_filter('cms_video_tutorial_link',function(){
     return '#';
});

/* Lelementor class Custom */
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'frontline-elementor-custom-editor', get_template_directory_uri() . '/assets/css/elementor-custom-editor.css', array(), '1.0.0' );
} );

// Add custom field to section
if(!function_exists('kindori_custom_section_params')){
    add_filter('etc-custom-section/custom-params', 'kindori_custom_section_params');
    function kindori_custom_section_params(){
        return array(
            'sections' => array(
                array(
                    'name' => 'custom_section',
                    'label' => esc_html__( 'Custom Settings', 'kindori' ),
                    'tab' => Elementor_Theme_Core::ETC_TAB_NAME,
                    'controls' => array(
                        array(
                            'name' => 'custom_style',
                            'label' => esc_html__( 'Style Settings', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                            	'' => esc_html__( 'Default', 'kindori' ),
                            	'row-section-scoll-custom' => esc_html__( 'Row section Scoll', 'kindori' ),
                            ),
                            'prefix_class' => 'cms-',
                            'default' => '',
                        ),
                    ),
                ),
            ),
        );
    }
}

// handle custom class will be added to section
if(!function_exists('kindori_custom_section_classes')){
    add_filter('etc-custom-section-classes', 'kindori_custom_section_classes', 10, 2);
    function kindori_custom_section_classes($classes, $settings){
        return $classes;
    }
}

// Add custom field to column
if(!function_exists('kindori_custom_column_params')){
    add_filter('etc-custom-column/custom-params', 'kindori_custom_column_params');
    function kindori_custom_column_params(){
        return array(
            'sections' => array(
                array(
                    'name' => 'custom_section',
                    'label' => esc_html__( 'Custom Settings', 'kindori' ),
                    'tab' => Elementor_Theme_Core::ETC_TAB_NAME,
                    'controls' => array(
                        array(
                            'name' => 'custom_style',
                            'label' => esc_html__( 'Style Settings', 'kindori' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                            	'' => esc_html__( 'Default', 'kindori' ),
                            	'column-sticky' => esc_html__( 'Column sticky', 'kindori' ),
                            ),
                            'prefix_class' => 'cms-',
                            'default' => '',
                        ),
                    ),
                ),
            ),
        );
    }
}

// handle custom class will be added to column
if(!function_exists('kindori_custom_column_classes')){
    add_filter('etc-custom-column-classes', 'kindori_custom_column_classes', 10, 2);
    function kindori_custom_column_classes($classes, $settings){
    	if(isset($settings['custom_style']) && !empty($settings['custom_style'])){
    		$classes[] = 'style-' . $settings['custom_style'];
    	}
        return $classes;
    }
}