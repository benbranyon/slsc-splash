<?php
/**
 * share vars (and more) for twittter
 *
 */








// add "share this" variables right in the $post object
add_action( 'wp', 'KTT_share_args_for_posts_TWITTER' );
if (!function_exists('KTT_share_args_for_posts_TWITTER')) {
function KTT_share_args_for_posts_TWITTER()
{

    global $post;
    if(!$post) return;


     // twitter username of the website -----------------------------------------------
    $site_twitter = get_option(KTT_var_name('site_twitter'), get_option(KTT_var_name('site_social_id_twitter')));
    // --------------------------------------------------------------------------------


    // twitter username of the post author --------------------------------------------
    $author_twitter = get_the_author_meta( 'twitter', $post->post_author );
    if (!$author_twitter) $author_twitter = $site_twitter;
    // --------------------------------------------------------------------------------


  	$share_args['twitter']['via'] 					= 	$site_twitter;
  	$share_args['twitter']['related'] 				= 	$author_twitter;
  	$share_args['twitter']['hashtags'] 				= 	'';
  	$share_args['twitter']['site_twitter'] 			= 	$site_twitter;
  	$share_args['twitter']['author_twitter'] 		= 	$author_twitter;

    $post->share = array_merge($post->share, $share_args);


}
}





// Twitter card (summary card with large image)
add_action( 'wp_head', 'KTT_shareable_header_twitter_card' );
if (!function_exists('KTT_shareable_header_twitter_card')) {
function KTT_shareable_header_twitter_card() {

	  global $post;
    if(!$post) return;
    if (!is_single()) return;


		?>
		<meta name="twitter:card" 			content="summary_large_image">
		<meta name="twitter:site" 			content="@<?php echo esc_attr($post->share['twitter']['site_twitter']);?>">
		<meta name="twitter:creator" 		content="@<?php echo esc_attr($post->share['twitter']['author_twitter']);?>">
		<meta name="twitter:title" 			content="<?php echo htmlspecialchars(rawurldecode($post->share['title']));?>">
		<meta name="twitter:description" 	content="<?php echo esc_html($post->share['description']);?>">
		<meta name="twitter:domain" 		content="<?php echo esc_url(home_url("/"));?>">
		<meta name="twitter:image:src" 		content="<?php echo esc_url($post->share['image']['large']);?>">
		<?php


}
}
