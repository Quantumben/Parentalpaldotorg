<?php

class ETC_CmsImagesGallery_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_images_gallery';
    protected $title = 'Image Gallery';
    protected $icon = 'eicon-slider-push';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/kindori\/wp-content\/themes\/kindori\/elementor\/templates\/widgets\/cms_images_gallery\/layout-image\/layout1.jpg"}}}]},{"name":"content_list","label":"Images Item","tab":"content","controls":[{"name":"images_gallery","label":"Add Item","type":"repeater","controls":[{"name":"image","label":"Image","type":"media","label_block":true}]},{"name":"thumbnail","label":"Image Size","type":"image-size","control_type":"group","default":"full"}]},{"name":"section_carousel_settings","label":"Carousel Settings","tab":"settings","controls":[{"name":"arrows","label":"Show Arrows","type":"switcher"},{"name":"show_thumbnail","label":"Show Thumbnail","type":"switcher"},{"name":"pause_on_hover","label":"Pause on Hover","type":"switcher"},{"name":"autoplay","label":"Autoplay","type":"switcher"},{"name":"autoplay_speed","label":"Autoplay Speed","type":"number","default":5000,"condition":{"autoplay":"true"}},{"name":"infinite","label":"Infinite Loop","type":"switcher"},{"name":"speed","label":"Animation Speed","type":"number","default":500},{"name":"nav","label":"Nav Slides To Show","type":"select","options":{"1":"1","2":"2","3":"3","4":"4","5":"5","6":"6"},"default":"3","condition":{"layout":["1","2","3"]}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','cms-post-carousel-widget-js' );
}