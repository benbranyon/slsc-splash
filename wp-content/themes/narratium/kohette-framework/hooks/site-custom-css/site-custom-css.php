<?php
/**
* This hook allow us to add custom css code to our site
*/


/**
* This function will add the custom css dynamically after the style load
*/
function KTT_add_custom_css_inline() {

    /**
    * first we extract all the custom css of our site
    */
    $result = KTT_get_site_custom_css();

    /**
    * We add a filter, util for modify the return of this function
    */
    $result = apply_filters('KTT_print_site_custom_css', $result, get_the_ID());

    /**
    * We add our inline css afetr the main style
    */
    if ($result) wp_add_inline_style(KTT_var_name('-base'), $result);

}
add_action('wp_enqueue_scripts', 'KTT_add_custom_css_inline', 100000);
