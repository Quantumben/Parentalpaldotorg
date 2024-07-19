<?php
/**
 * Template part for displaying default header layout
 */
$sticky_on = kindori_get_opt( 'sticky_on', false );
$page_one_page = kindori_get_page_opt( 'page_one_page');
$top_bar_phone   = kindori_get_opt('top_bar_phone');
$top_bar_phone_link = kindori_get_opt('top_bar_phone_link');

$social_share_on = kindori_get_opt( 'social_share_on', false );

$top_bar_worktime = kindori_get_opt('top_bar_worktime');
$top_bar_adress = kindori_get_opt('top_bar_adress');

$search_on = kindori_get_opt( 'search_on', false );
if(is_404()) {
    return true;
}
?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout1 <?php if($sticky_on == 1) { echo 'is-sticky'; } ?> <?php if(isset($page_one_page) && $page_one_page) { echo 'active-menu-onepage'; }?>">
        <div id="site-topbar" class="site-topbar">
            <div class="container">
                <div class="inner-container">
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
                    
                    <?php if ( !empty($top_bar_worktime) ) : ?>
                        <div class="item-time">
                            <i class="material zmdi zmdi-hourglass-alt"></i>
                            <span class="info-text"><?php echo wp_kses_post($top_bar_worktime); ?></span>
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
                    <div class="site-branding site-branding-mobile">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <div class="site-navigation">
                        <nav class="main-navigation">
                            <?php get_template_part( 'template-parts/header-menu' ); ?>
                        </nav>
                    </div>
                    <?php if (class_exists('ReduxFramework')) { ?>
                        <div class="site-header-right">
                            <?php if($search_on) : ?>
                                <div class="site-header-item site-header-search">
                                    <span class="h-btn-search">
                                        <i class="flaticon3 flaticon3-search-icon"></i>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <div id="main-menu-mobile">
                                <span class="btn-nav-mobile open-menu">
                                    <span></span>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>