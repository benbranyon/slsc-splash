<?php
/**
* Con estas dos funciones añadimos la funcionalidad de poder dar clases a la
* etiqueta HTML de una página, igual que la funcion body_class lo hace para
* las clases del body
*/

function get_html_class($class) {

    $classes = array();
    /**
  	* Filters the list of CSS body classes for the current post or page.
  	*
    * @since 2.8.0
  	*
  	* @param array $classes An array of body classes.
  	* @param array $class   An array of additional classes added to the body.
  	*/
  	$classes = apply_filters( 'html_class', $classes, $class );

  	return array_unique( $classes );

}


function html_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', get_html_class( $class ) ) . '"';
}

 ?>
