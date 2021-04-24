<?php
/**
* This hook allow us to add custom js code to our site
*/
function KTT_print_site_custom_js() {

    /**
    * first we extract all the custom css of our site
    */
    $result = KTT_get_site_custom_js();

    /**
    * We add a filter, util for modify the return of this function
    */
    $result = apply_filters('KTT_print_site_custom_js', $result);

    /**
    * We create the style tags and print the css
    */
    if ($result) {
      echo '<script>';
      echo esc_js($result);
      echo '</script>';
    };

}
add_action('wp_footer', 'KTT_print_site_custom_js', 100000);
