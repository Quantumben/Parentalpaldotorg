<?php
    $footer_layout_custom = kindori_get_opt('footer_layout_custom');
    $custom_footer = kindori_get_page_opt('custom_footer', 'false');
    $footer_layout_custom_page = kindori_get_page_opt('footer_layout_custom');
    if($custom_footer && !empty($footer_layout_custom_page) ) {
        $footer_layout_custom = $footer_layout_custom_page;
    }
?>
<footer id="colophon" class="site-footer-custom">
    <?php if(!empty($footer_layout_custom)) :  ?>
        <div class="footer-custom-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php $post = get_post($footer_layout_custom);
                        if (!is_wp_error($post) && $post->ID == $footer_layout_custom && class_exists('Elementor_Theme_Core') && function_exists('etc_print_html')){
                            $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_layout_custom );
                            etc_print_html($content);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>