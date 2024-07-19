<?php
$default_settings = [
    'label1' => '',
    'label2' => '',
    'label3' => '',
    'label4' => '',

    'content_list' => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<div class="cms-pricing-layout1 <?php echo esc_attr($cms_animate); ?>">
	<div class="cms-pricing-inner">
        <div class="price-label">
                <label class="labe-tlte-1"><?php echo esc_attr($label1); ?></label>
                <label class="labe-tlte-2"><?php echo esc_attr($label2); ?></label>
                <label class="labe-tlte-3"><?php echo esc_attr($label3); ?></label>
                <label class="labe-tlte-4"><?php echo esc_attr($label4); ?></label>
        </div>
        <div class="list-item">
            <?php if(isset($settings['content_list']) && !empty($settings['content_list']) && count($settings['content_list'])): ?>
                    <?php
                        foreach ($settings['content_list'] as $key => $cms_list): ?>
                        <ul class="cms-pricing-item">
                            <li>
                                <label class="labe-tlte-1"><?php echo esc_attr($label1); ?></label>
                                <?php echo esc_html($cms_list['content_title'])?>
                            </li>
                            <li>
                                <label class="labe-tlte-2"><?php echo esc_attr($label2); ?></label>
                                <?php echo esc_html($cms_list['price_daily'])?>
                            </li>
                            <li>
                                <label class="labe-tlte-3"><?php echo esc_attr($label3); ?></label>
                                <?php echo esc_html($cms_list['price_weekly'])?>
                            </li>
                            <li>
                                <label class="labe-tlte-4"><?php echo esc_attr($label4); ?></label>
                                <?php echo esc_html($cms_list['price_monthly'])?>
                            </li>
                        </ul>
                    <?php endforeach; ?>
            <?php endif; ?>
        </div>
	</div>
</div>