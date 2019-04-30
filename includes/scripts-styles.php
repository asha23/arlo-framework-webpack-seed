<?php


//==============================================================================
// SCRIPTS & ENQUEUEING
//==============================================================================







function seed_scripts_and_styles() {
	global $wp_styles;


	if (!is_admin()) {

		// Load asset manifest
		$assetstr = file_get_contents(dirname(dirname(__FILE__))."/build/manifest.json");
		$assets = json_decode($assetstr, true);
		$assets     = array(
			'css' => '/build/css/styles.css' . '?' . $assets['build/css/styles.css']['hash'],
			'vendor-scripts' => '/build/js/vendor.js' . '?' . $assets['build/js/vendor.js']['hash'],
			'js'  => '/build/js/app.js' . '?' . $assets['build/js/app.js']['hash'],
		);

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, '1.11.3', true);
		wp_register_style( 'styles', get_stylesheet_directory_uri() . $assets['css'], array(), '', 'all' );
		wp_register_script( 'vendor', get_stylesheet_directory_uri() . $assets['vendor-scripts'], array(), '', true );
		wp_register_script( 'scripts', get_stylesheet_directory_uri() . $assets['js'], array(), '', true );
		wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/build/js/modernizr-bundle.js', array(), '', true );

		wp_register_script( 'createjs', '//code.createjs.com/createjs-2015.11.26.min.js', array(), '', true );
		wp_register_script( 'version6', get_stylesheet_directory_uri() . '/legacy-scripts/js/version6.js', array(), '', true );
		wp_register_script( 'general', get_stylesheet_directory_uri() . '/legacy-scripts/js/general.js', array(), '', true );
		wp_register_script( 'remodal', get_stylesheet_directory_uri() . '/legacy-scripts/js/remodal.js', array(), '', true );
		wp_register_script( 'jquery-ui', get_template_directory_uri() . '/legacy-scripts/js/jquery-ui.min.js', array(), '', true );
		wp_register_script( 'scrollto', get_template_directory_uri() . '/legacy-scripts/js/jquery.scrollTo-min.js', array(), '', true );
		wp_register_script( 'touchswipe', get_template_directory_uri() . '/legacy-scripts/js/jquery.touchSwipe.min.js', array(), '', true );
		wp_register_script( 'smoothscroll', get_template_directory_uri() . '/legacy-scripts/js/SmoothScroll.min.js', array(), '', true );

		wp_register_style( 'animation', get_stylesheet_directory_uri() . '/legacy-scripts/css/styles.css', '', 'all' );

		// Do it.
		wp_enqueue_script( 'scripts' );
		wp_enqueue_style( 'styles' );
		//wp_enqueue_script( 'modernizr' );
		wp_enqueue_script('vendor');

		if ( is_page('our-processes') || is_page('mission-control') ): 

			wp_enqueue_script( 'jquery-ui' );
			wp_enqueue_script( 'scrollto' );
			wp_enqueue_script( 'touchswipe' );
			wp_enqueue_script( 'smoothscroll' );
			wp_enqueue_script( 'remodal' );
			//wp_enqueue_script( 'version6' );
			wp_enqueue_script( 'general' );

			wp_enqueue_style( 'animation' );

		endif;

		if ( is_page('home')) :
			wp_enqueue_style( 'animation' );
		endif;

		
		

	}
}


add_action( 'wp_enqueue_scripts', 'seed_scripts_and_styles', 999 );



function remove_gravityforms_style() {
	wp_deregister_style("gforms_formsmain_css"); 	
	wp_deregister_style("gforms_reset_css");
	wp_deregister_style("gforms_ready_class_css");
	wp_deregister_style("gforms_browsers_css");
}
add_action('wp_print_styles', 'remove_gravityforms_style');
