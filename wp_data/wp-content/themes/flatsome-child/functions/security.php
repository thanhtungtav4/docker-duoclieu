<?php
	add_filter('pings_open', '__return_false', 20, 2);
	// Disable WordPress XMLRPC.php
	add_filter( 'xmlrpc_enabled', '__return_false' );

	add_action ('init', function () {
		global $pagenow; // get current page
		if (!empty($pagenow) && ( $pagenow === 'xmlrpc.php' || $pagenow === 'wp-trackback.php' || $pagenow === 'wp-links-opml.php' || $pagenow === 'license.txt' || $pagenow === 'readme.html')) {
				get_template_part(404);
				exit();
			}
				return;
		});
	add_filter( 'wp_headers', 'yourprefix_remove_x_pingback' );
	function yourprefix_remove_x_pingback( $headers )
	{
		unset( $headers['X-Pingback'] );
		return $headers;
	}

	function disable_xmlrpc_ping ($methods) {
		unset( $methods['pingback.ping'] );
		return $methods;
	}
	add_filter( 'xmlrpc_methods', 'disable_xmlrpc_ping');

	// !redirect your xmlrpc.php request to 404

	// Disable /users rest routes
		add_filter('rest_endpoints', function( $endpoints ) {
			if ( isset( $endpoints['/wp/v2/users'] ) ) {
					unset( $endpoints['/wp/v2/users'] );
			}
			if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
					unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
			}
			return $endpoints;
		});
	// !Disable /users rest routes

	// Remove WordPress Version Information
	remove_action('wp_head', 'wp_generator');

	// Remove WLManifest Link
	remove_action( 'wp_head', 'wlwmanifest_link' ) ;
	// !Remove WLManifest Link
	// Remove pingback link
	remove_action( 'wp_head', 'wp_pingback' );
	// Disable X-Pingback HTTP Header.
	// Disable XMLRPC by hijacking and blocking the option.
	add_filter('pre_option_enable_xmlrpc', function($state){
		return '0'; // return $state; // To leave XMLRPC intact and drop just Pingback
	});
	// Remove rsd_link from filters (<link rel="EditURI" />).
	add_action('wp', function(){
		remove_action('wp_head', 'rsd_link');
	}, 9);

