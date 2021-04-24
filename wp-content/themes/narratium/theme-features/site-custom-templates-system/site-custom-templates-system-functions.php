<?php
/**
* Functions template system
*/


/**
* This function is responsible for extracting the list of templates files This function only obtains an array with file paths
*/
function KTT_get_theme_templates_files() {

    /**
    * Let's go saving the templates that we find in this array
    */
    $result = array();

    /**
    * Itineraries for each of the templates of category that we find
    */
    foreach (glob(get_parent_theme_file_path("/template-*.php")) as $filename) $result[] = $filename;

    /**
    * We return the array with the results
    */
    return $result;

}



/**
* This function obtains tuna template data in an object
*/
function KTT_get_theme_template_data($file_path) {

    /**
    * In the result variable we are saving the results
    */
    $result = new stdClass();

    /**
    * We created a unique identifier for the template
    */
    $template_id = basename($file_path);

    /**
    * We obtain the data of the template by reading the first bytes of the file
    */
    $args = array(
      'name' => 'Template Name',
      'types' => 'Template Post Type',
      'styles' => 'Template Styles',
      'slug' => 'Slug'
    );
    $source = get_file_data($file_path, $args);

    /**
    * We save the data in the output array
    */
    $result->id = $template_id;
    $result->name = $source['name'];
    $result->slug = sanitize_title_with_dashes($result->name);
    if ($source['slug']) $result->slug = $source['slug'];
    $result->types = str_replace(' ', '', explode(',',$source['types']));
    $result->styles = str_replace(' ', '', explode(',',$source['styles']));
    $result->path = $file_path;

    /**
    * return the result
    */
    return $result;

}




/**
* This option is responsible for returning a list of options related to the template whose id is indicated
*/
function KTT_get_template_options($template_id) {

    global $wpdb;

    /**
    * In result we will go forming the array of options that this function should return
    */
    $result = array();

    /**
    * We define the variable identifier of the template
    */
    $template_id_option_name = KTT_theme_var_name('template_' . $template_id . '_option_');

    /**
    * We create a request that tries to obtain all the options in the bbdd that are related to the template_id
    */
    $options = $wpdb->get_results("Select * FROM {$wpdb->options} WHERE option_name LIKE '{$template_id_option_name}%'");

    /**
    * If we have found options we will add it to the array correctly formatted
    */
    if ($options) foreach ($options as $option) $result[str_replace($template_id_option_name, '', $option->option_name)] = get_option($option->option_name);

    /**
    * Finally, we return the array of options
    */
    return $result;

}






/**
* This function is responsible for obtaining a theme template based on an id
*/
function KTT_get_theme_template($id) {

    /**
    * We get the list of templates
    */
    $templates = KTT_get_theme_templates();


    /**
    * We return the template whose id matches the one we have
    */
    $template = '';
    if (isset($templates[$id])) $template = (isset($templates[$id]) ? $templates[$id] : '');

    /**
    * We return the template
    */
    return $template;

}


/**
* This function is responsible for returning the complete list of templates available in the theme
*/
function KTT_get_theme_templates() {

    /**
    * In result we are going to form the output
    */
    $result = array();

    /**
    * We get the list of template files
    */
    $files = KTT_get_theme_templates_files();

    /**
    * If we do not have templates we leave here
    */
    if (!$files) return $result;

    /**
    * We go through each of the templates and add them to the result array
    */
    foreach($files as $file) {

        /**
        * We add the data of the template to the array
        */
        $data = KTT_get_theme_template_data($file);
        $result[$data->id] = $data;

    }

    /**
    * Let's return the list
    */
    return $result;

}


/**
* This function extracts an array with all the available templates for the type that is introduced as a parameter...
*/
function KTT_get_theme_templates_by_type($type) {

    /**
    * We define the resulting array
    */
    $result = array();

    /**
    * We extract all the templates
    */
    $templates = KTT_get_theme_templates();

    /**
    * If there are no templates we leave here
    */
    if (!$templates) return;

    /**
    * Itineraries for each template and we add it to the result if it is Returns type we are looking for...
    */
    foreach ($templates as $template) if (in_array($type, $template->types)) $result[$template->id] = $template;

    /**
    * We return the result
    */
    return $result;

}


/**
* This function is responsible for obtaining the template of the current page
*/
function KTT_get_current_theme_template() {

    $result = '';

    if (is_single() || is_page()) $result = KTT_get_post_template();
    if ($result) return $result;

    if (is_author()) $result = KTT_get_user_template();
    if ($result) return $result;

    if (is_tag()) $result = KTT_get_post_tag_template();
    if ($result) return $result;

    if (is_category()) $result = KTT_get_category_template();
    if ($result) return $result;

    if (is_archive()) $result = KTT_get_archive_template();
    if ($result) return $result;

    if (is_search()) $result = KTT_get_search_template();
    if ($result) return $result;

    $result = KTT_get_frontpage_posts_template();

    return $result;


}
