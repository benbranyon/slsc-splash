<?php
/**
* Hooks template system
*/



/**
* This hook allows us to load the correct libraries associated with the template that is showing at all times
*/
/**
* We load the stylesheerts of the default frontpage
*/
function KTT_load_template_stylesheets() {

      /**
      * We get the template that we are using
      */
      global $template;

      /**
      * If there is no template we leave here
      */
      if (!$template || !isset($template->styles)) return;

      /**
      * This filter allows us to add extra libraries dynamically through third functions
      */
      $template->styles = apply_filters('KTT_theme_template_stylesheets', $template->styles, $template);

      /**
      * If you do not have defined styles, we leave here
      */
      if (!isset($template->styles) && !$template->styles) return;

      /**
      * For each of the styles we add their css to the queue
      */
      foreach( $template->styles as $css_file_handle) wp_enqueue_style( KTT_var_name('-' . $css_file_handle));


}
add_action( 'wp_enqueue_scripts', 'KTT_load_template_stylesheets', 5 );




/**
* This hook is responsible for creating the global $ template that will contain important information about the template that is being used, we can use this variable to obtain information about the different options that the template allows
*/
function KTT_create_template_global() {

      /**
      * We get the template that we are using
      */
      $current_template = KTT_get_current_theme_template();
      if ($current_template) global $template;
      $template = $current_template;

      /**
      * We add the options to the template
      */
      if($template) $template->options = KTT_get_template_options($template->id);

}
add_action( 'wp_enqueue_scripts', 'KTT_create_template_global', 4 );


/**
* this hook adds the template slug as class to the body tag
*/
function KTT_add_template_classname_to_body($classes) {

        /**
        * We get the global template object if exists
        */
        global $template;

        /**
        * If the template object exists we add the classname to the array
        */
        if ($template) $classes[] = $template->slug;

        /**
        * We return the modified font array
        */
        return $classes;
}
add_filter('body_class', 'KTT_add_template_classname_to_body');
