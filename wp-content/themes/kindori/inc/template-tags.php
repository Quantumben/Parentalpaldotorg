<?php
/**
 * Custom template tags for this theme.
 *
 * @package Kindori
 */

/**
 * Header layout
 **/
function kindori_page_loading()
{
    $page_loading = kindori_get_opt( 'show_page_loading', false );

    if($page_loading) { ?>
        <div id="cms-loadding" class="cms-loader">
            <div class="loading-spinner">
                <div class="load-1">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    <?php }
}

/**
 * Header layout
 **/
function kindori_header_layout()
{
    $header_layout = kindori_get_opt( 'header_layout', '1' );
    $custom_header = kindori_get_page_opt( 'custom_header', '0' );

    if ( $custom_header == '1' && !is_singular('classes') )
    {
        $page_header_layout = kindori_get_page_opt('header_layout');
        $header_layout = $page_header_layout;
        if($header_layout == '0') {
            return;
        }
    }

    if(is_404()){
        $header_layout = 2;
    }

    get_template_part( 'template-parts/header-layout', $header_layout );
}

/**
 * Page title layout
 **/
function kindori_page_title_layout()
{
    get_template_part( 'template-parts/page-title', '' );
}

/**
 * Page title layout
 **/
function kindori_footer()
{
    if(is_404()) {
        return true;
    }
    get_template_part( 'template-parts/footer-layout', 'custom' );
}


/**
 * Set primary content class based on sidebar position
 *
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function kindori_primary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) || class_exists( 'WooCommerce' ) && (is_shop()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    elseif (is_post_type_archive('recipe')  || is_tax('recipe-diet')) :
        $sidebar_load = 'sidebar-recipe';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array( trim( $extra_class ) );
        switch ( $sidebar_pos )
        {
            case 'left':
                $class[] = 'content-has-sidebar float-right col-xl-8 col-lg-8 col-md-12';
                break;

            case 'right':
                $class[] = 'content-has-sidebar float-left col-xl-8 col-lg-8 col-md-12';
                break;

            default:
                $class[] = 'content-full-width col-12';
                break;
        }

        $class = implode( ' ', array_filter( $class ) );

        if ( $class )
        {
            echo ' class="' . esc_html($class) . '"';
        }
    } else {
        echo ' class="content-area col-12"';
    }
}

/**
 * Set secondary content class based on sidebar position
 *
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function kindori_secondary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    elseif (is_post_type_archive('recipe') || is_tax('recipe-diet')) :
        $sidebar_load = 'sidebar-recipe';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array(trim($extra_class));
        switch ($sidebar_pos) {
            case 'left':
                $class[] = 'widget-has-sidebar sidebar-fixed col-xl-4 col-lg-4 col-md-12';
                break;

            case 'right':
                $class[] = 'widget-has-sidebar sidebar-fixed col-xl-4 col-lg-4 col-md-12';
                break;

            default:
                break;
        }

        $class = implode(' ', array_filter($class));

        if ($class) {
            echo ' class="' . esc_html($class) . '"';
        }
    }
}


/**
 * Prints HTML for breadcrumbs.
 */
function kindori_breadcrumb()
{
    if ( ! class_exists( 'CMS_Breadcrumb' ) )
    {
        return;
    }

    $breadcrumb = new CMS_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }

    ob_start();

    foreach ( $entries as $entry )
    {
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        echo '<li>';

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="breadcrumb-entry" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="breadcrumb-entry" >%s</span>', esc_html( $entry['label'] ) );
        }

        echo '</li>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<ul class="cms-breadcrumb">%s</ul>', wp_kses_post($output));
    }
}


function kindori_entry_link_pages()
{
    wp_link_pages( array(
        'before'      => '<div class="page-links">',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
}


if ( ! function_exists( 'kindori_entry_excerpt' ) ) :
    /**
     * Print post excerpt based on length.
     *
     * @param  integer $length
     */

    function kindori_entry_excerpt( $length = 25 )
    {
        if(has_excerpt()) {
            echo esc_html(get_the_excerpt());
        } else {
            echo wp_kses_post(kindori_get_the_excerpt( $length ));
        }
    }
endif;

/**
 * Prints post edit link when applicable
 */
function kindori_entry_edit_link()
{
    edit_post_link(
        sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                esc_attr__( 'Edit', 'kindori' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<div class="entry-edit-link"><i class="fa fa-edit"></i>',
        '</div>'
    );
}

if(!function_exists('kindori_ajax_paginate_links')){
    function kindori_ajax_paginate_links($link){
        $parts = parse_url($link);
        parse_str($parts['query'], $query);
        if(isset($query['page']) && !empty($query['page'])){
            return '#' . $query['page'];
        }
        else{
            return '#1';
        }
    }
}

add_action( 'wp_ajax_kindori_get_pagination_html', 'kindori_get_pagination_html' );
add_action( 'wp_ajax_nopriv_kindori_get_pagination_html', 'kindori_get_pagination_html' );
if(!function_exists('kindori_get_pagination_html')){
    function kindori_get_pagination_html(){
        try{
            if(!isset($_POST['query_vars'])){
                throw new Exception(__('Something went wrong while requesting. Please try again!', 'kindori'));
            }
            $query = new WP_Query($_POST['query_vars']);
            ob_start();
            kindori_posts_pagination( $query,  true );
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => esc_attr__('Load Successfully!', 'kindori'),
                    'data' => array(
                        'html' => $html,
                        'query_vars' => $_POST['query_vars'],
                        'post' => $query->have_posts()
                    ),
                )
            );
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
    }
}

/**
 * Prints posts pagination based on query
 *
 * @param  WP_Query $query     Custom query, if left blank, this will use global query ( current query )
 * @return void
 */
function kindori_posts_pagination( $query = null, $ajax = false )
{
    if($ajax){
        add_filter('paginate_links', 'kindori_ajax_paginate_links');
    }

    $classes = array();

    if ( empty( $query ) )
    {
        $query = $GLOBALS['wp_query'];
    }

    if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
    {
        return;
    }

    $paged = $query->get( 'paged', '' );

    if ( ! $paged && is_front_page() && ! is_home() )
    {
        $paged = $query->get( 'page', '' );
    }

    $paged = $paged ? intval( $paged ) : 1;

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) )
    {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $html_prev = '<i class="fal fa-angle-double-left"></i>';
    $html_next = '<i class="fal fa-angle-double-right"></i>';

    $paginate_links_args = array(
        'base'     => $pagenum_link,
        'total'    => $query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => $html_prev,
        'next_text' => $html_next,
    );
    if($ajax){
        $paginate_links_args['format'] = '?page=%#%';
    }
    $links = paginate_links( $paginate_links_args );
    if ( $links ):
    ?>
    <nav class="navigation posts-pagination <?php echo esc_attr($ajax?'ajax':''); ?>">
        <div class="posts-page-links">
            <?php
                printf('%s', $links);
            ?>
        </div>
    </nav>
    <?php
    endif;
}

/**
 * Prints archive meta on blog
 */
if ( ! function_exists( 'kindori_archive_meta' ) ) :
    function kindori_archive_meta() {
        $archive_author_on = kindori_get_opt( 'archive_author_on', false );
        $archive_categories_on = kindori_get_opt( 'archive_categories_on', true );
        $archive_comments_on = kindori_get_opt( 'archive_comments_on', true );
        if($archive_author_on || $archive_comments_on || $archive_categories_on ) : ?>
            <ul class="entry-meta">
                <?php if($archive_author_on) : ?>
                    <li class="item-author">
                        <?php echo get_avatar(get_post()->post_author);?>
                        <span><?php echo esc_html__('By', 'kindori'); ?></span>
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
                <?php if($archive_comments_on) : ?>
                    <li class="item-comment"><a href="<?php the_permalink(); ?>">
                        <i class="fas fa-comments"></i><?php echo comments_number(esc_attr__('0 Comments', 'kindori'),esc_attr__('1 Comment', 'kindori'),esc_attr__('% Comments', 'kindori')); ?></a></li>
                <?php endif; ?>
                <?php if($archive_categories_on) : ?>
                    <li class="item-category">
                        <i class="fas fa-tag"></i>
                        <?php the_terms( get_the_ID(), 'category', '', ', ' ); ?>                            
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; }
endif;

if ( ! function_exists( 'kindori_post_meta' ) ) :
    function kindori_post_meta() {
        $post_author_on = kindori_get_opt( 'post_author_on', true );
        $post_categories_on = kindori_get_opt( 'post_categories_on', true );
        $post_comments_on = kindori_get_opt( 'post_comments_on', false );
        if( $post_author_on || $post_comments_on || $post_categories_on ) : ?>
            <ul class="entry-meta">
                <?php if($post_author_on) : ?>
                    <li class="item-author">
                        <?php echo get_avatar(get_post()->post_author);?>
                        <span><?php echo esc_html__('By:', 'kindori'); ?></span>
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
                
                <?php if($post_comments_on) : ?>
                    <li class="item-comment">
                        <a href="<?php the_permalink(); ?>"><i class="fas fa-comments"></i><?php echo comments_number(esc_attr__('0 Comments', 'kindori'),esc_attr__('1 Comment', 'kindori'),esc_attr__('% Comments', 'kindori')); ?>
                            
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($post_categories_on) : ?>
                    <li class="item-category">
                        <i class="fas fa-tag"></i>
                        <?php the_terms( get_the_ID(), 'category', '', ', ' ); ?>
                    </li>
                <?php endif; ?>
                
            </ul>
        <?php endif; }
endif;
/**
 * Animate
*/

function kindori_animate() {
    $cms_animate = array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow flash' => 'flash',
        'wow pulse' => 'pulse',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flip' => 'flip',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow hinge' => 'hinge',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow zoomIn' => 'zoomIn',
        'wow zoomInDown' => 'zoomInDown',
        'wow zoomInLeft' => 'zoomInLeft',
        'wow zoomInRight' => 'zoomInRight',
        'wow zoomInUp' => 'zoomInUp',
        'wow zoomOut' => 'zoomOut',
        'wow zoomOutDown' => 'zoomOutDown',
        'wow zoomOutLeft' => 'zoomOutLeft',
        'wow zoomOutRight' => 'zoomOutRight',
        'wow zoomOutUp' => 'zoomOutUp',
    );
    return $cms_animate;
}

/**
 * Prints tag list
 */
if ( ! function_exists( 'kindori_entry_tagged_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function kindori_entry_tagged_in()
    {
        $tags_list = get_the_tag_list( '', ' ' );
        if ( $tags_list )
        {
            echo '<div class="entry-tags">';
            echo '<label class="title-tags">';
            echo esc_html__( 'Tags: ','kindori' );
            echo '</label>';
            printf('%2$s', '', $tags_list);
            echo '</div>';
        }
    }
endif;

/**
 * List socials share for post.
 */
function kindori_socials_share_default() { ?>
    <ul class="entry-socail">
        <li>
            <a class="fb-social hover-effect" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                <i class="fa fa-facebook"></i>
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li>
            <a class="tw-social hover-effect" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>">
                <i class="fa fa-twitter"></i>
                <i class="fa fa-twitter"></i>
            </a>
        </li>
        <li>
            <a class="g-social hover-effect" title="Google Plus" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                <i class="fa fa-google-plus"></i>
                <i class="fa fa-google-plus"></i>
            </a>
        </li>
    </ul>
    <?php
}
/**
 * Related Post
 */
function kindori_related_post()
{
    $post_related_on = kindori_get_opt( 'post_related_on', true );

    if($post_related_on) {
        global $post;
        $current_id = $post->ID;
        $posttags = get_the_category($post->ID);
        if (empty($posttags)) return;

        $tags = array();

        foreach ($posttags as $tag) {

            $tags[] = $tag->term_id;
        }
        $post_number = '6';
        $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
        if (count($query_similar->posts) > 1) {
            wp_enqueue_script( 'owl-carousel' );
            wp_enqueue_script( 'kindori-carousel' );
            ?>
            <div class="cms-related-post">
                <h4 class="widget-title"><?php echo esc_html__('Related Posts', 'kindori'); ?></h4>
                <div class="cms-related-post-inner owl-carousel" data-item-xs="1" data-item-sm="2" data-item-md="2" data-item-lg="2" data-item-xl="2" data-item-xxl="2" data-margin="30" data-loop="false" data-autoplay="false" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false" data-arrows="false" data-bullets="false" data-stagepadding="0" data-stagepaddingsm="0" data-rtl="false">
                    <?php foreach ($query_similar->posts as $post):
                        $thumbnail_url = '';
                        if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                            $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'larger', false);
                        endif;
                        $archive_date_on = kindori_get_opt( 'archive_date_on', true );
                        $archive_comments_on = kindori_get_opt( 'archive_comments_on', true );
                        $archive_author_on = kindori_get_opt( 'archive_author_on', false );
                        if ($post->ID !== $current_id) : ?>
                            <div class="grid-item">
                                <div class="grid-item-inner">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="item-featured">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail_url[0]); ?>" /></a>
                                            <?php if($archive_date_on) : ?>
                                                <span class="item-date"><?php echo get_the_date(); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="entry-holder">
                                        <?php 
                                        if( $archive_comments_on || $archive_author_on) : ?>
                                        <ul class="entry-meta">
                                            <?php if($archive_author_on) : ?>
                                                <li class="item-author">
                                                    <?php echo get_avatar(get_post()->post_author);?>
                                                    <span><?php echo esc_html__('By', 'kindori'); ?></span>
                                                    <?php the_author_posts_link(); ?>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($archive_comments_on) : ?>
                                                <li class="item-comment"><a href="<?php the_permalink(); ?>"><i class="fas fa-comments"></i>
                                                    <?php echo comments_number(esc_attr__('0 Comments', 'kindori'),esc_attr__('1 Comment', 'kindori'),esc_attr__('% Comments', 'kindori')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php endif; ?>
                                        <h5 class="entry-title">
                                            <a href="<?php echo esc_url( get_permalink()); ?>">
                                                <?php if(is_sticky()) { ?>
                                                    <i class="fa fa-thumb-tack"></i>
                                                <?php } ?>
                                                <?php the_title(); ?>
                                            </a>
                                        </h5>
                                        <div class="entry-content">
                                            <?php
                                                kindori_entry_excerpt();
                                                wp_link_pages( array(
                                                    'before'      => '<div class="page-links">',
                                                    'after'       => '</div>',
                                                    'link_before' => '<span>',
                                                    'link_after'  => '</span>',
                                                ) );
                                            ?>
                                        </div>
                                        <div class="entry-readmore">
                                            <a href="<?php echo esc_url( get_permalink()); ?>" class="btn-more">
                                                <?php echo esc_html__('Read More', 'kindori'); ?>
                                                <i class="fas fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        <?php }
    }

    wp_reset_postdata();
}

/**
 * Search Popup
 */
function kindori_search_popup()
{
    $search_on = kindori_get_opt( 'search_on', false );
    if($search_on) { ?>
        <div class="cms-modal cms-modal-search">
            <div class="cms-modal-close">x</div>
            <div class="cms-modal-content">
                <form role="search" method="get" class="search-form-popup" action="<?php echo esc_url(home_url( '/' )); ?>">
                    <div class="searchform-wrap">
                        <input type="text" placeholder="<?php echo esc_attr__('Type Words Then Enter', 'kindori'); ?>" id="search" name="s" class="search-field"/>
                        <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <?php }
}
/**
 * User custom fields.
 */
add_action( 'show_user_profile', 'kindori_user_fields' );
add_action( 'edit_user_profile', 'kindori_user_fields' );
function kindori_user_fields($user){

    $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
    $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
    $user_linkedin = get_user_meta($user->ID, 'user_linkedin', true);
    $user_skype = get_user_meta($user->ID, 'user_skype', true);
    $user_google = get_user_meta($user->ID, 'user_google', true);
    $user_youtube = get_user_meta($user->ID, 'user_youtube', true);
    $user_vimeo = get_user_meta($user->ID, 'user_vimeo', true);
    $user_tumblr = get_user_meta($user->ID, 'user_tumblr', true);
    $user_rss = get_user_meta($user->ID, 'user_rss', true);
    $user_pinterest = get_user_meta($user->ID, 'user_pinterest', true);
    $user_instagram = get_user_meta($user->ID, 'user_instagram', true);
    $user_yelp = get_user_meta($user->ID, 'user_yelp', true);

    ?>
    <h3><?php esc_html_e('Social', 'kindori'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook', 'kindori'); ?></label></th>
            <td>
                <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter', 'kindori'); ?></label></th>
            <td>
                <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'kindori'); ?></label></th>
            <td>
                <input id="user_linkedin" name="user_linkedin" type="text" value="<?php echo esc_attr(isset($user_linkedin) ? $user_linkedin : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_skype"><?php esc_html_e('Skype', 'kindori'); ?></label></th>
            <td>
                <input id="user_skype" name="user_skype" type="text" value="<?php echo esc_attr(isset($user_skype) ? $user_skype : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_google"><?php esc_html_e('Google', 'kindori'); ?></label></th>
            <td>
                <input id="user_google" name="user_google" type="text" value="<?php echo esc_attr(isset($user_google) ? $user_google : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_youtube"><?php esc_html_e('Youtube', 'kindori'); ?></label></th>
            <td>
                <input id="user_youtube" name="user_youtube" type="text" value="<?php echo esc_attr(isset($user_youtube) ? $user_youtube : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_vimeo"><?php esc_html_e('Vimeo', 'kindori'); ?></label></th>
            <td>
                <input id="user_vimeo" name="user_vimeo" type="text" value="<?php echo esc_attr(isset($user_vimeo) ? $user_vimeo : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_tumblr"><?php esc_html_e('Tumblr', 'kindori'); ?></label></th>
            <td>
                <input id="user_tumblr" name="user_tumblr" type="text" value="<?php echo esc_attr(isset($user_tumblr) ? $user_tumblr : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_rss"><?php esc_html_e('Rss', 'kindori'); ?></label></th>
            <td>
                <input id="user_rss" name="user_rss" type="text" value="<?php echo esc_attr(isset($user_rss) ? $user_rss : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_pinterest"><?php esc_html_e('Pinterest', 'kindori'); ?></label></th>
            <td>
                <input id="user_pinterest" name="user_pinterest" type="text" value="<?php echo esc_attr(isset($user_pinterest) ? $user_pinterest : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_instagram"><?php esc_html_e('Instagram', 'kindori'); ?></label></th>
            <td>
                <input id="user_instagram" name="user_instagram" type="text" value="<?php echo esc_attr(isset($user_instagram) ? $user_instagram : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_yelp"><?php esc_html_e('Yelp', 'kindori'); ?></label></th>
            <td>
                <input id="user_yelp" name="user_yelp" type="text" value="<?php echo esc_attr(isset($user_yelp) ? $user_yelp : ''); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save user custom fields.
 */
add_action( 'personal_options_update', 'kindori_save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'kindori_save_user_custom_fields' );
function kindori_save_user_custom_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    if(isset($_POST['user_facebook']))
        update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    if(isset($_POST['user_twitter']))
        update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    if(isset($_POST['user_linkedin']))
        update_user_meta( $user_id, 'user_linkedin', $_POST['user_linkedin'] );
    if(isset($_POST['user_skype']))
        update_user_meta( $user_id, 'user_skype', $_POST['user_skype'] );
    if(isset($_POST['user_google']))
        update_user_meta( $user_id, 'user_google', $_POST['user_google'] );
    if(isset($_POST['user_youtube']))
        update_user_meta( $user_id, 'user_youtube', $_POST['user_youtube'] );
    if(isset($_POST['user_vimeo']))
        update_user_meta( $user_id, 'user_vimeo', $_POST['user_vimeo'] );
    if(isset($_POST['user_tumblr']))
        update_user_meta( $user_id, 'user_tumblr', $_POST['user_tumblr'] );
    if(isset($_POST['user_rss']))
        update_user_meta( $user_id, 'user_rss', $_POST['user_rss'] );
    if(isset($_POST['user_pinterest']))
        update_user_meta( $user_id, 'user_pinterest', $_POST['user_pinterest'] );
    if(isset($_POST['user_instagram']))
        update_user_meta( $user_id, 'user_instagram', $_POST['user_instagram'] );
    if(isset($_POST['user_yelp']))
        update_user_meta( $user_id, 'user_yelp', $_POST['user_yelp'] );
}
/* Author Social */
function kindori_get_user_social() {
    $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
    $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
    $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
    $user_skype = get_user_meta(get_the_author_meta( 'ID' ), 'user_skype', true);
    $user_google = get_user_meta(get_the_author_meta( 'ID' ), 'user_google', true);
    $user_youtube = get_user_meta(get_the_author_meta( 'ID' ), 'user_youtube', true);
    $user_vimeo = get_user_meta(get_the_author_meta( 'ID' ), 'user_vimeo', true);
    $user_tumblr = get_user_meta(get_the_author_meta( 'ID' ), 'user_tumblr', true);
    $user_rss = get_user_meta(get_the_author_meta( 'ID' ), 'user_rss', true);
    $user_pinterest = get_user_meta(get_the_author_meta( 'ID' ), 'user_pinterest', true);
    $user_instagram = get_user_meta(get_the_author_meta( 'ID' ), 'user_instagram', true);
    $user_yelp = get_user_meta(get_the_author_meta( 'ID' ), 'user_yelp', true);

    ?>
    <ul class="user-social">
        <?php if(!empty($user_facebook)) { ?>
            <li><a href="<?php echo esc_url($user_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_twitter)) { ?>
            <li><a href="<?php echo esc_url($user_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_linkedin)) { ?>
            <li><a href="<?php echo esc_url($user_linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_rss)) { ?>
            <li><a href="<?php echo esc_url($user_rss); ?>"><i class="fa fa-rss"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_instagram)) { ?>
            <li><a href="<?php echo esc_url($user_instagram); ?>"><i class="fa fa-instagram"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_google)) { ?>
            <li><a href="<?php echo esc_url($user_google); ?>"><i class="fa fa-google-plus"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_skype)) { ?>
            <li><a href="<?php echo esc_url($user_skype); ?>"><i class="fa fa-skype"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_pinterest)) { ?>
            <li><a href="<?php echo esc_url($user_pinterest); ?>"><i class="fa fa-pinterest"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_vimeo)) { ?>
            <li><a href="<?php echo esc_url($user_vimeo); ?>"><i class="fa fa-vimeo"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_youtube)) { ?>
            <li><a href="<?php echo esc_url($user_youtube); ?>"><i class="fa fa-youtube"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_yelp)) { ?>
            <li><a href="<?php echo esc_url($user_yelp); ?>"><i class="fa fa-yelp"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_tumblr)) { ?>
            <li><a href="<?php echo esc_url($user_tumblr); ?>"><i class="fa fa-tumblr"></i></a></li>
        <?php } ?>

    </ul> <?php
}

function kindori_social_share_product() { ?>
    <a class="fb-social hover-effect" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="zmdi zmdi-facebook"></i></a>
    <a class="tw-social hover-effect" title="Twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="zmdi zmdi-twitter"></i></a>
    <a class="g-social hover-effect" title="Google Plus" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-google-plus"></i></a>
    <a class="pin-social hover-effect" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(the_post_thumbnail_url( 'full' )); ?>&media=&description=<?php the_title(); ?>"><i class="zmdi zmdi-pinterest"></i></a>
    <?php
}
/**
 * Social Footer
 */
function kindori_social_media() {
    $social_media = kindori_get_opt( 'social_media' );
    $social = $social_media['enabled'];
    if ($social) : foreach ($social as $key=>$value) { ?>
        <?php switch($key) {

            case 'facebook': echo '<a title="Facebook" href="'.esc_url(kindori_get_opt( 'social_facebook_url' )).'"><i class="zmdi zmdi-facebook"></i></a>';
            break;

            case 'twitter': echo '<a title="Twitter" href="'.esc_url(kindori_get_opt( 'social_twitter_url' )).'"><i class="zmdi zmdi-twitter"></i></a>';
            break;

            case 'linkedin': echo '<a title="Linkedin" href="'.esc_url(kindori_get_opt( 'social_inkedin_url' )).'"><i class="zmdi zmdi-linkedin"></i></a>';
            break;

            case 'rss': echo '<a title="Rss" href="'.esc_url(kindori_get_opt( 'social_rss_url' )).'"><i class="zmdi zmdi-rss"></i></i></a>';
            break;

            case 'instagram': echo '<a title="Instagram" href="'.esc_url(kindori_get_opt( 'social_instagram_url' )).'"><i class="zmdi zmdi-instagram"></i></a>';
            break;

            case 'google': echo '<a title="Google+" href="'.esc_url(kindori_get_opt( 'social_google_url' )).'"><i class="zmdi zmdi-google-plus"></i></a>';
            break;

            case 'skype': echo '<a title="Skype" href="'.esc_url(kindori_get_opt( 'social_skype_url' )).'"><i class="zmdi zmdi-skype"></i></a>';
            break;

            case 'pinterest': echo '<a title="Pinterest" href="'.esc_url(kindori_get_opt( 'social_pinterest_url' )).'"><i class="zmdi zmdi-pinterest"></i></a>';
            break;

            case 'vimeo': echo '<a title="Vimeo" href="'.esc_url(kindori_get_opt( 'social_vimeo_url' )).'"><i class="zmdi zmdi-vimeo"></i></a>';
            break;

            case 'youtube': echo '<a title="Youtube" href="'.esc_url(kindori_get_opt( 'social_youtube_url' )).'"><i class="zmdi zmdi-youtube"></i></a>';
            break;

            case 'yelp': echo '<a title="Yelp" href="'.esc_url(kindori_get_opt( 'social_yelp_url' )).'"><i class="fa fa-yelp"></i></a>';
            break;

            case 'tumblr': echo '<a title="Tumblr" href="'.esc_url(kindori_get_opt( 'social_tumblr_url' )).'"><i class="fa fa-tumblr"></i></a>';
            break;

            case 'tripadvisor': echo '<a title="Tripadvisor" href="'.esc_url(kindori_get_opt( 'social_tripadvisor_url' )).'"><i class="fa fa-tripadvisor"></i></a>';
            break;

        }
    }
    endif;
}

function kindori_product_nav() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="product-previous-next">
            <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { ?>
                <a class="nav-link-prev" href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><i class="fa fa-long-arrow-left"></i></a>
            <?php } ?>
            <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { ?>
                <a class="nav-link-next" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><i class="fa fa-long-arrow-right"></i></a>
            <?php } ?>
        </div>
    <?php }
}

/**
 * Social Icon
 */
function kindori_social_header() {
    $social_facebook_url = kindori_get_opt( 'social_facebook_url' );
    $social_twitter_url = kindori_get_opt( 'social_twitter_url' );
    $social_inkedin_url = kindori_get_opt( 'social_inkedin_url' );
    $social_instagram_url = kindori_get_opt( 'social_instagram_url' );
    $social_google_url = kindori_get_opt( 'social_google_url' );
    $social_skype_url = kindori_get_opt( 'social_skype_url' );
    $social_pinterest_url = kindori_get_opt( 'social_pinterest_url' );
    $social_vimeo_url = kindori_get_opt( 'social_vimeo_url' );
    $social_youtube_url = kindori_get_opt( 'social_youtube_url' );
    $social_yelp_url = kindori_get_opt( 'social_yelp_url' );
    $social_tumblr_url = kindori_get_opt( 'social_tumblr_url' );
    $social_tripadvisor_url = kindori_get_opt( 'social_tripadvisor_url' );

    if(!empty($social_tripadvisor_url)) :
        echo '<a href="'.esc_url($social_tripadvisor_url).'" target="_blank"><i class="fa fa-tripadvisor"></i></a>';
    endif;
    if(!empty($social_facebook_url)) :
        echo '<a href="'.esc_url($social_facebook_url).'" target="_blank"><i class="fa fa-facebook"></i></a>';
    endif;
    if(!empty($social_twitter_url)) :
        echo '<a href="'.esc_url($social_twitter_url).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    endif;
    if(!empty($social_inkedin_url)) :
        echo '<a href="'.esc_url($social_inkedin_url).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    endif;
    if(!empty($social_instagram_url)) :
        echo '<a href="'.esc_url($social_instagram_url).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    endif;
    if(!empty($social_google_url)) :
        echo '<a href="'.esc_url($social_google_url).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    endif;
    if(!empty($social_skype_url)) :
        echo '<a href="'.esc_url($social_skype_url).'" target="_blank"><i class="fa fa-skype"></i></a>';
    endif;
    if(!empty($social_pinterest_url)) :
        echo '<a href="'.esc_url($social_pinterest_url).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    endif;
    if(!empty($social_vimeo_url)) :
        echo '<a href="'.esc_url($social_vimeo_url).'" target="_blank"><i class="fa fa-vimeo"></i></a>';
    endif;
    if(!empty($social_youtube_url)) :
        echo '<a href="'.esc_url($social_youtube_url).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    endif;
    if(!empty($social_yelp_url)) :
        echo '<a href="'.esc_url($social_yelp_url).'" target="_blank"><i class="fa fa-yelp"></i></a>';
    endif;
    if(!empty($social_tumblr_url)) :
        echo '<a href="'.esc_url($social_tumblr_url).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    endif;
}

function kindori_social_footer() {
    $f_social_facebook_url = kindori_get_opt( 'f_social_facebook_url' );
    $f_social_twitter_url = kindori_get_opt( 'f_social_twitter_url' );
    $f_social_inkedin_url = kindori_get_opt( 'f_social_inkedin_url' );
    $f_social_instagram_url = kindori_get_opt( 'f_social_instagram_url' );
    $f_social_google_url = kindori_get_opt( 'f_social_google_url' );
    $f_social_skype_url = kindori_get_opt( 'f_social_skype_url' );
    $f_social_pinterest_url = kindori_get_opt( 'f_social_pinterest_url' );
    $f_social_vimeo_url = kindori_get_opt( 'f_social_vimeo_url' );
    $f_social_youtube_url = kindori_get_opt( 'f_social_youtube_url' );
    $f_social_yelp_url = kindori_get_opt( 'f_social_yelp_url' );
    $f_social_tumblr_url = kindori_get_opt( 'f_social_tumblr_url' );
    $f_social_tripadvisor_url = kindori_get_opt( 'f_social_tripadvisor_url' );

    if(!empty($f_social_tripadvisor_url)) :
        echo '<a href="'.esc_url($f_social_tripadvisor_url).'" target="_blank"><i class="fa fa-tripadvisor"></i></a>';
    endif;
    if(!empty($f_social_facebook_url)) :
        echo '<a href="'.esc_url($f_social_facebook_url).'" target="_blank"><i class="fa fa-facebook"></i></a>';
    endif;
    if(!empty($f_social_twitter_url)) :
        echo '<a href="'.esc_url($f_social_twitter_url).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    endif;
    if(!empty($f_social_inkedin_url)) :
        echo '<a href="'.esc_url($f_social_inkedin_url).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    endif;
    if(!empty($f_social_instagram_url)) :
        echo '<a href="'.esc_url($f_social_instagram_url).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    endif;
    if(!empty($f_social_google_url)) :
        echo '<a href="'.esc_url($f_social_google_url).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    endif;
    if(!empty($f_social_skype_url)) :
        echo '<a href="'.esc_url($f_social_skype_url).'" target="_blank"><i class="fa fa-skype"></i></a>';
    endif;
    if(!empty($f_social_pinterest_url)) :
        echo '<a href="'.esc_url($f_social_pinterest_url).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    endif;
    if(!empty($f_social_vimeo_url)) :
        echo '<a href="'.esc_url($f_social_vimeo_url).'" target="_blank"><i class="fa fa-vimeo"></i></a>';
    endif;
    if(!empty($f_social_youtube_url)) :
        echo '<a href="'.esc_url($f_social_youtube_url).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    endif;
    if(!empty($f_social_yelp_url)) :
        echo '<a href="'.esc_url($f_social_yelp_url).'" target="_blank"><i class="fa fa-yelp"></i></a>';
    endif;
    if(!empty($f_social_tumblr_url)) :
        echo '<a href="'.esc_url($f_social_tumblr_url).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    endif;
}
if(!function_exists('kindori_get_post_grid_layout1')){
    function kindori_get_post_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $author = get_user_by('id', $post->post_author);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                            <div class="entry-featured">
                                <div class="post-image">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </a>
                                    <?php if($show_post_date == 'true'): ?>
                                        <div class="item-date"><?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="entry-body">
                            <?php if($show_meta == 'true'): ?>
                                <ul class="entry-meta">
                                    <?php if($show_author == 'true'): ?>
                                        <li class="item-author">
                                            <?php echo get_avatar(get_post()->post_author);?>
                                            <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>">
                                                <?php echo esc_html($author->display_name); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($show_categories == 'true'): ?>
                                        <li class="item-category"><?php the_terms( $post->ID, 'category', '', ', ' ); ?></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if($show_title == 'true'): ?>
                                <<?php etc_print_html($title_tag);?> class="entry-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></<?php etc_print_html($title_tag);?>>
                            <?php endif; ?>
                            <?php if($show_excerpt == 'true'): ?>
                                <div class="entry-content">
                                    <?php
                                        if(!empty($post->post_excerpt)){
                                            echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
                                        }
                                        else{
                                            $content = strip_shortcodes( $post->post_content );
                                            $content = apply_filters( 'the_content', $content );
                                            $content = str_replace(']]>', ']]&gt;', $content);
                                            $content = wp_trim_words( $content, $num_words, '&hellip;' );
                                            echo wp_kses_post($content);
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if($show_button == 'true'): ?>
                                <div class="entry-readmore">
                                    <a class="btn-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr($button_text); ?>
                                        <i class="fac fac-arrow-right space-left"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}
if(!function_exists('kindori_get_classes_list_layout1')){
    function kindori_get_classes_list_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $classes_price = get_post_meta($post->ID, 'classes_price', true);
                ?>
                <div class="classes-item">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                        <div class="entry-featured">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>    
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="entry-body">
                        <<?php etc_print_html($title_tag);?> class="entry-title">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo esc_attr(get_the_title($post->ID)); ?>
                            </a>
                        </<?php etc_print_html($title_tag);?>>
                        <?php if(!empty($classes_price)): ?>
                            <div class="entry-price">
                                <span class="item-price"><?php echo esc_attr( $classes_price );?></span> /<span class="item-day"><?php echo esc_html__( 'Day', 'kindori' ) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}
if(!function_exists('kindori_get_classes_grid_layout1')){
    function kindori_get_classes_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $classes_price = get_post_meta($post->ID, 'classes_price', true);
                $classes_size = get_post_meta($post->ID, 'classes_size', true);
                $classes_age = get_post_meta($post->ID, 'classes_age', true);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <div class="classes-item">
                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                                <div class="entry-featured image-light-box">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                    <a class="light-box" href="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), $size = 'full') ?>">+</a>
                                </div>
                            <?php endif; ?>
                            <div class="entry-body">
                                <?php if($show_title == 'true'): ?>
                                    <<?php etc_print_html($title_tag);?> class="entry-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></<?php etc_print_html($title_tag);?>>
                                <?php endif; ?>
                                <?php if($show_excerpt == 'true'): ?>
                                    <div class="entry-content">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
                                            }
                                            else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                $content = wp_trim_words( $content, $num_words, '&hellip;' );
                                                echo wp_kses_post($content);
                                            }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="entry-meta">
                                    <?php if(!empty($classes_age)): ?>
                                        <div class="item-box">
                                            <label><?php echo esc_html__( 'Age', 'kindori') ?></label>
                                            <div class="box-value">
                                                <span><?php echo esc_attr( $classes_age );?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($classes_size)): ?>
                                        <div class="item-box">
                                            <label><?php echo esc_html__( 'Size', 'kindori') ?></label>
                                            <div class="box-value">
                                                <span><?php echo esc_attr( $classes_size );?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($classes_price)): ?>
                                        <div class="item-box">
                                            <label><?php echo esc_html__( 'Price', 'kindori') ?></label>
                                            <div class="box-value">
                                                <span><?php echo esc_attr( $classes_price );?></span>
                                                <span><?php echo esc_html__( '/Day', 'kindori' ) ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}

if(!function_exists('kindori_get_cmsevents_grid_layout1')){
    function kindori_get_cmsevents_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $cmsevents_startday = get_post_meta($post->ID, 'cmsevents_startday', true);
                $cmsevents_time = get_post_meta($post->ID, 'cmsevents_time', true);
                $cmsevents_place = get_post_meta($post->ID, 'cmsevents_place', true);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <div class="cmsevents-item">
                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                                <div class="entry-featured image-light-box">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                    <a class="light-box" href="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), $size = 'full') ?>">+</a>
                                </div>
                            <?php endif; ?>
                            <div class="entry-body">
                                <?php if($show_title == 'true'): ?>
                                    <<?php etc_print_html($title_tag);?> class="entry-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></<?php etc_print_html($title_tag);?>>
                                <?php endif; ?>
                                <?php if($show_excerpt == 'true'): ?>
                                    <div class="entry-content">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
                                            }
                                            else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                $content = wp_trim_words( $content, $num_words, '&hellip;' );
                                                echo wp_kses_post($content);
                                            }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="entry-meta">
                                    <?php if(!empty($cmsevents_startday)): ?>
                                        <div class="item-box item-box-date">
                                            <label><i class="far fa-calendar-alt"></i><?php echo esc_html__( 'Start day: ', 'kindori') ?></label>
                                            <span><?php echo esc_attr( $cmsevents_startday );?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($cmsevents_time)): ?>
                                        <div class="item-box item-box-time">
                                            <label><i class="far fa-clock"></i><?php echo esc_html__( 'Time: ', 'kindori') ?></label>
                                            <span><?php echo esc_attr( $cmsevents_time );?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($cmsevents_place)): ?>
                                        <div class="item-box item-box-place">
                                            <label><i class="fas fa-map-marker-alt"></i><?php echo esc_html__( 'Place: ', 'kindori') ?></label>
                                            <span><?php echo esc_attr( $cmsevents_place );?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if($show_button == 'true'): ?>
                                    <div class="entry-readmore">
                                        <a class="btn-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr($button_text); ?>
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}

if(!function_exists('kindori_get_cmsevents_grid_layout2')){
    function kindori_get_cmsevents_grid_layout2($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $cmsevents_startday = get_post_meta($post->ID, 'cmsevents_startday', true);
                $cmsevents_time = get_post_meta($post->ID, 'cmsevents_time', true);
                $cmsevents_place = get_post_meta($post->ID, 'cmsevents_place', true);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <div class="cmsevents-item">

                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) { 
                                $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $img_size, false);?>
                                <div class="entry-featured" style="background-image: url(<?php echo esc_url($thumbnail_url[0]); ?>);">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        +
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="entry-body">
                                <?php if($show_title == 'true'): ?>
                                    <<?php etc_print_html($title_tag);?> class="entry-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></<?php etc_print_html($title_tag);?>>
                                <?php endif; ?>
                                <div class="entry-meta">
                                    <?php if(!empty($cmsevents_startday)): ?>
                                        <div class="item-box item-box-date">
                                            <label><i class="far fa-calendar-alt"></i><?php echo esc_html__( 'Start day: ', 'kindori') ?></label>
                                            <span><?php echo esc_attr( $cmsevents_startday );?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($cmsevents_time)): ?>
                                        <div class="item-box item-box-time">
                                            <label><i class="far fa-clock"></i><?php echo esc_html__( 'Time: ', 'kindori') ?></label>
                                            <span><?php echo esc_attr( $cmsevents_time );?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($cmsevents_place)): ?>
                                        <div class="item-box item-box-place">
                                            <label><i class="fas fa-map-marker-alt"></i><?php echo esc_html__( 'Place: ', 'kindori') ?></label>
                                            <span><?php echo esc_attr( $cmsevents_place );?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if($show_button == 'true'): ?>
                                    <div class="entry-readmore">
                                        <a class="btn-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr($button_text); ?>
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}

if(!function_exists('kindori_get_cmsevents_list_layout1')){
    function kindori_get_cmsevents_list_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                ?>
                <div class="cmsevents-item">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                        <div class="entry-featured">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>    
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="entry-body">
                        <<?php etc_print_html($title_tag);?> class="entry-title">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo esc_attr(get_the_title($post->ID)); ?>
                            </a>
                        </<?php etc_print_html($title_tag);?>>
                        <div class="entry-price">
                            <span class="item-price"><?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}
//Gallery
if(!function_exists('kindori_get_gallery_grid_layout1')){
    function kindori_get_gallery_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = 'full';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <div class="gallery-item">
                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                                <div class="entry-featured">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                    <div class="meta-link">
                                        <a class="btn-link" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <a class="light-box" href="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), $size = 'full') ?>">+</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}
if(!function_exists('kindori_get_post_grid')){
    function kindori_get_post_grid($posts = [], $settings = []){
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['template_type']) {
            case 'post_grid_layout1':
                kindori_get_post_grid_layout1($posts, $settings);
                break;
            case 'classes_list_layout1':
                kindori_get_classes_list_layout1($posts, $settings);
                break;
            case 'cmsevents_list_layout1':
                kindori_get_cmsevents_list_layout1($posts, $settings);
                break;

            case 'classes_grid_layout1':
                kindori_get_classes_grid_layout1($posts, $settings);
                break;    
            case 'cmsevents_grid_layout1':
                kindori_get_cmsevents_grid_layout1($posts, $settings);
                break;
            case 'cmsevents_grid_layout2':
                kindori_get_cmsevents_grid_layout2($posts, $settings);
                break;
            case 'gallery_grid_layout1':
                kindori_get_gallery_grid_layout1($posts, $settings);
                break;
                
            default:
                return false;
                break;
        }
    }
}

add_action( 'wp_ajax_kindori_load_more_post_grid', 'kindori_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_kindori_load_more_post_grid', 'kindori_load_more_post_grid' );
if(!function_exists('kindori_load_more_post_grid')){
    function kindori_load_more_post_grid(){
        try{
            if(!isset($_POST['settings'])){
                throw new Exception(__('Something went wrong while requesting. Please try again!', 'kindori'));
            }
            $settings = $_POST['settings'];
            set_query_var('paged', $settings['paged']);
            extract(etc_get_posts_of_grid($settings['posttype'], [
                'source' => isset($settings['source'])?$settings['source']:'',
                'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
                'order' => isset($settings['order'])?$settings['order']:'desc',
                'limit' => isset($settings['limit'])?$settings['limit']:'6',
                'post_ids' => '',
            ]));
            ob_start();
            kindori_get_post_grid($posts, $settings);
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => esc_attr__('Load Successfully!', 'kindori'),
                    'data' => array(
                        'html' => $html,
                        'paged' => $settings['paged'],
                        'posts' => $posts,
                        'max' => $max,
                    ),
                )
            );
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
    }
}

/**
* Display navigation to next/previous post when applicable.
*/
function kindori_post_nav_default() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    

    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="nav-links">
            <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { 
                $prev_img_id = get_post_thumbnail_id($previous_post->ID);
                $prev_img_url = wp_get_attachment_image_src($prev_img_id, 'thumbnail');
                ?>
                <div class="nav-item nav-post-prev">
                    <?php if(!empty($prev_img_id)) : ?>
                        <div class="nav-post-img">
                            <a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>">
                                <img src="<?php echo wp_kses_post($prev_img_url[0]); ?>" />
                                <i class="fac fac-arrow-left"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="nav-post-meta">
                        <label><?php echo esc_html__('Previous', 'kindori'); ?></label>
                        <a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><?php echo get_the_title( $previous_post->ID ); ?></a>
                    </div>
                </div>
            <?php } ?>
            <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { 
                $next_img_id = get_post_thumbnail_id($next_post->ID);
                $next_img_url = wp_get_attachment_image_src($next_img_id, 'thumbnail');
                ?>
                <div class="nav-item nav-post-next">
                    <?php if(!empty($next_img_id)) : ?>
                        <div class="nav-post-img">
                            <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
                                <img src="<?php echo wp_kses_post($next_img_url[0]); ?>" />
                                <i class="fac fac-arrow-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="nav-post-meta">
                        <label><?php echo esc_html__('Next', 'kindori'); ?></label>
                        <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo get_the_title( $next_post->ID ); ?></a>
                    </div>
                </div>
            <?php } ?>
        </div><!-- .nav-links -->
    <?php }
}
//Case Studio
function kindori_post_nav_case() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    

    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="entry-botton-navi">
            <div class="container">
                <div class="entry-bottom">
                    <div class="entry-navigation">
                        <div class="nav-links">
                            <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { 
                                $prev_img_id = get_post_thumbnail_id($previous_post->ID);
                                $prev_img_url = wp_get_attachment_image_src($prev_img_id, 'thumbnail');
                                ?>
                                <div class="nav-item nav-post-prev">
                                    <?php if(!empty($prev_img_id)) : ?>
                                        <div class="nav-post-img">
                                            <a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>">
                                                <img src="<?php echo wp_kses_post($prev_img_url[0]); ?>" />
                                                <i class="fac fac-arrow-left"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="nav-post-meta">
                                        <label><?php echo esc_html__('Previous', 'kindori'); ?></label>
                                        <a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><?php echo get_the_title( $previous_post->ID ); ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="nav-show-all">
                                <a href="<?php echo esc_url(home_url('/classes')); ?>">
                                    <span class="square sp-1"></span>
                                    <span class="square sp-2"></span>
                                    <span class="square sp-3"></span>
                                    <span class="square sp-4"></span>
                                </a>
                            </div>
                            <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { 
                                $next_img_id = get_post_thumbnail_id($next_post->ID);
                                $next_img_url = wp_get_attachment_image_src($next_img_id, 'thumbnail');
                                ?>
                                <div class="nav-item nav-post-next">
                                    <?php if(!empty($next_img_id)) : ?>
                                        <div class="nav-post-img">
                                            <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
                                                <img src="<?php echo wp_kses_post($next_img_url[0]); ?>" />
                                                <i class="fac fac-arrow-right"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="nav-post-meta">
                                        <label><?php echo esc_html__('Next', 'kindori'); ?></label>
                                        <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo get_the_title( $next_post->ID ); ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div><!-- .nav-links -->
                    </div>
                </div>
            </div>
        </div>
    <?php }
}