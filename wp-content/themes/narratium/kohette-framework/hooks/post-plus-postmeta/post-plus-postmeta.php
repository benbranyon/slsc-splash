<?php
/**
 *	Function responsible for completing the information of a term with the taxmetas linked to the
 *
 *
 * @package printcore
 */



add_action( 'pre_get_posts', 'KTT_post_plus_postmeta' );
function KTT_post_plus_postmeta($query) {
    global $post;

    /**
    * If we are not handling a post object we leave here
    */
    if(!$post) return;

    /**
    * We call the function that is in charge of looking for the postmetas and add them to the object
    */
    $post = KTT_add_postmetas_to_post_object($post);
}



/**
* we make each of the posts extracted by a wp_query include the theme postmeta
*/
add_action( 'posts_results', 'KTT_set_custom_isvars' );

function KTT_set_custom_isvars($posts) {

	// fix
	$yeah = array();
	foreach ($posts as $post) $yeah[] = KTT_add_postmetas_to_post_object($post);;

	return $yeah;

}






/**
* This function is responsible for checking if the global post is defined on the current page and if so, search all its posts related to the theme and add them to the object
*/
function KTT_add_postmetas_to_global_post_object() {

  /*
  * We try to get the global post
  */
  global $post;

  /**
  * If we have not found it, we'll leave here
  */
  if (!$post) return;

  /**
  * We define the identifier of the theme with which all related variables begin
  */
  $theme_id = KTT_framework_unique_prefix();

  /**
  * invoke wpdb
  */
  global $wpdb;

  /**
  * We make the consultation that will return all the postmetas of the post related to the theme
  */
  $postmetas = $wpdb->get_results($wpdb->prepare('SELECT meta_key, meta_value FROM '  . $wpdb->postmeta . ' WHERE post_id = %d AND meta_key LIKE "' . $theme_id . '%"', $post->ID));

  /**
  * If we have not found postmetas we left here
  */
  if (!$postmetas) return;

  /**
  * We go for each one of the postmetas and we add them to the post object
  */
  if ($postmetas) foreach ($postmetas as $postmeta_key => $postmeta_value) {
    $key = KTT_remove_prefix($postmeta_key);
    $value = maybe_unserialize($postmeta_value);
    $post->$key = $value;
  }

}
add_action( 'parse_query', 'KTT_add_postmetas_to_global_post_object', 5 );
