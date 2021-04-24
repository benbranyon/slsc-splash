<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * @package    Narratium
 */



/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments-container" class="site-palette-yin-2-color  text-align-center site-palette-yang-3-background-color">
<div id="comments" class="<?php echo KTT_get_content_width_classname();?> text-align-left comments-area padding-both-40 padding-bottom-40 margin-auto ">

	<?php
	$comments_template_path = 'comments-wordpress.php';
	if ( function_exists('KTT_get_comments_template_path') ) $comments_template_path = KTT_get_comments_template_path();
	include($comments_template_path);
	?>

</div>
<div class="padding-both-50"></div>
</div>
