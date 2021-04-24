<?php
/**
* This script is responsible for loading the necessary CSS dependencies that we need to
*  the ajax animations of the site as configured
*/





/**
 * We load only the basic CSS elements.
 */
function KTT_load_ajax_animations_stylesheets() {

    /**
    * basic js
    */
    wp_enqueue_style( KTT_var_name('-ajax-transitions-base'));


}
add_action( 'wp_enqueue_scripts', 'KTT_load_ajax_animations_stylesheets', 4 );




/**
* Registers the style sheets that are used on the site.
*/
function KTT_register_ajax_animations_stylesheets() {

      /**
      * First of all we define the route where we have our style sheets
      */
      $css_dir = trailingslashit(KTT_get_ajax_animations_src_path() . 'css');;

      /**
      * We define the url from which we can access the file with a browser
      */
      $css_url =  KTT_path_to_url($css_dir);

      /**
      * We are going to itinerate for each css that we find in the directory and we register it
      *  in our theme
      */
  		foreach (glob( trailingslashit($css_dir) . "*.css") as $css_file) {

            /**
            * We register the css we found
            */
            wp_register_style(KTT_var_name('-' . basename($css_file, '.css')), trailingslashit($css_url) . basename($css_file));

  		};

}
add_action('wp_enqueue_scripts', 'KTT_register_ajax_animations_stylesheets', 3);


 ?>
