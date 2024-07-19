<?php
$time_to = $settings['time_to'];
?>
<div class="cms-count-down layout1 <?php echo esc_attr($cms_animate); ?>">
    <div class="cms-count-down-container font-smooth" data-time="<?php echo esc_attr($time_to); ?>">
        <div class="time-item">
            <div class="time-item-inner">
                <div class="day inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Days', 'kindori') ?></div>
            </div>
        </div>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="hour inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Hours', 'kindori') ?></div>
            </div>
        </div>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="minute inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Minutes', 'kindori') ?></div>
            </div>
        </div>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="second inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Seconds', 'kindori') ?></div>
            </div>
        </div>
    </div>
</div>
