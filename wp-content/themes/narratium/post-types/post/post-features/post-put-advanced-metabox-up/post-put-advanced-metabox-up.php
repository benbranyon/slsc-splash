<?php
/**
* This script is responsible for putting the metaboxes in the "advanced" context in front of the
*  main text editor in the editing of an entry
*/
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});
