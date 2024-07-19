<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Kindori
 */
$image_404 = kindori_get_opt( 'img_404' );
$title_404 = kindori_get_opt( 'title_404' );
$content_404_page = kindori_get_opt( 'content_404_page' );
$btn_text_404_page = kindori_get_opt( 'btn_text_404_page' );
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="row">
                <div class="col-12">
                    <section class="error-404 bg-overlay bg-image">
                        <div class="error-404-inner">
                            <div class="img-404">
                                <?php if(!empty($image_404['url'])) { ?>
                                    <img class="img-404" src="<?php echo esc_url($image_404['url']);?>" alt="<?php echo esc_attr( $title_404 ); ?>" />
                                <?php } ?>
                            </div>
                            <?php if(!empty($title_404)) { ?>
                                <h2 class="title-404">
                                    <?php echo wp_kses_post($title_404);?>
                                </h2>
                            <?php } else { ?>
                                <h2 class="title-404">
                                    <?php echo esc_html__('OOPS! Page Not Found!', 'kindori');?>
                                </h2> 
                            <?php } ?>
                            <div class="page-content">
                                <?php if(!empty($content_404_page)) {
                                    echo wp_kses_post($content_404_page);
                                } else {
                                    echo esc_html__('The page you are looking is not available or has been removed. Try going to Home Page by using the button below.', 'kindori');
                                } ?>
                            </div><!-- .page-content -->
                            <a class="btn btn-default" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php if(!empty($btn_text_404_page)) {
                                    echo wp_kses_post($btn_text_404_page);
                                } else {
                                    echo esc_html__('Back To Home', 'kindori');
                                } ?>   
                            </a>
                        </div>
                    </section><!-- .error-404 -->
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
