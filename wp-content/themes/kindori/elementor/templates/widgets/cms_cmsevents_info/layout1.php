<?php
$default_settings = [
    'cmsevents_price' => '',
    'cmsevents_student' => '',
    'cmsevents_phone' => '',
    'cmsevents_time' => '',
    'cmsevents_email' => '',
    'cmsevents_startday' => '',
    'cmsevents_endday' => '',
    'cmsevents_location' => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<div class="cms-cmsevents-info">
    <div class="inner-layout">
        <?php if ( $cmsevents_price ) { ?>
            <div class="class-el-title">
                <?php echo esc_html__( 'Price:', 'kindori' ) ?>
                <span><?php echo esc_attr($cmsevents_price); ?></span>
                <?php echo esc_html__( '/Day', 'kindori'  ) ?>
            </div>
        <?php } ?>
        <ul class="cmsevents-list">
            <?php if ( $cmsevents_student ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="fas fa-users"></i><?php echo esc_html__( 'Organizer Name:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_student); ?>
               </li>
            <?php } ?>
            <?php if ( $cmsevents_phone ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="fal fa-phone"></i><?php echo esc_html__( 'Phone:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_phone); ?>    
               </li>
            <?php } ?>
            <?php if ( $cmsevents_email ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="fas fa-envelope"></i><?php echo esc_html__( 'Email:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_email); ?>    
               </li>
            <?php } ?>
            <?php if ( $cmsevents_startday ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="far fa-calendar-alt"></i><?php echo esc_html__( 'Start day:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_startday); ?>    
               </li>
            <?php } ?>
            <?php if ( $cmsevents_endday ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="far fa-calendar-alt"></i><?php echo esc_html__( 'End day:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_endday); ?>    
               </li>
            <?php } ?>
            <?php if ( $cmsevents_time ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="far fa-clock"></i><?php echo esc_html__( 'Time:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_time); ?>    
               </li>
            <?php } ?>
            <?php if ( $cmsevents_location ) { ?>
                <li class="cmsevents-item-info">
                    <label><i class="fas fa-layer-group"></i><?php echo esc_html__( 'Location:', 'kindori' ) ?></label><?php echo esc_attr($cmsevents_location); ?>    
               </li>
            <?php } ?>
        </ul>
    </div>
</div>

