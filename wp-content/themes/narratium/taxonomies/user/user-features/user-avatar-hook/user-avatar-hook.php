<?php

/**
* We get the data of the get_avatar function to replace the avatar
*  of the user if he has an avatar registered on the site
*/
function KTT_update_avatar_image_url( $args, $id_or_email) {

    /**
    * If it's an id we get the user_id
    */
    if ( is_numeric($id_or_email) ) {

        /**
        * We get the user
        */
        $user = KTT_get_user_by('ID', $id_or_email);

    } elseif (is_string($id_or_email) && is_email($id_or_email)) {

        /**
        * We get the user
        */
        $user = @KTT_get_user_by('email', $id_or_email);

    } else {

        /**
        * We get the user
        */
        $user = KTT_get_user_by('ID', $id_or_email);

    }

    /**
    * Check if the user has an avatar
    */
    if ($user) if (isset($user->data->user_avatar)) if ($user->data->user_avatar) {

        /**
        * We get the avatar url
        */
        $args['url'] = KTT_scaled_image_url($user->data->user_avatar, 'thumbnail');

    }

    /**
    * We return the list of arguments
    */
    return $args;
}
add_filter( 'get_avatar_data' , 'KTT_update_avatar_image_url' , 1 , 2 );



 ?>
