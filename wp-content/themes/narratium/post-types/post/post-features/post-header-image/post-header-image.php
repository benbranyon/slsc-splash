<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */






/**
* This hook is in charge of modifying the function that obtains the url of the video to substitute it with
* the url of the video featured in the post if it has one configured
*/
function KTT_replace_header_image_with_post_featured_image($args) {

		/**
		* If we are not on a single nanay page
		*/
		if (!is_single()) return $args;

		/**
		* We get the outstanding image of the post if it had
		*/
		$post_attachment_id = get_post_thumbnail_id();


		/**
		* If we have found an image, we replace it in the card
		*/
		if ($post_attachment_id) $args['card_background_attachment'] = $post_attachment_id;

		/**
		* We return the arguments
		*/
		return $args;

}
add_filter('KTT_theme_display_image_card_args', 'KTT_replace_header_image_with_post_featured_image', 20, 1);








?>
