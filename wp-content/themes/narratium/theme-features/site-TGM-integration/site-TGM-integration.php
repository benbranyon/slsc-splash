<?php

/**
* We include the TGM class file
*/
require_once("class-tgm-plugin-activation.php");



/**
 * Register the required plugins for this theme.
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
*/
function KTT_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


	    /**
	    * We recommend installing the plug-in Market
	    */
			array(
            'name' => 'Envato Market',
            'slug' => 'envato-market',
            'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
            'required' => true,
            'recommended' => true,
            'force_activation' => true,
      ),

			array(
				'name'   => 'Kohette Pagestree Shortcode',
				'slug'   => 'kohette-pagestree-shortcode',
				'source' => 'https://github.com/Kohette/Kohette-Pagestree-Shortcode/archive/master.zip',
			),

			array(
				'name'   => 'Kohette Interviews Support',
				'slug'   => 'kohette-wp-interviews-support',
				'source' => 'https://github.com/Kohette/Kohette-WP-Interviews-Support/archive/master.zip',
			),

			array(
				'name'   => 'Kohette User Contact Methods',
				'slug'   => 'kohette-wp-users-contact-methods',
				'source' => 'https://github.com/Kohette/Kohette-WP-User-Contact-Methods/archive/master.zip',
			),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'narratium',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'KTT_register_required_plugins' );

 ?>
