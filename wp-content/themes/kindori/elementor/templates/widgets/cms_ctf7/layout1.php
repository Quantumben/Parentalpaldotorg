<?php
$default_settings = [
    'ctf7_id'          => '',
    'ctf7_title'       => '',
    'ctf7_description' => '',
    'button_style'     => 'button-style1',
    'style'     => 'style1',
    'cms_animate' => '',
];

$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

if(class_exists('WPCF7') && !empty($ctf7_id)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-contact-form layout1">
        <div class="cms-contact-form-inner <?php echo esc_attr( $style); ?> <?php echo esc_attr($cms_animate); ?>">
            <div class="col-inner-box <?php echo esc_attr( $button_style); ?>">
                <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $ctf7_id ).'"]'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>