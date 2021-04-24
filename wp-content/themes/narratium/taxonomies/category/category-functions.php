<?php






/**
* This function is responsible for returning the featured image of a category
*/
function KTT_get_category_featured_image_id($category_id) {

    /**
    * In result we are going to save the results
    */
    $result = 0;

    /**
    * We obtain the image from the goal
    */
    $result = get_taxonomy_meta($category_id, KTT_var_name('category_featured_image'), true);
    if (!$result) $result = get_taxonomy_meta($category_id, KTT_var_name('tag_featured_image'), true);

    /**
    * If we have a result we leave here with the results
    */
    if ($result) return $result;

    /**
    * If we have arrived here we will try to get the image of the posts
    * that we are currently requesting
    */
    $attach_from_posts = KTT_get_featured_image_from_current_posts();
    if ($attach_from_posts) return $attach_from_posts;

    /**
    * If we have arrived here it means that we have not found an image, therefore we are going to try
    * to get an image through a tag
    */
    return KTT_get_tag_featured_image_id($category_id);

}





/**
* This function is responsible for returning a featured image linked to a tag
*/
function KTT_get_tag_featured_image_id($tag_id) {
    /**
    * In result we are going to save the results
    */
    $result = 0;

    /**
    * In result we are going to save the results
    */
    $result = get_taxonomy_meta($tag_id, KTT_var_name('tag_featured_image'), true);

    /**
    * If we have a result we leave here with the results
    */
    if ($result) return $result;

    /**
    * If we have arrived here it means that the category has no defined image, therefore
    * we are going to obtain the last 10-15 posts belonging to the category and to extract
    * the highlighted image of one of his posts to use as an image of the category
    */
    $args = array('post_type' => 'post', 'post_status' => 'publish', 'tag_id' => $tag_id, 'posts_per_page' => 15);
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
function KTT_get_category_template($category_id = '') {

    if (!$category_id) $category_id = get_queried_object()->term_id;

    /**
    * In result we get the id
    */
    $template_id = get_term_meta($category_id, KTT_theme_var_name('category_template'), true);

    /**
    * If we have not obtained a template id then we will check if the theme has a defined
    * one by default for categories that do not have it
    */
    if (!$template_id) $template_id = get_option(KTT_theme_var_name('category_template'));

    /**
    * If at this point we continue without template id we will obtain the complete list and we will remain
    * with the first
    */
    if (!$template_id) {

          /**
          * list of templates
          */
          $templates = KTT_get_theme_templates_by_type('category');

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
