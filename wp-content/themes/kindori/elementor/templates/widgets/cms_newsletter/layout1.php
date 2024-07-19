<?php
$default_settings = [
    'button_label' => '',
    'email_label' => '',
    'style' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);
if(class_exists('Newsletter')) : 
	$newsletter = Newsletter::instance();
	?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-newsletter <?php echo esc_attr($style); ?>">
	    <form class="tnp-form" action="<?php echo esc_url($newsletter->build_action_url('s')); ?>" method="post" onsubmit="return newsletter_check(this)">
	    	<input type="hidden" name="nr" value="widget-minimal"/>
	    	<div class="tnp-field tnp-field-email">
	    		<input class="tnp-email" type="email" required name="ne" value="" placeholder="<?php if(!empty($email_label)) { echo esc_attr($email_label); } else { echo esc_html__('Your Email Address', 'kindori'); } ?>">
	    	</div>
	    	<div class="tnp-field tnp-field-button">
	    		<input class="tnp-button" type="submit" value="<?php if(!empty($button_label)) { echo esc_attr($button_label); } else { echo esc_html__('Subscribe', 'kindori'); } ?>">
	    	</div>
	    </form>
    </div>
<?php endif; ?>
