<?php
/**
* This script enables page attributes for posts.
*  this allows a template to be chosen in the post editor
*/

/**
* this filter allows modifying the behavior of templates for a psot
*  we take advantage of this to modify the template that loads the post
*/
function KTT_post_load_custom_template($template){

      /**
      * If we are not on a single post page then we leave here
      * Returning the template that already brought by itself
      */
      if( !is_single() ) return $template;

      /**
      * Load the current query
      */
      global $wp_query;

      /**
      * If the post has a custom template it will be saved in your postmeta
      * wp_page_template, if so, we replace this template with the current one
      */
      $custom_template = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

      /**
      * We return the template if it had it
      */
      return empty( $c_template ) ? $template : $custom_template;

}
add_filter( 'template_include', 'KTT_post_load_custom_template' );




/**
* We enable the page attributes in the posts
*/
function KTT_page_attributes_for_posts(){add_post_type_support( 'post', 'page-attributes' );}
add_action( 'init', 'KTT_page_attributes_for_posts' );


 ?>
