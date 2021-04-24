<?php
/**
 * share vars (and more) for twittter
 *
 */



// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------

				// Share vars inputs to facebook ---------------------------------------------------------------

				$args                           = array();
				$args['option_id']              = KTT_var_name('site_facebook_app_id');
				$args['option_name']            = esc_html__('Facebook App ID', 'narratium');
				$args['option_label']           = '';
				$args['option_description']     = sprintf(esc_html__('Add the Facebook app ID of %s in Facebook.', 'narratium'), get_bloginfo('name'));
				$args['option_type']            = 'text';
				$args['option_page']            = KTT_var_name('social-media-site-page');

				$KTT_new_setting = new KTT_new_setting($args);













// add "share this" variables right in the $post object
add_action( 'wp', 'KTT_share_args_for_posts_FACEBOOK' );
if (!function_exists('KTT_share_args_for_posts_FACEBOOK')) {
function KTT_share_args_for_posts_FACEBOOK()
{

    global $post;
    if(!$post) return;


    // facebook app id of the site ---------------------------------------------------
    $facebook_app_id = get_option(KTT_var_name('site_facebook_app_id'));
    // -------------------------------------------------------------------------------

    // facebook page url of the site ---------------------------------------------------
    $facebook_page = get_option(KTT_var_name('site_facebook_page_url'));
    // -------------------------------------------------------------------------------


    // facebook page of the post author -----------------------------------------------
    $author_facebook = get_the_author_meta( 'facebook', $post->post_author );
    if (!$author_facebook) $author_facebook = $facebook_page;
    if (strpos($author_facebook,'facebook') !== true) $author_facebook = 'https://facebook.com/' . $author_facebook;
    // --------------------------------------------------------------------------------


		$share_args['facebook']['app_id'] 					= 	$facebook_app_id;
		$share_args['facebook']['site_facebook'] 			= 	$facebook_page;
		$share_args['facebook']['author_facebook'] 			= 	$author_facebook;
		$share_args['facebook']['type'] 					= 	'article';

    $post->share = array_merge($post->share, $share_args);


}
}





// Twitter card (summary card with large image)
add_action( 'wp_head', 'KTT_shareable_header_facebook_article' );
if (!function_exists('KTT_shareable_header_facebook_article')) {
function KTT_shareable_header_facebook_article() {

		global $post;
    if(!$post) return;
		if (!is_single()) return;

		?>
		<?php if (isset($post->share['facebook'])) if ($post->share['facebook']['app_id']) {?><meta property="fb:app_id"          content="<?php echo esc_attr($post->share['facebook']['app_id']);?>" /> <?php } ?>
		<meta property="og:image" 			content="<?php echo esc_url($post->share['image']['large']);?>"/>
		<meta property="og:title" 			content="<?php echo htmlspecialchars(str_replace('"', '', rawurldecode( $post->share['title'])), ENT_QUOTES);?>"/>
		<meta property="og:description"     content="<?php echo esc_html($post->share['description']);?>" />
		<meta property="og:url" 			content="<?php echo esc_url($post->share['url']);?>"/>
		<meta property="og:site_name" 		content="<?php bloginfo('name');?>"/>
		<meta property="og:type" 			content="<?php echo esc_attr($post->share['facebook']['type']);?>" />
		<meta property="article:author" 	content="<?php echo esc_attr($post->share['facebook']['author_facebook']);?>" />
		<meta property="article:publisher" 	content="<?php echo esc_attr($post->share['facebook']['site_facebook']);?>" />
		<?php



}
}
