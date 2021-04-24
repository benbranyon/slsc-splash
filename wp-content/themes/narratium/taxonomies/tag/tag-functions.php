<?php






/**
* This function is responsible for returning the featured image of a post_tag
*/
function KTT_get_post_tag_featured_image_id($post_tag_id) {

    /**
    * In result we are going to save the results
    */
    $result = 0;

    /**
    * We obtain the image from the goal
    */
    $result = get_taxonomy_meta($post_tag_id, KTT_var_name('post_tag_featured_image'), true);

    /**
    * If we have a result we leave here with the results
    */
    if ($result) return $result;

    /**
    * If we have arrived here it means that the category has no defined image, therefore
    * we are going to obtain the last 10-15 posts belonging to the category and to extract
    * the highlighted image of one of his posts to use as an image of the category
    */
    $args = array('post_type' => 'post', 'post_status' => 'publish', 'cat' => $post_tag_id, 'posts_per_page' => 15);
    $q = new WP_Query($args);
    $posts = $q->posts;

    // RANDOM!
    if ($posts) shuffle($posts);

    /**
    * We go through each post and extract the first featured image that we find
    */
    if ($posts) foreach ($posts as $post) {
        $attach_id = get_post_thumbnail_id($post->ID);
        if ($attach_id) return $attach_id;
    }

}



/**
* This function is responsible for extracting the template from a category
*/
function KTT_get_post_tag_template($post_tag_id = '') {

    if (!$post_tag_id)  $post_tag_id = get_queried_object()->term_id;

    /**
    * In result we get the id
    */
    $template_id = get_term_meta($post_tag_id, KTT_theme_var_name('post_tag_template'), true);

    /**
    * If we have not obtained a template id then we will check if the theme has a defined
    * one by default for categories that do not have it
    */
    if (!$template_id) $template_id = KTT_get_theme_option('post_tag_template');

    /**
    * If at this point we continue without template id we will obtain the complete list and we will remain
    * with the first
    */
    if (!$template_id) {

        /**
        * list of templates
        */
        $templates = KTT_get_theme_templates_by_type('post_tag');

        /**
        * We are left alone with the first value
        */
        $t = reset($templates);
        $template_id = $t->id;

    }

    /**
    * We get the template_id object
    */
    $template = KTT_get_theme_template($template_id);

    /**
    * Let's devote the template
    */
    return $template;


}


 ?>
