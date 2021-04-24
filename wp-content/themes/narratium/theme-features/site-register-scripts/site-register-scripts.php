<?php

/**
* Register the js libraries that you find in the js directory of the theme
*/
function KTT_register_theme_scripts() {

      /**
      * First of all we define the route where we have our style sheets
      */
      $js_dir = get_stylesheet_directory() . '/assets/js/';

      /**
      * We define the url from which we can access the file with a browser
      */
      $js_url = get_template_directory_uri() . '/assets/js/';

      /**
      * We are going to itinerate for each js that we find in the directory and we register it in our theme
      */
  		foreach (glob( trailingslashit($js_dir) . "*.js") as $js_file) {

            /**
            * We register the css we found
            */
            wp_register_script( basename($js_file, '.js'), trailingslashit($js_url) . basename($js_file), array('jquery'), false, true);

  		};

}
add_action('wp_enqueue_scripts', 'KTT_register_theme_scripts', 2);
