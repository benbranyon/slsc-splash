<?php


/**
* This hook is responsible for modifying the framework plugins array
*  to add the php files needed for the theme to work
*  It is useful to add features that are unique to this theme
*/
function KTT_custom_theme_plugins( $plugins ) {



		/**
		* We load every post_type we have
		*/
		foreach (glob(get_template_directory() . "/post-types/*", GLOB_ONLYDIR) as $post_type) {

		    $plugins[] = array(
					'name' => basename($post_type),
					'source' => $post_type . '/' . basename($post_type) . '.php',
				);

				$plugins[] = array(
					'name' => basename($post_type) . '-functions',
					'source' => $post_type . '/' . basename($post_type) . '-functions.php',
				);

		};

		/**
		* Cwe put the features of the post_types
		*/
		foreach (glob( get_template_directory() . "/post-types/*/*-features/*", GLOB_ONLYDIR) as $filename) {

			$plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};

		/**
		* We go through each one of the unique features of the theme and add them to the array
		*/
		foreach (glob(get_template_directory() . "/theme-features/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
				);

		};






		// We load the functions of taxonomies ---------------------------------------------

		foreach (glob(get_template_directory() . "/taxonomies/*/*-functions.php", GLOB_NOSORT) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename,
			);

		};

		// ---------------------------------------------------------------------------------------


		// We load the features of the taxonomies---------------------------------------------
		foreach (glob(get_template_directory() . "/taxonomies/*/*-features/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};

		// ---------------------------------------------------------------------------------------

		// Cargamos los taxonomias ----------------------------------------------------------------
		foreach (glob(get_template_directory() . "/taxonomies/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};

		// ---------------------------------------------------------------------------------------



		/**
		* We load every post_type we have
		*/
		foreach (glob(get_template_directory() . "/widgets/*", GLOB_ONLYDIR) as $widget) {

		    $plugins[] = array(
					'name' => basename($widget),
					'source' => $widget . '/' . basename($widget) . '.php',
				);

		};


		// Cargamos los blocks ----------------------------------------------------------------
		foreach (glob(get_template_directory() . "/blocks/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};


		// ---------------------------------------------------------------------------------------

	  /**
	  * We return the configuration array
	  */
	  return $plugins;

}
add_filter( 'KTT_theme_plugins', 'KTT_custom_theme_plugins', 1, 3 );
