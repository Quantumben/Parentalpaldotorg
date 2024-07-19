<?php
$titles = kindori_get_page_titles();

$pagetitle = kindori_get_opt( 'pagetitle', 'show' );
$ptitle_layout = kindori_get_opt( 'ptitle_layout', '1' );

$custom_pagetitle = kindori_get_page_opt( 'custom_pagetitle', 'themeoption');
$ptitle_layout_page = kindori_get_page_opt( 'ptitle_layout', '');
if($custom_pagetitle != 'themeoption' && $custom_pagetitle != '') {
    $pagetitle = $custom_pagetitle;
}

if($custom_pagetitle != 'themeoption' && $custom_pagetitle != '' && $ptitle_layout_page != '') {
    $ptitle_layout = $ptitle_layout_page;
}
ob_start();
if ( $titles['title'] )
{
    printf( '<h1 class="page-title">%s</h1>', wp_kses_post($titles['title']) );
}
$titles_html = ob_get_clean();
$ptitle_breadcrumb_on = kindori_get_opt( 'ptitle_breadcrumb_on', 'show' );
if(is_404()) {
    return true;
}
if($pagetitle == 'show') : ?>
    <div id="pagetitle" class="page-title bg-overlay bg-image page-title-layout<?php echo esc_attr($ptitle_layout); ?>">
        <div class="container">
            <div class="page-title-inner">
                
                <div class="page-title-holder">
                    <?php printf( '%s', wp_kses_post($titles_html)); ?>
                </div>

                <?php if($ptitle_breadcrumb_on == 'show') : ?>
                    <?php kindori_breadcrumb(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>