<?php

add_theme_support( 'wp-block-styles' );
add_theme_support( 'editor-styles' );


/**
 * We load just the basic styles of the site
 */
function KTT_load_editor_stylesheets() {

    /**
    * material angular css
    */
    //add_editor_style( KTT_var_name('-style-editor'));
    //wp_enqueue_style( KTT_var_name('-style-editor'));


    wp_register_style( 'style-editor',  get_template_directory_uri() . '/assets/stylesheets/style-editor.css', false, '1.0.0' );
    wp_enqueue_style( 'style-editor' );



}
add_action( 'admin_enqueue_scripts', 'KTT_load_editor_stylesheets', 3 );
