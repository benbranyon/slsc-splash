<?php
/**
* Feature Name: Format for Titles
* ID: post_title_formated
* URI:
* Description: Adds a title field in edit pages with a rich text field with options to give format to titles.
* Version: 1.5.4
* Display: Visible
* Category: Post
* Status: Enabled
* UpdateMode: Auto
*/



/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_title_formated';
$args['metabox_name']					= 	esc_html__("Title", 'narratium');
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      KTT_var_name('post_title_formated')
                                  );
$args['metabox_callback']			= 	'KTT_post_title_meta_box';
$args['metabox_context']			= 	'normal';
$args['metabox_priority']			= 	'high';
$metabox = new KTT_new_metabox($args);




/**
* Removes the title field
*/
function KTT_remove_post_title_input() {remove_post_type_support('post', 'title');};
//add_action('admin_init', 'KTT_remove_post_title_input');




/**
* Metabox render
*/
function KTT_post_title_meta_box($post) {

    /**
    * If currently the entry does not have a formatted title we put
    * by default the normal title of the entry.
    */
    if (!isset($post->post_title_formated)) $post->post_title_formated = $post->post_title;

    /**
    * We declare the configuration of our editor
    */
    $editor_settings = array(
                                      'wpautop' => true,
                                      'media_buttons' => false,
                                      'textarea_name' => KTT_var_name('post_title_formated'),
                                      'textarea_rows' => 0,
                                      'quicktags' => false,
                                      'tinymce' => array(
                                                'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor'
                                        )
    );

    ?>
    <style>.edit-post-visual-editor__post-title-wrapper{display:none}</style>
    <div id="titlediv">
      <p>
        <?php esc_html_e('Insert a title for your post. You can use format tags.', 'narratium');?>
        <em><?php esc_html_e('This will override the base title of the post.', 'narratium');?></em>
      </p>
    <?php

    /**
    * We create the editor
    */
    wp_editor( $post->post_title_formated, KTT_var_name('post_title_formated'), $editor_settings );

    ?>
    </div>



    <script>


    jQuery( document ).ready(function() {

      //jQuery(".edit-post-visual-editor__post-title-wrapper").hide();

      wp.data.subscribe(function () {
       if (wp.data.select( 'core/editor' ).isSavingPost()) {
          if (window.tinymce && window.tinymce.editors) {
              for (var i = 0; i < tinymce.editors.length; i++) {
                  tinymce.editors[i].save();
                }
              }
            }
      });

    });

    </script>

    <?php
}




/***
* We make sure to capture the hook that is executed every time a postmeta is saved for
  this case update the title of the post based on the post_title_formated that we have saved
*/
function KTT_update_post_title_from_formated($meta_id, $post_id, $meta_key, $meta_value) {

      /**
      * If it is not the goal we are looking for or a value has not been indicated we will leave here
      */
      if ( $meta_key != KTT_var_name('post_title_formated'))  return;
      if (!$meta_value) return;

      /**
      * the meta_value is the formatted text, we must sanitize it to eliminate html tags
      */
      $meta_value = wp_strip_all_tags($meta_value, true);

      /**
      * We update the post to which this postmeta belongs to change the title
      */
      KTT_change_post_field($post_id, 'post_title', $meta_value);

      /**
      * With this we make sure to put a correct permalink in the case in which the Post
      * is being published for the first time (instead of an update)
      */
      $post = KTT_get_post($post_id);
      if ($post->post_name == 'auto-draft')  KTT_change_post_field($post_id, 'post_name', sanitize_title($meta_value));

}
add_action( 'added_post_meta', 'KTT_update_post_title_from_formated', 5, 4 );
add_action( 'updated_post_meta', 'KTT_update_post_title_from_formated', 5, 4 );




/**
* This is a little fix to the no-title problem
*/
function KTT_fix_no_title_bug($title) {

    if (!$title) {
      global $post;
      if (!$post) return $title;
      if (isset($post->post_title_formated)) return wp_strip_all_tags($post->post_title_formated, true);
    }

    return $title;

}
add_filter( 'the_title', 'KTT_fix_no_title_bug', 10);
