<?php
$default_settings = [
    'cms_animate' => '',
    'title_text' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$time_to = $settings['time_to'];
?>
<div class="cms-count-down layout2 <?php echo esc_attr($cms_animate); ?>">
    <div class="item-box-title">
        <?php if(!empty($time_to)) : ?>
            <div class="item-date-feature">                
                <?php echo esc_html( date('F d, Y', strtotime($time_to)) ); ?>
                <?php echo esc_html__( 'at','kindori' ); ?>
                <?php echo esc_html( date('H:i A', strtotime($time_to)) ); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($settings['title_text'])) : ?>
            <h3 class="item--title">
                <?php echo esc_html($settings['title_text']); ?>
            </h3>
        <?php endif; ?>
    </div>
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
