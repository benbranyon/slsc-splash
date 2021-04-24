<?php
/**
 * We load just the basic js
 */
function KTT_load_common_scripts() {

    /**
    * We load the ktt-backgroundy library
    */
    wp_enqueue_script('ktt-backgroundy');
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );

}
add_action( 'wp_enqueue_scripts', 'KTT_load_common_scripts', 3 );



/**
* This function loads the related angularjs libraries
*/
function KTT_load_angularjs_scripts() {

  wp_enqueue_script( 'angular.min' );
  wp_enqueue_script( 'angular-animate.min' );
  wp_enqueue_script( 'angular-aria.min' );
  wp_enqueue_script( 'angular-material.min' );
  wp_enqueue_script( 'main-app' );

}
add_action( 'wp_enqueue_scripts', 'KTT_load_angularjs_scripts', 4 );
