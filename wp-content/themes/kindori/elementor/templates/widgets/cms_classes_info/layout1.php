<?php
$default_settings = [
    'classes_price' => '',
    'classes_student' => '',
    'classes_lectures' => '',
    'classes_time' => '',
    'classes_learnday' => '',
    'classes_language' => '',
    'classes_size' => '',
    'classes_age' => '',

    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<div class="cms-classes-info">
    <div class="inner-layout">
        <?php if ( $classes_price ) { ?>
            <div class="class-el-title">
                <?php echo esc_html__( 'Price:', 'kindori' ) ?>
                <span><?php echo esc_attr($classes_price); ?></span>
                / <?php echo esc_html__( 'Day', 'kindori' ) ?>
            </div>
        <?php } ?>
        <ul class="classes-list">
            <?php if ( $classes_student ) { ?>
                <li class="classes-item-info">
                    <label><i class="fas fa-users"></i><?php echo esc_html__( 'Student: ', 'kindori' ) ?></label><?php echo esc_attr($classes_student); ?>
               </li>
            <?php } ?>
            <?php if ( $classes_lectures ) { ?>
                <li class="classes-item-info">
                    <label><i class="fal fa-file"></i><?php echo esc_html__( 'Lectures: ', 'kindori' ) ?></label><?php echo esc_attr($classes_lectures); ?>    
               </li>
            <?php } ?>
            <?php if ( $classes_time ) { ?>
                <li class="classes-item-info">
                    <label><i class="far fa-clock"></i><?php echo esc_html__( 'Time: ', 'kindori' ) ?></label><?php echo esc_attr($classes_time); ?>    
               </li>
            <?php } ?>
            <?php if ( $classes_learnday ) { ?>
                <li class="classes-item-info">
                    <label><i class="far fa-calendar-alt"></i><?php echo esc_html__( 'Learn day: ', 'kindori' ) ?></label><?php echo esc_attr($classes_learnday); ?>    
               </li>
            <?php } ?>
            <?php if ( $classes_language ) { ?>
                <li class="classes-item-info">
                    <label><i class="fas fa-globe-asia"></i><?php echo esc_html__( 'Language: ', 'kindori' ) ?></label><?php echo esc_attr($classes_language); ?>    
               </li>
            <?php } ?>
            <?php if ( $classes_size ) { ?>
                <li class="classes-item-info">
                    <label><i class="fas fa-sitemap"></i><?php echo esc_html__( 'Size: ', 'kindori' ) ?></label><?php echo esc_attr($classes_size); ?>    
               </li>
            <?php } ?>
            <?php if ( $classes_age ) { ?>
                <li class="classes-item-info">
                    <label><i class="fas fa-layer-group"></i><?php echo esc_html__( 'Age: ', 'kindori' ) ?></label><?php echo esc_attr($classes_age); ?>
               </li>
            <?php } ?>
        </ul>
    </div>
</div>

