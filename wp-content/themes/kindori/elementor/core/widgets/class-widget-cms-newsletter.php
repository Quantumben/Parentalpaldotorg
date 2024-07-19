<?php

class ETC_CmsNewsletter_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_newsletter';
    protected $title = 'Newsletter';
    protected $icon = 'eicon-envelope';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Color Settings","tab":"style","controls":[{"name":"email_label","label":"Email Label","type":"text"},{"name":"button_label","label":"Button Label","type":"text","rows":10,"show_label":false},{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1","style2":"Style 2"},"default":"style1"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}