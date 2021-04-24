<?php
/**
* This script allows adding support for multiple authores
*/


/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_coauthors';
$args['metabox_name']					= 	esc_html__("Post Co-Authors", 'narratium');
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      KTT_var_name('post_coauthors')
                                  );
$args['metabox_callback']			= 	'KTT_post_coauthors_meta_box';
$args['metabox_context']			= 	'normal';
$args['metabox_priority']			= 	'high';
$metabox = new KTT_new_metabox($args);



/**
* Metabox render
*/
function KTT_post_coauthors_meta_box($post) {

    /**
  	* We invoke the selectd library that helps us create multiselects
  	*/
  	wp_enqueue_style('style-select2', KTT_path_to_url(KTT_FW_RESOURCES . '/select2/select2.css'));
    wp_enqueue_script( 'select2', KTT_path_to_url(KTT_FW_RESOURCES . '/select2/select2.js') );

    /**
    * We get the array of authores
    */
    $post_coauthors = KTT_get_post_coauthors($post);
    $post_coauthors = wp_list_pluck($post_coauthors, 'ID');

    /**
    * We obtain the complete list of all users of the site-wrap
    */
    $users = get_users(array('exclude' => $post->post_author));

    ?>
      <p>
        <?php esc_html_e('Here you can add users as co-authors of the post.', 'narratium');?>
      </p>

      <select
      style="width:100%"
      name="<?php echo KTT_var_name('post_coauthors');?>[]"
      multiple="multiple">
        <?php foreach ($users as $user) {?>
          <option <?php if (in_array($user->ID, $post_coauthors)) {?>selected<?php } ?> value="<?php echo esc_attr($user->ID);?>"><?php echo esc_html($user->display_name) ;?> (<?php echo esc_html($user->user_login);?>) </option>
        <?php } ?>
      </select>

      <script>jQuery(document).ready(function() { jQuery("select[multiple=multiple]").select2();});</script>
    <?php

}


/**
* This function is responsible for returning an array with all the authores of a post
*/
function KTT_get_post_coauthors($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * We define the variable that the resulting array will contain
    */
    $result = array();

    /**
    * If there are already defined auhtors posts we get them
    */
    if (isset($post->post_coauthors) && $post->post_coauthors) $result = $post->post_coauthors;

    /**
    * If the author of the post appears as a co author we must remove it from the list
    */
    if ($result) if (in_array($post->post_author, $result)) unset($result[$post->post_author]);

    /**
    * If we do not have coauthores we leave here
    */
    if (!$result) return array();

    /**
    * We return the complete users object
    */
    $result = get_users(array('include' => $result));

    /**
    * We return the result
    */
    return $result;

}


/**
* This function is responsible for returning the author and coauthors of a post in the same array
*/
function KTT_get_post_author_and_coauthors($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * We get the post auhotr
    */
    $author = get_users(array('include' => $post->post_author));

    /**
    * We get coauthors
    */
    $coauthors = KTT_get_post_coauthors($post);

    /**
    * If there are no coauthores we return directly the author
    */
    if (!$coauthors) return $author;

    /**
    * We put together the auhotr with the coauthores
    */
    $result = array_merge($author, $coauthors);

    /**
    * We return the resulting array
    */
    return $result;

}





/**
* We include the script that is responsible for showing the columns
*/
require_once('post-co-authors-columns.php');

/**
* the filter
*/
require_once('post-custom-query-args-coauthors.php');




?>
