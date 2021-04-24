<?php
/**
* Feature Name: Format for Subtitles
* ID: post_subtitle_formated
* URI:
* Description: Creates a new field for subtitles, with text format.
* Version: 1.2.3
* Display: Visible
* Category: Post
* Status: Enabled
* UpdateMode: Auto
*/


/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_subtitle_formated';
$args['metabox_name']					= 	esc_html__("Subtitle", 'narratium');
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      KTT_var_name('post_subtitle_formated')
                                  );
$args['metabox_callback']			= 	'KTT_post_subtitle_meta_box';
$args['metabox_context']			= 	'normal';
$args['metabox_priority']			= 	'low';
$metabox = new KTT_new_metabox($args);





function myplugin_tinymce_buttons( $buttons ) {
  return array('bold', 'italic', 'underline', 'strikethrough');
}



/**
* Metabox render
*/
function KTT_post_subtitle_meta_box($post) {

    /**
    * We get the subtitle if there is one
    */
    $post_subtitle = KTT_get_the_subtitle($post);

    /**
    * We declare the configuration of our editor
    */
    $editor_settings = array(
            'wpautop' => true,
            'media_buttons' => false,
            'textarea_name' => KTT_var_name('post_subtitle_formated'),
            'textarea_rows' => 0,
            'quicktags' => false,
            'tinymce' => array(
                    'toolbar1'=> 'bold,italic,underline,strikethrough,link,unlink,forecolor',
                    'toolbar2'=> '',
                    'toolbar3'=> '',
                    'toolbar4'=> '',
            )
    );

    ?>
      <p>
        <?php esc_html_e('Insert a subtitle for your post. You can use format tags.', 'narratium');?>
      </p>


    <?php

    /**
    * We create the editor
    */
    wp_editor( $post_subtitle, KTT_var_name('post_subtitle_formated'), $editor_settings );

}





/***
* We make sure to capture the hook that is executed every time a postmeta is saved for
  this case update the subtitle of the post based on the post_subtitle_formated that we have saved
  and so have two versions of it, one with format and another without it.
*/
function KTT_update_post_subtitle_from_formated($meta_id, $post_id, $meta_key, $meta_value) {

      /**
      * If it is not the goal we are looking for or a value has not been indicated we will leave here
      */
      if ( $meta_key != KTT_var_name('post_subtitle_formated'))  return;

      /**
      * the meta_value is the formatted text, we must sanitize it to eliminate html tags
      */
      $meta_value = strip_tags($meta_value, KTT_allowed_title_tags());

      /**
      * We update the post to which this postmeta belongs to change the title
      */
      update_post_meta($post_id, KTT_var_name('post_subtitle'), $meta_value);

}
add_action( 'added_post_meta', 'KTT_update_post_subtitle_from_formated', 5, 4 );
add_action( 'updated_post_meta', 'KTT_update_post_subtitle_from_formated', 5, 4 );

?>
