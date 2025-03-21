<?php
$default_settings = [
    'col_xl' => '4',
    'col_lg' => '4',
    'col_md' => '3',
    'col_sm' => '2',
    'col_xs' => '1',

    'content_list' => '',
    'thumbnail_size' => '',
    'thumbnail_custom_dimension' => '',
    'cms_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$col_xl = 12 / intval($col_xl);
$col_lg = 12 / intval($col_lg);
$col_md = 12 / intval($col_md);
$col_sm = 12 / intval($col_sm);
$col_xs = 12 / intval($col_xs);
$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
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
    <div class="cms-grid cms-team-grid1">
        <div class="cms-grid-inner cms-grid-masonry row" data-gutter="7">
            <?php foreach ($content_list as $key => $value):
            	$link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
            	if ( ! empty( $value['link']['url'] ) ) {
    			    $widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

    			    if ( $value['link']['is_external'] ) {
    			        $widget->add_render_attribute( $link_key, 'target', '_blank' );
    			    }

    			    if ( $value['link']['nofollow'] ) {
    			        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
    			    }
    			}
    			$link_attributes = $widget->get_render_attribute_string( $link_key );
    			$title = isset($value['title']) ? $value['title'] : '';
                $position = isset($value['position']) ? $value['position'] : '';
    			
                $image = isset($value['image']) ? $value['image'] : '';
    			$img = etc_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $social = isset($value['social']) ? $value['social'] : '';
            	?>
                <div class="<?php echo esc_attr($item_class); ?>">
                    <div class="team-item">
                        <div class="item--inner <?php echo esc_attr($cms_animate); ?>">
                            <?php if(!empty($image)) { ?>
                                <div class="item--image">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php } ?>
                            <div class="item-holder">
                                <?php if(!empty($title)) { ?>
                                    <h3 class="item--title">    
                                        <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                            <?php echo esc_attr($title); ?>
                                        </a>
                                    </h3>
                                <?php } ?>
                                <?php if(!empty($position)) { ?>
                                    <div class="item--position"><?php echo esc_attr($position); ?></div>
                                <?php } ?>
                                <?php if(!empty($social)):?>
                                    <div class="item--social">
                                        <div class="inner-social">
                                            <?php if(!empty($social)):
                                                $team_social = json_decode($social, true);
                                                foreach ($team_social as $value): ?>
                                                    <a href="<?php echo esc_url($value['url']); ?>">
                                                        <i class="<?php echo esc_attr($value['icon']); ?>"></i>
                                                    </a>
                                                <?php endforeach;
                                            endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        </div>
    </div>
<?php endif; ?>
