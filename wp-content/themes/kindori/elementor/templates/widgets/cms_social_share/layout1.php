<?php
$default_settings = [
    'label_social' => '',
    'cms_animate' => '',
    
    'show_facebook' => '',
    'show_twiter' => '',
    'show_gg' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<div class="cms-social-share <?php echo esc_attr($cms_animate); ?>">
    <div class="entry-label">
        <?php if(!empty($label_social)) { ?>
            <?php echo esc_attr($label_social); ?>
        <?php } 
        	else { ?>
        		<?php echo esc_html__( 'Share:', 'kindori' ); ?>
        <?php } ?>
    </div>
    <ul class="entry-socail">
        <?php if($settings['show_facebook'] == 'true'): ?>
            <li>
                <a class="fb-social hover-effect" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if($settings['show_twiter'] == 'true'): ?>
            <li>
                <a class="tw-social hover-effect" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>">
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if($settings['show_gg'] == 'true'): ?>
            <li>
                <a class="g-social hover-effect" title="Google Plus" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                    <i class="fa fa-google-plus"></i>
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
