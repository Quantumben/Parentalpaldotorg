<?php
    $default_settings = [
        'cms_animate' => '',
    ];
    $settings = array_merge($default_settings, $settings);
    extract($settings);

    $widget->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation'] );
    $icon_tag = 'span';

    $icon_attributes = $widget->get_render_attribute_string( 'icon' );
    $has_heading = ! empty( $settings['heading_text'] );
    $widget->add_inline_editing_attributes( 'heading_text', 'none' );

    $html_id = etc_get_element_id($settings);
    $tax = array();
    $source = $widget->get_setting('source', '');
    $orderby = $widget->get_setting('orderby', 'date');
    $order = $widget->get_setting('order', 'desc');
    $limit = $widget->get_setting('limit', 6);
    $post_ids = $widget->get_setting('post_ids', '');
    extract(etc_get_posts_of_grid('cmsevents', [
        'source' => $source,
        'orderby' => $orderby,
        'order' => $order,
        'limit' => $limit,
        'post_ids' => $post_ids,
    ]));

    $thumbnail_size = $widget->get_setting('thumbnail_size', '');
    $thumbnail_custom_dimension = $widget->get_setting('thumbnail_custom_dimension', '');
    $title_tag = $widget->get_setting('title_tag', 'h3');
    $pagination_type = $widget->get_setting('pagination_type', 'pagination');
    $show_thumbnail = $widget->get_setting('show_thumbnail', 'pagination');

    $load_more = array(
        'posttype' => 'cmsevents',
        'startPage' => $paged,
        'maxPages'  => $max,
        'total'     => $total,
        'perpage'   => $limit,
        'source' => $source,
        'order' => $order,
        'limit' => $limit,

        'thumbnail_size'  => $thumbnail_size,
        'thumbnail_custom_dimension'  => $thumbnail_custom_dimension,
        'title_tag' => $title_tag,
        'show_thumbnail' => $show_thumbnail,
        'template_type' => 'cmsevents_list_layout1',
    );
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-cmsevents-list <?php echo esc_attr($cms_animate); ?>">
    <div class="inner-layout">
        <div class="class-el-title">
            <?php if ( $has_heading ) : ?>
                <<?php etc_print_html($settings['heading_size']); ?> class="custom-heading">
                    <<?php echo implode( ' ', [ $icon_tag ] ); ?>
                        <?php etc_print_html($widget->get_render_attribute_string( 'heading_text' )); ?>>
                        <?php echo wp_kses_post($settings['heading_text']); ?></<?php etc_print_html($icon_tag); ?>>
                </<?php etc_print_html($settings['heading_size']); ?>>
            <?php endif; ?>
        </div>
        <div class="class-list-item">
            <?php
            $load_more['tax'] = $tax;
            kindori_get_post_grid($posts, $load_more);
            ?>
        </div>
    </div>
</div>