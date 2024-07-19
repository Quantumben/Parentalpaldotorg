<?php
$default_settings = [
    'content_list' => '',
    'thumbnail_size' => '',
    'thumbnail_custom_dimension' => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = 'full';
}

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
    <div class="cms-testimonial-list">
        <div class="cms-grid-inner">
            <?php foreach ($content_list as $key => $value):
    			$title = isset($value['title']) ? $value['title'] : '';
                $position = isset($value['position']) ? $value['position'] : '';
                $description = isset($value['description']) ? $value['description'] : '';
                $style_star = isset($value['style_star']) ? $value['style_star'] : '';
    			$image = isset($value['image']) ? $value['image'] : '';
    			$img = etc_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
            	?>
                <div class="testimonial-item <?php echo esc_attr($cms_animate); ?>">
                    
                    <div class="item-inner">
                        <span class="arrow-quote">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                             width="28.000000pt" height="18.000000pt" viewBox="0 0 28.000000 18.000000"
                             preserveAspectRatio="xMidYMid meet">

                            <g transform="translate(0.000000,18.000000) scale(0.100000,-0.100000)" stroke="none">
                            <path d="M39 166 c-44 -22 -35 -106 12 -106 30 0 22 -20 -11 -27 -33 -6 -46
                            -18 -31 -28 16 -9 77 21 95 46 19 28 21 92 4 106 -24 18 -45 21 -69 9z"/>
                            <path d="M188 166 c-43 -22 -33 -106 13 -106 30 0 22 -20 -11 -27 -33 -6 -46
                            -18 -31 -28 14 -8 73 18 92 41 55 64 7 155 -63 120z"/>
                            </g>
                            </svg>
                        </span>
                        <div class="item-holder">
                            <?php if(!empty($image)) { ?>
                                <div class="item-image">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php } ?>
                            <?php if(!empty($title) || !empty($position)) { ?>
                                <div class="item-meta">
                                    <?php if(!empty($title)) { ?>
                                        <h3 class="item-name">    
                                            <?php echo esc_attr($title); ?>
                                        </h3>
                                    <?php } ?>
                                    <?php if(!empty($position)) { ?>
                                        <div class="item-position"><?php echo esc_attr($position); ?></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <span class="item-star <?php echo esc_attr( $style_star ); ?>">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                        </div>
                        <?php if(!empty($description)) { ?>
                            <div class="item-description"><?php echo esc_attr($description); ?></div>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
