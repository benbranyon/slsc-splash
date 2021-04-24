<?php
/**
* Functions related to users
*/



/**
* This function is responsible for returning the featured image of a user
*  This is the image that will be used as a background on the author's page and other
*/
function KTT_get_user_avatar_id($user_id) {

    /**
    * We obtain the image from the goal
    */
    $avatar_id = get_user_meta($user_id, KTT_var_name('user_avatar'), true);

    /**
    * If we have a result we leave here with the result
    */
    if ($avatar_id) return $avatar_id;

}



/**
* This function is responsible for returning the featured image of a user
* This is the image that will be used as a background on the author's page and other
*/
function KTT_get_user_featured_image_id($user_id = '') {

    if (!$user_id) $user_id = get_query_var( 'author' );

    /**
    * In result we are going to save the results
    */
    $result = 0;

    /**
    * We obtain the image from the goal
    */
    $result = get_user_meta($user_id, KTT_var_name('user_featured_image'), true);
    if (!$result) $result = get_user_meta($user_id, KTT_var_name('profile_background_image'), true);


    /**
    * If we have a result we leave here with the results
    */
    if ($result) return $result;

    /**
    * If we have arrived here it means that the category has no defined image, therefore
    * we are going to obtain the last 10-15 posts belonging to the category and to extract
    * the highlighted image of one of his posts to use as an image of the category
    */
    $args = array('post_type' => 'post', 'post_status' => 'publish', 'post_author' => $user_id, 'posts_per_page' => 15);
    $q = new WP_Query($args);
    $posts = $q->posts;

    // RANDOM!
    if ($posts) shuffle($posts);

    /**
    * We go through each post and extract the first featured image that we find
    */
    if ($posts) foreach ($posts as $post) {
        $attach_id = get_post_thumbnail_id($post->ID);
        if ($attach_id) return $attach_id;
    }

}



/**
* This function is responsible for returning the template id of the user profile that
* the user has stored as a parameter, if no user returns a nulls
*/
function KTT_get_user_saved_template_id($user) {

  if (is_int($user) || is_string($user)) $user = KTT_get_user_by('ID', $user);

  /**
  * Here we are going to save the id of the template
  */
  $template_id = '';

  /**
  * We ask if the user has a defined template
  */
  if (isset($user->data->user_template)) $template_id = $user->data->user_template;

  /**
  * If we have arrived until here is that there is no template, therefore we return
  * a false;
  */
  return $template_id;

}



/**
* This function is responsible for obtaining only the id of the template that is using a post
*/
function KTT_get_user_template_id($user) {

   if (is_int($user) || is_string($user)) $user = KTT_get_user_by('ID', $user);

   /**
   * We try to get the template id that is linked to the post if any
   */
   $template_id = KTT_get_user_saved_template_id($user);

   /**
   * If we have not found a linked template we look for if the theme has a defined
   * some in your options for posts
   */
   if (!$template_id) $template_id = KTT_get_theme_option('user_template');

   /**
   * If at this point we do not have template id, we are going to get the list of
   *  all the templates for the posts and we are left with the first one that we find
   */
   if (!$template_id) {

       /**
       * We obtain the list of available templates for a post
       */
       $templates = KTT_get_theme_templates_by_type('user');

       /**
       * We're left with the first one on the list
       */
       //$template_id = array_values($templates)[0]->id;
       $template_id = reset($templates)->id;

   }

   /**
   * We return the template id
   */
   return $template_id;


}


/**
* This function is responsible for obtaining the template that corresponds to a post
*/
function KTT_get_user_template($user = '') {

   if (!$user) $user = get_query_var( 'author' );

   if (is_int($user) || is_string($user)) $user = KTT_get_user_by('ID', $user);

   /**
   *We obtain the list of available templates for a post
   */
   $templates = KTT_get_theme_templates_by_type('user');

   /**
   * If there are no templates we leave here
   */
   if (!$templates) return;

   /**
   * We try to get the template id that is linked to the post if any
   */
   $template_id = KTT_get_user_template_id($user);

   /**
   * We return the object template
   */
   return $templates[$template_id];

}










?>
