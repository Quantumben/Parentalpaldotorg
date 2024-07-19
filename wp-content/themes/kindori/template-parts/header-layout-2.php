<?php
/**
 * Template part for displaying default header layout
 */
$page_one_page = kindori_get_page_opt( 'page_one_page');
$sticky_on = kindori_get_opt( 'sticky_on', false );
$search_on = kindori_get_opt( 'search_on', false );

$top_bar_phone   = kindori_get_opt('top_bar_phone');
$top_bar_phone_link = kindori_get_opt('top_bar_phone_link');

$social_share_on = kindori_get_opt( 'social_share_on', false );
$top_bar_adress = kindori_get_opt('top_bar_adress');


$h_btn_on = kindori_get_opt( 'h_btn_on', 'hide' );
$h_btn_text = kindori_get_opt( 'h_btn_text' );
$h_btn_link_type = kindori_get_opt( 'h_btn_link_type', 'page' );
$h_btn_link = kindori_get_opt( 'h_btn_link' );
$h_btn_link_custom = kindori_get_opt( 'h_btn_link_custom' );
$h_btn_target = kindori_get_opt( 'h_btn_target', '_self' );
if($h_btn_link_type == 'page') {
    $h_btn_url = get_permalink($h_btn_link);
} else {
    $h_btn_url = $h_btn_link_custom;
}
if(is_404()) {
    return true;
}
?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout2 header-transparent <?php if($sticky_on == 1) { echo 'is-sticky'; } ?> <?php if(isset($page_one_page) && $page_one_page) { echo 'active-menu-onepage'; }?>">
        <div class="bg-blur"></div>
        <div id="site-topbar" class="site-topbar">
            <div class="container">
                <div class="inner-container">
                    <div class="site-branding">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <?php if (!empty($top_bar_phone)) : ?>
                        <div class="item-phone">
                            <i class="material zmdi zmdi-smartphone-android"></i>
                            <a class="info-text" href="tel:<?php echo esc_attr($top_bar_phone_link); ?>">
                                <?php echo wp_kses_post($top_bar_phone); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( !empty($top_bar_adress) ) : ?>
                        <div class="item-adderess">
                            <i class="fa fa-map"></i>
                            <span class="info-text"><?php echo wp_kses_post($top_bar_adress); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($social_share_on) : ?>
                        <div class="item-socials">
                           <?php kindori_social_media();?> 
                        </div>
                    <?php endif; ?>
                    <?php if (class_exists('ReduxFramework')) { ?>
                        <?php if($search_on) : ?>
                            <div class="site-header-search-mobile">
                                <span class="h-btn-search">
                                    <i class="flaticon3 flaticon3-search-icon"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                </div>                
            </div>
        </div>
        <div id="site-header" class="site-header-main">
            <div class="container">
                <div class="row">
                    <div class="inner-row">
                        <div class="site-branding site-branding-mobile">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                        <div class="site-navigation">
                            <nav class="main-navigation">
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </nav>
                        </div>
                        <div class="site-header-right">
                            <?php if (class_exists('ReduxFramework')) { ?>
                                <?php if($search_on) : ?>
                                    <div class="site-header-item site-header-search">
                                        <span class="h-btn-search">
                                            <i class="flaticon3 flaticon3-search-icon"></i>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            <?php } ?>
                            <?php if($h_btn_on == 'show') : ?>
                                <div class="site-header-button">
                                    <a class="btn" href="<?php echo esc_url($h_btn_url); ?>" target="<?php echo esc_attr($h_btn_target); ?>">
                                        <?php echo esc_attr($h_btn_text); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div id="main-menu-mobile">
                                <span class="btn-nav-mobile open-menu">
                                    <span></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>