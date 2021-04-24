<?php
/**
* https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
*/


/**
* This function is responsible for forming and returning the array with the initial configuration of the theme
*/
function KTT_get_starter_content_data() {

    /**
    * We define the base array
    */
    $result = array(
        /**
        * We define the recommended general theme options
        */
        'options' => array(
              'show_on_front' => 'posts',
              'posts_per_page' => 12,
        ),
        'theme_mods' => array(),
        'posts' => array(),
        'nav_menus' => array(),
        'widgets' => array(),
    );

    /**
    * To the array we apply a filter, in this way it can be modified from third functions
    */
    $result = apply_filters('KTT_starter_content_data', $result);

    /**
    * Return the array
    */
    return $result;

}


/**
* Iwe indicate that this theme has support for starter content
*/
add_action('after_setup_theme', function () {
    add_theme_support('starter-content', KTT_get_starter_content_data());
});





 ?>
