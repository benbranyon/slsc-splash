<?php
/**
* Enable angularjs in the site/theme
*/



/**
* This function is responsible for returning true if angularjs is active in the subtitle
*/
function KTT_is_angularjs_active() {
    return true;
}



/**
* This function is responsible for adding the necessary attributes to the body tag
* to be able to work with angularjs
*/
function KTT_set_angularjs_body_attrs($result) {

    /**
    * We return the attributes of the body plus the ones we are going to add for angularjs
    */
    return $result .= ' ' . 'data-ng-app=main_app data-ng-controller=main_app_controller';

}
if (KTT_is_angularjs_active()) add_filter('KTT_body_attrs', 'KTT_set_angularjs_body_attrs', 1 );






/**
* With this hook we make sure to add to the footer of the site the code needed to activate angularjs (here goes the app)
*/
function KTT_add_angularjs_app() {

  ?>
  	/**
  	* Controller main_app
    * TODO: libs filter
  	*/
  	main_app.controller('main_app_controller',  function($scope, $compile, $http, $q, $timeout, $mdSidenav) {

  	      	<?php
  	      	/**
  	      	* We will use this hook to add additional functions to the main site app from external modules
  	      	*/
  	      	do_action('THEME_angularjs_main_app');
  	      	?>

  	});
  <?php

}

/**
* With this function we add our angularjs controller after the main app library load
*/
function KTT_load_angularjs_app_controller() {
    ob_start();
    $result = KTT_add_angularjs_app();
    $result = ob_get_clean();
    wp_add_inline_script( 'main-app', $result );
}
add_action( 'wp_enqueue_scripts', 'KTT_load_angularjs_app_controller', 99999 );







?>
