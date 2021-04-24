<?php







/**
* return the custom font styles array
*/
function KTT_get_custom_styles() {
    return (array)get_option(KTT_var_name('custom_styles'));
}


function KTT_get_custom_styles_simplified() {
    $custom_styles = KTT_get_custom_styles();
    $simplify = array();

    if ($custom_styles) {
    foreach ($custom_styles as $option_id => $style) {
        if ($style) {
        foreach($style as $selector => $values) {

            foreach ($values as $value) {

                $simplify[$selector][] = $value;

            }

        }
        }

    }
    }

    return $simplify;

}


/**
* add new custom style
*/
/*
EXAMPLE:

$new_custom_style = array(

                            'option_id' => array(
                                                    '.selector' => array(
                                                                            'selector' => 'body a',
                                                                            'property' => 'font-size',
                                                                            'value' => '12px',
                                                                            extra => array(),
                                                    )
                            )

)

*/
function KTT_add_custom_style($array) {

    KTT_clean_custom_styles_var();

    $custom_styles = KTT_get_custom_styles();
    foreach($array as $key => $value) {
        $custom_styles[$key] = $value;
    }

    update_option(KTT_var_name('custom_styles'), $custom_styles);

}







/**
* clean the global custom_styles
*/
function KTT_clean_custom_styles_var() {
    global $KTT_custom_theme_settings;
    $options = array_keys($KTT_custom_theme_settings);
    $custom_styles = KTT_get_custom_styles();

    foreach ($custom_styles as $key => $value) {
        if(!array_key_exists($key, $KTT_custom_theme_settings)) unset($custom_styles[$key]);
    }

    update_option(KTT_var_name('custom_styles'), $custom_styles);

}









/**
* display in the header the css necessary to load the custom  styles
*/
function KTT_display_custom_styles_css($current_css) {

    $custom_styles = KTT_get_custom_styles_simplified();

    $result = '';

    foreach ($custom_styles as $selector => $properties) {

        $result .= $selector . '{';

          foreach ($properties as $property) {
              if (!$property['value']) continue;
              $result .= $property['property'] . ':' . $property['value'] . ';';
          }

        $result .= '} ';

    }

    /**
    * we add the result to the current css code of the site
    */
    $current_css .= $result;

    /**
    * We return the modified current css of the site
    */
    return $current_css;

}









/**
* This function is responsible for adding the css belonging to each of the options of the themes that use css elements
*/
function KTT_load_theme_css_options($current_css) {
    $options = array();
    $options = apply_filters('KTT_theme_css_options', $options);

    /**
    * We obtain the default values
    */
    $option_defaults = KTT_get_starter_content_data();

    /**
    * If there are options we roam for each of them and add the css to
    */
    if ($options) foreach ($options as $option_id) {

        /**
        * We choose the option data
        */
        $option_value = get_option($option_id);

        /**
        * if we not have a selector defined then we pass
        */
        if (!isset($option_defaults['options'][$option_id]['selector'])) continue;

        /**
        * This line of code ensures that at all times the selector of the option is the one that we have defined in the initial array. wp_customize can do that if we update this selector does not update when the value of the selector is updated, this corrects it.
        */
        $option_value['selector'] = $option_defaults['options'][$option_id]['selector'];

        /**
        * We transform the css array into real css and add it to the existing css code of the theme
        */
        $current_css .= KTT_theme_css_option_array_to_code($option_value);

    }

    /**
    * We return the modified css
    */
    return $current_css;
}
add_action('KTT_add_site_custom_css', 'KTT_load_theme_css_options', 5, 1);





/**
* This function is responsible for converting a css array into a functional css text string
*/
function KTT_theme_css_option_array_to_code($array) {

    /**
    * In result we are forming the string
    */
    $result = '';
    if (!isset($array['selector'])) return '';

    /**
    * First we place the selector with the opening bracket
    */
    $result .= $array['selector'] . ' {';

    /**
    * We remove the array selector
    */
    unset($array['selector']);

    /**
    * This is a small fix made for the options that a property has defined
    */
    if (isset($array['property'])) {

      /**
      * If you do not have value, we leave here
      */
      if (!$array['value']) return;
      $array[$array['property']] = $array['value'];
      unset($array['property']);
      unset($array['value']);
    }

    /**
    * We go through each css element and we add it to the string
    */
    foreach ($array as $property => $value) {

        /**
        * FIX: We change the "regular" value given by google to the sources by "normal" which is the accepted css
        */
        if ($property == 'font_weight' && $value = 'regular') $value = 'normal';

        /**
        * FIX: Size_unit is not a valid css property, therefore we passed
        */
        if (in_array($property, array(
          'size_unit',
          'font_size_unit',
          'load_all_weights'))) $value = '';


        //FIX chungo
        // instead of this fix we could get the source library and based on the code to get the name, but perhaps consume a lot of memory (large array) in such case a solution could be to use a trasient that will be deleted only by an admin and when something changes in customize...
        if ($property == 'font_family') if (strpos($value, '+')) $value = "'" . str_replace('+', ' ', $value) . "'";

        /**
        * If there is a value for the property ...
        */
        if ($value) {

              $result .= str_replace('_', '-', $property) . ':' . $value;

              if ($property == 'font_size') $result .= $array['font_size_unit'];
              if ($property == 'line_height') $result .= 'em';

              $result .= ';';
        }


    }

    /**
    * Finally we close the bracket
    */
    $result .= '} ';

    /**
    * We return the result
    */
    return $result;

}
