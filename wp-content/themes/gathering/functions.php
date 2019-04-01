<?php
	// includes all flags for certain theme support
	include('includes/theme-support.php');

	// includes all of the default powderkeg functions and functionality
	include('pk/functions.php');


	add_action( 'init', 'pk_set_vars' );
	function pk_set_vars() {
		// We have a lot of options and ACF loads EACH field as a separate MySQL call.
		pk_set_acf_options();

		// enable customer login logo
		pk_set('pk-login-logo', 'images/logo.png');

		//Google Maps API key
		//pk_set('maps_api', 'AIzaSyBQlTwdC002r_bD5zQr1wlGf-iCJ_yfC8o');

	}

	/**
	 * Setup our sitewide ACF options as a transient
	 */
	function pk_set_acf_options(){
		
		$options = get_transient( 'pk_acf_options' );

		if( empty( $options ) ) {
			$options = get_fields('options');

			set_transient( 'pk_acf_options', $options, MONTH_IN_SECONDS );
		}

		pk_set('options', $options);
	}


	// Since we are using transients for our options we need to make sure to update our transient any time the ACF options page is updated
	add_action('acf/save_post', 'pk_update_options_transient', 20);
	function pk_update_options_transient() {
		$screen = get_current_screen();
		if (strpos($screen->id, "acf-options-website-options") == true) {
			//the options will update themselves. We just need to clear out our old transient
			delete_transient('pk_acf_options');
		}
	}

	add_action( 'after_setup_theme', 'pk_set_image_sizes' );
	function pk_set_image_sizes() {
		// image sizes
		#add_image_size('extra-large', 1900, 1400, false);
		#add_image_size('image-960-480c', 960, 480, true);
	}

	// front end scripts/css
	add_action('wp_enqueue_scripts', 'pk_theme_enqueue_scripts', 9999);
	function pk_theme_enqueue_scripts() {

		// javascript
		wp_enqueue_script('jquery');

		// lazy load 
		wp_enqueue_script('lazyload', '//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.min.js', 'jQuery');
		wp_enqueue_script('lazyload.plugins', '//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.plugins.min.js', array('jQuery', 'lazyload'));


		if(ENVIRONMENT != 'dev') {
			wp_enqueue_style('live', get_stylesheet_directory_uri() . '/styles/live.css', array(), filemtime(get_stylesheet_directory().'/styles/live.css'));
			wp_enqueue_script('jquery.site', get_stylesheet_directory_uri() . '/js/live.js', 'jQuery', filemtime(get_stylesheet_directory().'/js/live.js'), true);
		} else {
			wp_enqueue_style('dev', get_stylesheet_directory_uri().'/styles/dev.css', array(), time());
			wp_enqueue_script('jquery.site', get_stylesheet_directory_uri().'/js/dev.js', 'jQuery', time(), true);
		}

	}

	//putting Googlt Fonts in the footer improves pagespeed rankings
	add_action('get_footer', 'pk_theme_enqueue_fonts', 10);
	//if you are noticing a brief delay before fonts loads (usually when loading multiple fonts) you can load in the header to prevent flash, but take a hit on pagespeed rankings
	//add_action('get_header', 'pk_theme_enqueue_fonts', 10);
	function pk_theme_enqueue_fonts() {
		// Import Google Web Fonts
		$fonts = array(
				'Open Sans' => '400,400i,700',
				'Work Sans' => '200,300,700'
			);

		pk_webfont($fonts);
	}

	//Change "posts" name to "Blog Posts"
	add_filter('pk_change_post_label','pk_return_post_label');
	function pk_return_post_label(){
		return 'Blog Post';
	}

	// REGISTER our posts types
	add_action('init', 'pk_register_cpts');
	function pk_register_cpts() {
		pk_register_cpt(array('name' => 'party', 'icon' => 'dashicons-groups', 'position' => 30, 'public' => false, 'exclude_from_search' => true ));

	}

	//Update the default Gravity Forms AJAX spinner
	//add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
	function spinner_url( $image_src, $form ) {
		return pk_img_path().'loading.svg';
	}

	//Give ACF access to our Google API Key
	/*
	add_filter('acf/settings/google_api_key', function () {
		return pk_get('maps_api');
	});
	*/