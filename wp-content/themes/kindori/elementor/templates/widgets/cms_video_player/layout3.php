<?php 
$default_settings = [
    'overlay_style'   => '',
    'cms_animate'   => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

$widget->add_inline_editing_attributes( 'title_text', 'none' );
?>
<div class="cms-video-player layout3 <?php echo esc_attr($cms_animate); ?>">
    <div class="inner-layout">
        <div class="box-meta">
            <?php if(!empty($settings['video_link'])) : ?>
                <a class="btn-video" href="<?php echo esc_url($settings['video_link']); ?>">
                    <span>
                        <i class="fac fac-play"></i>
                    </span>
                </a>
            <?php endif; ?>
            <?php if(!empty($settings['title_text'])) : ?>
                <h3 class="item--title">
                    <?php echo esc_html($settings['title_text']); ?>
                </h3>
            <?php endif; ?>
        </div>
    </div>
</div>