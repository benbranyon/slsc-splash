<?php
/*
Plugin Name: Kohette User Contact Methods
Description: Extends the contact methods for WordPress users and authors
Version: 1.0.0
Author: Rafael Martín
Author URI: http://kohette.com
Text Domain: ktt-contact-methods
Domain Path: /languages
*/


/**
* Esta funcion devuelve un array con informacion sobre todos los fields
* que queremos añadir
*/
function KTT_get_user_social_fields() {

    $result = array();

    /**
    * Facebook
    */
    $result['ktt_user_facebook']['id'] = 'facebook';
    $result['ktt_user_facebook']['label'] = __('Facebook username', 'ktt-contact-methods');
    $result['ktt_user_facebook']['icon'] = 'icon-facebook';
    $result['ktt_user_facebook']['url'] = 'https://facebook.com/';

    /**
    * Twitter
    */
    $result['ktt_user_twitter']['id'] = 'twitter';
    $result['ktt_user_twitter']['label'] = __('Twitter username', 'ktt-contact-methods');
    $result['ktt_user_twitter']['icon'] = 'icon-twitter';
    $result['ktt_user_twitter']['url'] = 'https://twitter.com/';

    /**
    * Twitter
    */
    $result['ktt_user_instagram']['id'] = 'instagram';
    $result['ktt_user_instagram']['label'] = __('Instagram username', 'ktt-contact-methods');
    $result['ktt_user_instagram']['icon'] = 'icon-instagram';
    $result['ktt_user_instagram']['url'] = 'https://instagram.com/';

    /**
    * Devolvemos el array
    */
    return $result;

}


/**
* Esta funcion se encarga simplemente de devolver una lista en array con las ids
* de todos los contact fields que puede tener un user
*/
function KTT_get_user_social_fields_ids() {

    /**
    * Obtenemos la lista completa
    */
    $list = KTT_get_user_social_fields();

    /**
    *
    */
    $list = wp_list_pluck($list, 'label', 'id');

    /**
    * Devolvemos la lista
    */
    return $list;
}


/**
* Añadimos los inputs que queremos a los perfiles de usuarios
*/
function KTT_add_contactmethods( $contactmethods ) {

    /**
    * Obtenemos el arrays
    */
    $methods = KTT_get_user_social_fields();

    /**
    * Itineramos por cada uno de los contact methods y lo vamos
    * añadiendo a la lista
    */
    foreach ($methods as $key => $method) $contactmethods[$key] = $method['label'];

    /**
    * Devolvemos el arrays
    */
    return $contactmethods;

}
add_filter( 'user_contactmethods', 'KTT_add_contactmethods', 10, 1 );


?>
