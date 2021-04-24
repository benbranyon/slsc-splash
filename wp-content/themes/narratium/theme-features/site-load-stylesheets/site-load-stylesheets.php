<?php
/**
 * We load just the basic styles of the site
 */
function KTT_load_common_stylesheets() {

    /**
    * material angular css
    */
    wp_enqueue_style( KTT_var_name('-angular-material.min'));

    /**
    * Our base style, all pages should load this
    */
    wp_enqueue_style( KTT_var_name( '-base'));

    /**
    * style for icons
    */
    wp_enqueue_style( KTT_var_name( '-icons'));


}
add_action( 'wp_enqueue_scripts', 'KTT_load_common_stylesheets', 3 );
