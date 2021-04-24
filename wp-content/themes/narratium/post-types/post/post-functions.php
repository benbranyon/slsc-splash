<?php


/**
* Returns true if the word count function is active
*/
function KTT_post_display_read_time_is_active() {
	return get_option(KTT_var_name('post_show_read_time'));
}


/**
* Returns the number of words in the content of a post that is
* pass as a parameter
*/
function KTT_get_post_words_count($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * We get the content of the Post
    */
    $content = get_post_field( 'post_content', (isset($post->ID) ? $post->ID : '' ));

    /**
    * We count the words that the content has
    */
    $result = str_word_count( strip_tags( $content ) );

    /**
    * e return the result
    */
    return $result;

}


/**
* This function is responsible for calculating the reading time based on the number of words
*/
function KTT_get_post_read_time($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * We get the number of words
    */
    $words = KTT_get_post_words_count($post);

    /**
    * We define the average of words that can be read in a second
    */
    $words_per_second = 3;

    /**
    * We calculate the time in minutes
    */
    $result = round(($words / $words_per_second) / 60);

    /**
    * If it is a 0 we transform it into a 1
    */
    if (!$result) return 1;

    /**
    * We return the result
    */
    return $result;

}


/**
* This function is responsible for showing the read time of a Post
*/
function KTT_display_post_read_time($post = '') {

	if (!$post) global $post;
	if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

	/**
	* We get the type of readtime that is configured
	*/
	$read_time_type 	= get_option(KTT_var_name('post_read_time_type'));

	if ($read_time_type == 'words_count') {
		echo sprintf(esc_html__('%s words', 'narratium'), KTT_get_post_words_count($post));
	} else {
		echo sprintf(esc_html__('%s min read', 'narratium'), KTT_get_post_read_time($post));
	}

}


/**
* This function is responsible for returning the formated title of a post
*/
function KTT_get_post_title_formated($post = '') {

    if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);
    if (!$post) global $post;

		$result = '';

    /**
    * If we have arrived here means that the post does not have a formatted title,
    * therefore we return the normal title
    */
    $result = $post->post_title;

		/**
		* If we find the formatted title defined in the post, we return it
		*/
		if (isset($post->post_title_formated) && $post->post_title_formated) $result =  $post->post_title_formated;

		/**
		* We return the result
		*/
		return strip_tags($result, KTT_allowed_title_tags());
}


/**
* This function is responsible for returning the formated title of a post
*/
function KTT_get_post_subtitle_formated($post = '') {

		if (!$post) global $post;
		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		$result = '';

		/**
		* If you do not have formatted subtitles, we will try if you have a normal subtitle
		*/
		if (isset($post->post_subtitle) && $post->post_subtitle) $result =  $post->post_subtitle;

		/**
		* If we find the formatted subtitle defined in the post, we return it
		*/
		if (!$result && isset($post->post_subtitle_formated) && $post->post_subtitle_formated) {

				/**
				* fix to avoid false post_subtitle_formats
				*/
				if (strlen($post->post_subtitle_formated) > 10) {
						$result = $post->post_subtitle_formated;
				}

		}

		/**
		* We return the result
		*/
		return strip_tags($result, KTT_allowed_title_tags());
}



/**
* This function is responsible for obtaining only the id of the template that is using a post
*/
function KTT_get_post_template_id($post) {

		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* We try to get the template id that is linked to the post if any
		*/
		$template_id = '';
		if (isset($post->post_template)) $template_id = $post->post_template;
		if (!$template_id) if (isset($post->page_template)) $template_id = $post->page_template;
		if ($template_id == 'default') $template_id = '';

		/**
		* If we have not found a linked template we look for if the theme has a defined
		* some in your options for posts
		*/
		if (!$template_id && is_single()) $template_id = KTT_get_theme_option('post_template');
		if (!$template_id && is_page()) $template_id = KTT_get_theme_option('page_template');

		/**
		* If at this point we do not have template id, we are going to get the list of
		* all the templates for the posts and we are left with the first one that we find
		*/
		if (!$template_id) {

				/**
				* We obtain the list of available templates for a post
				*/
				if (is_single()) $templates = KTT_get_theme_templates_by_type('post');
				if (is_page()) $templates = KTT_get_theme_templates_by_type('page');

				/**
				* We're left with the first one on the list
				*/
				//if ($templates) $template_id = array_values($templates)[0]->id;
				if ($templates) $template_id = reset($templates)->id;

		}

		/**
		* We return the template id
		*/
		return $template_id;


}


/**
* This function is responsible for obtaining the template that corresponds to a post
*/
function KTT_get_post_template($post = '') {

		if (!$post) global $post;
		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* We obtain the list of available templates for a post
		*/
		if (is_single()) $templates = KTT_get_theme_templates_by_type('post');
		if (is_page()) $templates = KTT_get_theme_templates_by_type('page');

		/**
		* If there are no templates we leave here
		*/
		if (!$templates) return;

		/**
		* We try to get the template id that is linked to the post if any
		*/
		$template_id = KTT_get_post_template_id($post);

		/**
		* If we have id but it turns out that said id is not among the list of
		* available templates we look for the one that is configured by default
		* for all posts
		*/
		if (!isset($templates[$template_id]) && is_single()) $template_id = KTT_get_theme_option('post_template');
		if (!isset($templates[$template_id]) && is_page()) $template_id = KTT_get_theme_option('page_template');

		/**
		* We return the object template
		*/
		return $templates[$template_id];

}



/**
* This function is responsible for showing in our template the list of tags belonging to
* a post
*/
function KTT_post_display_html_tags($post) {

	if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

	/**
	* We get the tags of the post
	*/
	$posttags = get_the_tags($post->ID);
	if ($posttags) foreach($posttags as $tag) {
			?>
			<a
			class="icon-tag site-typeface-body margin-right-10 margin-bottom-5 display-inline-block link-chip typo-size-xsmall border-radius-2 padding-top-5 padding-bottom-5 padding-left-10 padding-right-10"
			ng-href="<?php echo get_tag_link($tag);?>">
				<?php echo esc_html($tag->name);?>
			</a>
			<?php
	}

}


/**
* Show the subtitle of the site
*/
function KTT_get_the_subtitle($post = '') {

		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* If a post has not been indicated, we try to obtain the current
		*/
		if (!$post) {
			global $post;
			$post = KTT_get_post($post->ID);
		}

		/**
		* We return the subtitle
		*/
		$result = '';
		if (isset($post->post_subtitle_formated) && $post->post_subtitle_formated) $result = $post->post_subtitle_formated;
		if (isset($post->post_subtitle)) $result = $post->post_subtitle;

		return strip_tags($result, KTT_allowed_title_tags());

}

/**
* This function shows the subtitle directly
*/
function KTT_the_subtitle($post = '') {
		echo KTT_get_the_subtitle($post);
}






/**
* Show the subtitle of the site
*/
function KTT_get_the_title($post = '') {

		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* If a post has not been indicated, we try to obtain the current
		*/
		if (!$post) {
			global $post;
			$post = KTT_get_post($post->ID);
		}

		$result = $post->post_title_formated;
		if (!$result) $result = $post->post_title;

		/**
		* We return the subtitle
		*/
		return strip_tags($result, KTT_allowed_title_tags());

}

/**
* This function shows the subtitle directly
*/
function KTT_the_title($post = '') {
		echo KTT_get_the_title($post);
}


/**
* This function returns a list in string of the allowed tags in titles and subtitles
*/
function KTT_allowed_title_tags() {
	return '<u>,<span>,<i>,<strong>,<b>,<em>';
}

?>
