(function($) {
    "use strict";

    $( window ).on( 'elementor/frontend/init', function() {
		var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
		
		_elementor.hooks.addFilter( 'etc-custom-section-classes', function( settings ) {
			let custom_classes = [];
			if(typeof settings.custom_style != 'undefined' && settings.custom_style != ''){
				custom_classes.push('style-' + settings.custom_style);
			}

        	return custom_classes;
		} );

		_elementor.hooks.addFilter( 'etc-custom-column-classes', function( settings ) {
			
			let custom_classes = [];
			if(typeof settings.custom_style != 'undefined' && settings.custom_style != ''){
				custom_classes.push('style-' + settings.custom_style);
			}

        	return custom_classes;
		} );
    } );
}(jQuery));