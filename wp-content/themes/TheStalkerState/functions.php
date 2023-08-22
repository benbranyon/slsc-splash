<?php
/*This file is part of TheStalkerState, narratium child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function TheStalkerState_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    if ( is_page_template('template-aos.php') ) {
	    	wp_enqueue_style( 'aos-styles', get_stylesheet_directory_uri() . '/css/aos.css' );
	    	wp_enqueue_script('aos-script', get_stylesheet_directory_uri() . '/js/aos.js', array( 'jquery' ), true);
	    }
	    wp_enqueue_style( 'childe2-style');
	    if( is_front_page() ) {
	    	wp_register_style('front-page-style', get_stylesheet_directory_uri() . '/css/front-page.css');
	    	wp_enqueue_style('front-page-style');
	    	wp_enqueue_script( 'three', get_stylesheet_directory_uri() . '/js/libraries/three.min.js', array('jquery'), '20151215', true );
	    	wp_enqueue_script( 'cannon', 'https://cdnjs.cloudflare.com/ajax/libs/cannon.js/0.6.2/cannon.min.js', array('jquery'), true);
	    	wp_enqueue_script( 'tween', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js', array('jquery'), true);
	    	wp_enqueue_script( 'main', get_stylesheet_directory_uri() .'/js/main.js', array('three'));
	    }
	 }
}
add_action( 'wp_enqueue_scripts', 'TheStalkerState_enqueue_child_styles' );

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( 'main' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

//Remove core block styles
add_filter( 'should_load_separate_core_block_assets', '__return_true' );
