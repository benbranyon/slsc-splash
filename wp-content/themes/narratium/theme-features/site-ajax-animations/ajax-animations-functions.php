<?php
/**
* We register all functions related to ajax animations
*/


/**
* This function is responsible for determining if we have active on the site or not the animations
*  for ajax transitions
*/
function KTT_is_ajax_transition_animations_active() {
  return get_option(KTT_var_name('ajax_transition_animation'));
}


/**
* This function is responsible for returning the route where the dependencies of this feature are
*/
function KTT_get_ajax_animations_src_path() {
  return trailingslashit(get_parent_theme_file_path("theme-features/site-ajax-animations/src"));
}



/**
* Gets the active effect
*/
function KTT_get_current_ajax_animation_effect() {

    /**
    * We get the option
    */
    $effect_id = get_option(KTT_var_name('ajax_transition_animation'));

    /**
    * If we do not have effect we return false
    */
    if (!$effect_id) return;

    /**
    * Let's devote the full effect
    */
    return KTT_get_ajax_animation_effect($effect_id);

}


/**
* This function is responsible for returning an array with all the routes of the scripts that are responsible
 * of each of the effects
*/
function KTT_get_ajax_animations_effects_files() {

    /**
    * Let's go saving the templates that we find in this array
    */
    $result = array();

    /**
    * Itineraries for each of the templates of category that we find
    */
    foreach (glob(get_parent_theme_file_path("theme-features/site-ajax-animations/effects/*.php")) as $filename) $result[] = $filename;

    /**
    * We return the array with the results
    */
    return $result;

}


/**
* This function receives the path of an effects script and obtains an array with the same data
*  obtained from the first bytes of the file
*/
function KTT_get_ajax_animation_effect_data($file_path) {

    /**
    * In the result variable we are saving the results
    */
    $result = new stdClass();

    /**
    * We created a unique identifier for the template
    */
    $effect_id = basename($file_path);

    /**
    * We obtain the data of the template by reading the first bytes of the file
    */
    $args = array(
      'name' => 'Effect Name',
      'js_dependencies' => 'Scripts Dependencies',
      'css_dependencies' => 'CSS Dependencies'
    );
    $source = get_file_data($file_path, $args);


    /**
    * We save the data in the output array
    */
    $result->id = $effect_id;
    $result->name = $source['name'];
    if ($source['js_dependencies']) $result->dependencies['js'] = str_replace(' ', '', explode(',',$source['js_dependencies']));
    if ($source['css_dependencies']) $result->dependencies['css'] = str_replace(' ', '', explode(',',$source['css_dependencies']));
    $result->path = $file_path;

    /**
    * We return the result
    */
    return $result;

}




/**
* This function is responsible for obtaining an effect object
*/
function KTT_get_ajax_animation_effect($id) {

    /**
    * We get the list of templates
    */
    $effects = KTT_get_ajax_animations_effects();

    /**
    * We return the template whose id matches the one we have
    */
    $effect = (isset($effects[$id]) ? $effects[$id] : '');

    /**
    * We return the template
    */
    return $effect;

}




/**
* This function is responsible for returning the complete list of templates available in the theme
*/
function KTT_get_ajax_animations_effects() {

    /**
    * In result we are going to form the output
    */
    $result = array();

    /**
    * We get the list of template files
    */
    $files = KTT_get_ajax_animations_effects_files();

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
        $data = KTT_get_ajax_animation_effect_data($file);
        $result[$data->id] = $data;

    }

    /**
    * return the list
    */
    return $result;

}


?>
