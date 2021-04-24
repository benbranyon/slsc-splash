<?php
/**
* In case of this theme have ajax functionality we will tell you which parts
* of a template are updatable
*/


/**
* If ajax is not present or is not active we leave Aqui
*/
if (!function_exists('KTT_ajax_is_enabled') || !KTT_ajax_is_enabled() ) return;


/**
* In this function we will form the array with the information about the different
* dynamic parts of the site that can be loaded by ajax calls
*/
function KTT_theme_ajax_template_parts_filter($result) {

    /**
    * We indicate the body wrap
    */
    $result[] = array(
      'selector' => '#site-wrap',
      'content' => '',
      'compile' => true,
    );

    /**
    * We indicate the sidebar
    */
    $result[] = array(
      'selector' => 'md-sidenav.site-left-sidenav',
      'content' => '',
      'compile' => true,
    );


    /**
    * Let's devolve the modified array
    */
    return $result;

}
add_filter('KTT_theme_ajax_template_parts', 'KTT_theme_ajax_template_parts_filter', 5, 1);


 ?>
