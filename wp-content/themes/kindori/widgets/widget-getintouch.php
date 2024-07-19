<?php
class CMS_GetInTouch_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cms_textbox_widget',
            esc_html__('* Get In Touch', 'kindori'),
            array('description' => esc_html__('Get In Touch Widget', 'kindori'),)
        );
    }

    function widget($args, $instance) {

        extract($args);

        $title = isset($instance['title']) ? (!empty($instance['title']) ? $instance['title']: '') : '';
        $excerpt_text = isset($instance['excerpt_text']) ? (!empty($instance['excerpt_text']) ? $instance['excerpt_text']: '') : '';

        $phone_text = isset($instance['phone_text']) ? (!empty($instance['phone_text']) ? $instance['phone_text']: '') : '';
        $phone_text_href = str_replace(array( ' ','+' ), '', $phone_text);
        $fax_text = isset($instance['fax_text']) ? (!empty($instance['fax_text']) ? $instance['fax_text']: '') : '';
        $mail_text = isset($instance['mail_text']) ? (!empty($instance['mail_text']) ? $instance['mail_text']: '') : '';
        $address_text = isset($instance['address_text']) ? (!empty($instance['address_text']) ? $instance['address_text']: '') : '';
        $address_text_url = "http://maps.google.com/?q=".$address_text;
        $bottom_title = isset($instance['bottom_title']) ? (!empty($instance['bottom_title']) ? $instance['bottom_title']: '') : '';
        $btn_title_url = isset($instance['btn_title_url']) ? (!empty($instance['btn_title_url']) ? $instance['btn_title_url']: '') : '';
        ?>
        <div class="widget cms-get-in-touch">
            <div class="widget-content">
                <?php if(!empty($title)) : ?>
                    <h2 class="widget-title"><?php echo wp_kses_post(nl2br($title)); ?></h2>
                <?php endif; ?>
                <?php if(!empty($excerpt_text)): ?>
                    <div class="cms-contact-excerpt">
                            <?php echo wp_kses_post( $excerpt_text  ); ?>
                    </div>
                <?php endif; ?>
                <div class="cms-contact-info-inner">
                    <?php if(!empty($phone_text)): ?>
                        <div class="cms-contact-info-item type-phone">
                            <a href="tel:<?php echo esc_attr( $phone_text_href ); ?>">
                                <i class="material zmdi zmdi-phone"></i><?php echo wp_kses_post( $phone_text  ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($fax_text)): ?>
                        <div class="cms-contact-info-item type-fax">
                            <?php echo wp_kses_post( $fax_text  ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($mail_text)): ?>
                        <div class="cms-contact-info-item type-email">
                            <a href="mailto:<?php echo esc_attr( $mail_text ); ?>">
                                <i class="material zmdi zmdi-email-open"></i><?php echo wp_kses_post( $mail_text  ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($address_text)): ?>
                        <div class="cms-contact-info-item type-address">
                                <a href="<?php echo esc_url($address_text_url); ?>" target="_blank">
                                    <i class="fas fa-map-marker-alt"></i><?php echo wp_kses_post( $address_text  ); ?>
                                </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($bottom_title)){ ?>
                    <h4 class="bottom-title">
                        <?php if(!empty($btn_title_url)): ?><a href="<?php echo esc_url($btn_title_url); ?>" target="_blank"><?php endif; ?>
                            <?php echo esc_attr( $bottom_title  ); ?>    
                        <?php if(!empty($btn_title_url)): ?></a><?php endif; ?>
                    </h4>
                <?php }?>
            </div>
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['excerpt_text'] = strip_tags($new_instance['excerpt_text']);

        $instance['phone_text'] = strip_tags($new_instance['phone_text']);
        $instance['fax_text'] = strip_tags($new_instance['fax_text']);
        $instance['mail_text'] = strip_tags($new_instance['mail_text']);
        $instance['address_text'] = strip_tags($new_instance['address_text']);
        $instance['bottom_title'] = strip_tags($new_instance['bottom_title']);
        $instance['btn_title_url'] = strip_tags($new_instance['btn_title_url']);
        

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $excerpt_text = isset($instance['excerpt_text']) ? esc_attr($instance['excerpt_text']) : '';

        $phone_text = isset($instance['phone_text']) ? esc_attr($instance['phone_text']) : '';
        $fax_text = isset($instance['fax_text']) ? esc_attr($instance['fax_text']) : '';
        $mail_text = isset($instance['mail_text']) ? esc_attr($instance['mail_text']) : '';
        $address_text = isset($instance['address_text']) ? esc_attr($instance['address_text']) : '';
        $bottom_title = isset($instance['bottom_title']) ? esc_attr($instance['bottom_title']) : '';
        $btn_title_url = isset($instance['btn_title_url']) ? esc_attr($instance['btn_title_url']) : '';
        

        ?>
        <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title', 'kindori' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" rows="3" cols="50"/><?php echo esc_attr( $title ); ?></textarea>
            </p>

        <p><label for="<?php echo esc_url($this->get_field_id('excerpt_text')); ?>"><?php esc_html_e( 'Description', 'kindori' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_text') ); ?>" rows="4" cols="50"/><?php echo esc_attr( $excerpt_text ); ?></textarea>
            </p>


        <p><label for="<?php echo esc_url($this->get_field_id('phone_text')); ?>"><?php esc_html_e( 'Phone Text', 'kindori' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('phone_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('phone_text') ); ?>" type="text" value="<?php echo esc_attr( $phone_text ); ?>" /></p>


        <p><label for="<?php echo esc_url($this->get_field_id('fax_text')); ?>"><?php esc_html_e( 'Fax Text', 'kindori' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('fax_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('fax_text') ); ?>" type="text" value="<?php echo esc_attr( $fax_text ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('mail_text')); ?>"><?php esc_html_e( 'Mail Text', 'kindori' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('mail_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('mail_text') ); ?>" type="text" value="<?php echo esc_attr( $mail_text ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('address_text')); ?>"><?php esc_html_e( 'Address Text', 'kindori' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('address_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('address_text') ); ?>" type="text" value="<?php echo esc_attr( $address_text ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('bottom_title')); ?>"><?php esc_html_e( 'Bottom Title', 'kindori' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('bottom_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('bottom_title') ); ?>" type="text" value="<?php echo esc_attr( $bottom_title ); ?>" />
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('btn_title_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('btn_title_url') ); ?>" type="text" value="<?php echo esc_attr( $btn_title_url ); ?>" />
        </p>
        <?php
    }

}

function register_getintouch_widget() {
    global $wp_widget_factory;
    $wp_widget_factory->register( 'CMS_GetInTouch_Widget' );
}
add_action('widgets_init', 'register_getintouch_widget'); ?>