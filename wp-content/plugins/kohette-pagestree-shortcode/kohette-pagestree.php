<?php
/*
Plugin Name:  Kohette Pagestree
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Create a shortcode to display child pages of the current page.
Version:      1.0.0
Author:       Rafael Martín
Author URI:   http://kohette.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/




/**
* shortcode
*/
function KTT_pagestree_shortcode( $atts, $content = null ) {

    /**
    * En result vamos a ir formando la salida del post
    */
    $result = '';

    /**
    * Nos quedamos con el objeto post/page actual
    */
    global $post;

    /**
    * Definimos los atributos por defecto y añadimos los indicados por el user
    */
    $atts = shortcode_atts( array(
          'child_of' => $post->ID,
          'authors' => null,
          'post_type' => 'page',
          'post_status' => 'publish',
          'title_li' => '',
    ), $atts );

    /**
    * Si no hay post nanay,
    */
    if (!$post) return;

    /**
    * Abrimos un ob, invocamos la funcion que se encarga de devovler una lista
    * de paginas y capturamos su salida en la variable result
    */
    ob_start();
    echo wp_list_pages($atts);
    $result = ob_get_clean();

    /**
    * Le damos un poco de formato
    */
    $result = '<ul>' . $result . '</ul>';

    /**
    * Devolvemos la salida
    */
    return $result;

}
add_shortcode( 'pagestree', 'KTT_pagestree_shortcode' );

?>
