<?php
/**
* Feature Name: Social Media SEO
* ID: social_media_seo
* URI:
* Description: Create and include SEO Information related with social media in every page header
* Version: 1.0.0
* Display: Visible
* Category: Theme
* Status: Enabled
* UpdateMode: Auto
*/


// add "share this" variables right in the $post object
add_action( 'wp', 'KTT_share_args_for_posts' );
function KTT_share_args_for_posts()
{

    global $post;
    if(!$post) return;


    // we get the image urls -------------------------------------------------------------
    $post_image_id = get_post_thumbnail_id( $post->ID );

    $post_image_url_thumb = '';
    $post_image_url_medium = '';
    $post_image_url_large = '';

    if ($post_image_id) {


	    $post_image_url_thumb = wp_get_attachment_image_src( $post_image_id, 'thumbnail' );
	    $post_image_url_thumb = $post_image_url_thumb[0];

	    $post_image_url_medium = wp_get_attachment_image_src( $post_image_id, 'medium' );
	    $post_image_url_medium = $post_image_url_medium[0];

	    $post_image_url_large = wp_get_attachment_image_src( $post_image_id, 'large' );
	    $post_image_url_large = $post_image_url_large[0];
	}

    // -----------------------------------------------------------------------------------


    // get the excerpt -------------------------------------------------------------------
    $excerpt = substr($post->post_excerpt, 0, 195);
    if (!$excerpt) $excerpt = substr(wp_strip_all_tags(do_shortcode($post->post_content)), 0, 195);
    $excerpt .= '...';
    // -----------------------------------------------------------------------------------

    global $wpdb;
    $title = str_replace('|', '', $post->post_title);
    $title = rawurlencode($title);


    $share_args = array();
    $share_args['url'] 					=  	get_permalink($post->ID);
    $share_args['title'] 				= 	$title;
	  $share_args['text'] 				= 	$title;

	  $share_args['description'] 			= 	$excerpt;

	  $share_args['image']['thumb'] 		= 	$post_image_url_thumb;
	  $share_args['image']['medium'] 		= 	$post_image_url_medium;
	  $share_args['image']['large'] 		= 	$post_image_url_large;

    $post->share = $share_args;

}




// Create the header elements necesssary to share correctly a post in the principal social nets
include('share-to-twitter.php');
include('share-to-facebook.php');
