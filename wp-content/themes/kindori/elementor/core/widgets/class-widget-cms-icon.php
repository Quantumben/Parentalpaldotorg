<?php

class ETC_CmsIcon_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_icon';
    protected $title = 'Icons';
    protected $icon = 'eicon-alert';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"section_icon","label":"Icons","tab":"content","controls":[{"name":"icons","label":"Icons","type":"repeater","controls":[{"name":"cms_icon","label":"Icon","type":"icons","fa4compatibility":"icon","default":{"value":"fas fa-star","library":"fa-solid"}},{"name":"icon_link","label":"Icon Link","type":"url","label_block":true}]},{"name":"color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .cms-icon1 a":"color: {{VALUE}} !important;"}},{"name":"bg_color","label":"Background Color","type":"color","selectors":{"{{WRAPPER}} .cms-icon1 a":"background-color: {{VALUE}} !important;"}},{"name":"color_hover","label":"Color Hover","type":"color","selectors":{"{{WRAPPER}} .cms-icon1 a:hover":"color: {{VALUE}} !important;"}},{"name":"bg_color_hover","label":"Background Color Hover","type":"color","selectors":{"{{WRAPPER}} .cms-icon1 a:hover":"background-color: {{VALUE}} !important;"}}]},{"name":"section_style_content","label":"Content Alignment","tab":"style","controls":[{"name":"text_align","label":"Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"fa fa-align-left"},"center":{"title":"Center","icon":"fa fa-align-center"},"right":{"title":"Right","icon":"fa fa-align-right"}},"selectors":{"{{WRAPPER}} .cms-icon1":"text-align: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}