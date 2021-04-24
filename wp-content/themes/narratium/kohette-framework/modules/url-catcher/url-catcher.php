<?php
/**
 * URL Catcher
 * custom urls for your theme!
 *
 */


function url_catcher() {

  global $wp;
  $uri = home_url( $wp->request );

  $uri = str_replace(home_url("/"), '', $uri);
  $uri = str_replace( '?' . $_SERVER['QUERY_STRING'], '', $uri );
  $uri = str_replace(home_url("/"), '', $uri);
  $uri = explode( '/', $uri );
  $uri = array_values( array_filter( $uri ) );


  // we keep the current url as global
  KTT_set_global('current_url', $uri);


  /**
  * we save the url if we are in api mode
  */
  if (isset($uri[0]) && $uri[0] == 'api') {
    $api_url = $uri;
    unset($api_url[0]);
    KTT_set_global('current_api_url', array_values($api_url));
  }



  do_action('KTT_catch_url_priorized', $uri, $_REQUEST);
  do_action('KTT_catch_url', $uri, $_REQUEST);


}

add_action( 'init', 'url_catcher', 2 );
