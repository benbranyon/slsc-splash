<?php

/**
* Registers the style sheets that are used on the site.
*/
function KTT_register_theme_stylesheets() {

      /**
      * First of all we define the route where we have our style sheets
      */
      $css_dir = get_stylesheet_directory() . '/assets/stylesheets/';

      /**
      * We define the url from which we can access the file with a browser
      */
      $css_url = get_template_directory_uri() . '/assets/stylesheets/';

      /**
      * We are going to itinerate for each css that we find in the directory and we register it in our theme
      */
  		foreach (glob( trailingslashit($css_dir) . "*.css") as $css_file) {

            /**
            * We register the css we found
            */
            wp_register_style(KTT_var_name('-' . basename($css_file, '.css')), trailingslashit($css_url) . basename($css_file));

  		};

}
add_action('wp_enqueue_scripts', 'KTT_register_theme_stylesheets', 2);
