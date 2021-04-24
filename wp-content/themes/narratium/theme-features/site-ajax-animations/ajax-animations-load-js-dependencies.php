<?php
/**
* This script is responsible for loading the necessary JS dependencies that we need to
*  the ajax animations of the site as configured
*/





/**
* We load JS libraries
*/
function KTT_load_ajax_animations_scripts() {

      wp_enqueue_script( 'snap.svg-min');
      wp_enqueue_script( 'svgLoader');
      wp_add_inline_script( 'svgLoader', 'var loader = new SVGLoader( document.getElementById( "loader" ), { speedIn : 500, easingIn : mina.easeinout } );' );

}
add_action( 'wp_enqueue_scripts', 'KTT_load_ajax_animations_scripts', 5 );





/**
* We register the libraries js
*/
function KTT_register_ajax_animations_scripts() {

      /**
      * First of all we define the route where we have our style sheets
      */
      $js_dir = trailingslashit(KTT_get_ajax_animations_src_path() . 'js');

      /**
      * We define the url from which we can access the file with a browser
      */
      $js_url = KTT_path_to_url($js_dir);

      /**
      * We are going to itinerate for each js that we find in the directory and we register it
      *  in our theme
      */
  		foreach (glob( trailingslashit($js_dir) . "*.js") as $js_file) {

            /**
            * We register the css we found
            */
            wp_register_script(basename($js_file, '.js'), trailingslashit($js_url) . basename($js_file), array(), false, true);

  		};

}
add_action('wp_enqueue_scripts', 'KTT_register_ajax_animations_scripts', 3);





 ?>
