<?php
/**
 * Template part for displaying the primary menu of the site
 */
if ( has_nav_menu( 'primary' ) ) {
    $menu_id = kindori_get_page_opt('header_menu');
    $menu_attr = [
        'container'  => '',
        'menu_id'    => 'mastmenu',
        'menu_class' => 'primary-menu clearfix',
        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
    ];
    if(!empty($menu_id)){
        $menu_attr['menu'] = $menu_id;
    }
    else{
        $menu_attr['theme_location'] = 'primary';
    }
    wp_nav_menu($menu_attr);
} else { ?>
    <?php if( is_user_logged_in() ) {?>
        <ul class="primary-menu primary-menu-pages">
            <?php wp_list_pages( array(
                'depth'        => 0,
                'show_date'    => '',
                'date_format'  => get_option( 'date_format' ),
                'child_of'     => 0,
                'exclude'      => '',
                'title_li'     => '',
                'echo'         => 1,
                'authors'      => '',
                'sort_column'  => 'menu_order, post_title',
                'link_before'  => '',
                'link_after'   => '',
                'item_spacing' => 'preserve',
                'walker'       => '',
            ) ); ?>
        </ul>
    <?php } ?>
<?php }