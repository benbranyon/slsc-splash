<?php

/**
* This function makes use of the KTT_theme_css_options filter to obtain the options
* css that need to load a google source and add them in a list
*/
function KTT_get_required_theme_fonts_list($options) {

      /**
      * If there are no ptions we go
      */
      if (!$options) return $options;

      /**
      * Here we are going to save the array of sources
      */
      $fonts = array();

      /**
      * We load an array with the list of google sources
      */
      $fonts_list = KTT_get_available_fonts();

      /**
      * We will go through each one of the options and if we find that it is an option that needs to load a google source we add it to the list that we will then pass to the enqueue_style function
      */
      foreach ($options as $option) {

          /**
          * We get the value of the option
          */
          $option_value = get_option($option);

          /**
          * If in the option there is no defined font_family we skip it
          */
          if (!isset($option_value['font_family'])) continue;
          if (!$option_value['font_family']) continue;

          /**
          * We get the code
          */
          $font_family_code = $option_value['font_family'];

          /**
          * We add the font type (google, default, etc)
          */
          $fonts[$font_family_code]['type'] = $fonts_list[$font_family_code]['type'];

          /**
          * We add the name
          */
          $fonts[$font_family_code]['name'] = $fonts_list[$font_family_code]['name'];

          /**
          * If it is indicated that we must load all the variants we add all the possible variants
          */
          if (isset($option_value['load_all_weights']) && $option_value['load_all_weights']) $fonts[$font_family_code]['weights'] = $fonts_list[$font_family_code]['variants'];
          else $fonts[$font_family_code]['weights'] = (isset($option_value['weight']) ? array($option_value['weight']) : '');

      }


      /**
      * If there are no fonts we leave Aqui
      */
      if ($fonts) {

        $full_string = '';

        foreach ($fonts as $font_code => $font) {

                $name = str_replace(' ', '+', $font['name']);
                $sizes = implode(',', $font['weights']);
                if ($sizes) $font['weights'] = array('regular');
                $full_name = $name . ':' . $sizes;

                $full_string .= $full_name . '|';

        }

        /**
        * Enqueue font css style
        * #https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
        */
        wp_enqueue_style( THEME_PREFIX . '-google-fonts', add_query_arg( 'family',  $full_string, "//fonts.googleapis.com/css" ), array(), '1.0.0' );
      }

      /**
      * Finally we return the options
      */
      return $options;


}
add_filter( 'KTT_theme_css_options', 'KTT_get_required_theme_fonts_list', 999, 1);























/**
* get current google fonts required by the theme
*/
function KTT_get_current_google_fonts() {
    return (array)get_option(KTT_var_name('current_google_fonts'));
}

/**
* clean the  current_google_fonts
*/
function KTT_clean_current_google_fonts() {
    global $KTT_custom_theme_settings;
    $options = array_keys($KTT_custom_theme_settings);
    $current_google_fonts = KTT_get_current_google_fonts();

    foreach ($current_google_fonts as $key => $value) {
        if(!array_key_exists($key, $KTT_custom_theme_settings)) unset($current_google_fonts[$key]);
    }

    update_option(KTT_var_name('current_google_fonts'), $current_google_fonts);

}



/**
* override custom font styles option before save a font setting option
*
*/
function KTT_save_custom_font_styles( $new_value, $old_value ) {


    if (is_array($new_value)) {

        $option_id = $new_value['option_id'];
        $selector = $new_value['selector'];

        if ($option_id && $selector) {


            // save font family ------------------------------------------------
            if (isset($new_value['font_family'])) {
                $fonts = KTT_get_available_fonts();

                $style_array[$option_id][$selector]['font-family']['property'] = 'font-family';
                $style_array[$option_id][$selector]['font-family']['value'] = (isset($fonts[$new_value['font_family']]['css_code']) ? $fonts[$new_value['font_family']]['css_code'] : '');
                KTT_add_custom_style($style_array);

                // we save the source object to be able to extract it by css
                if (isset($fonts[$new_value['font_family']]['type'])) if($fonts[$new_value['font_family']]['type'] == 'google') {

                    KTT_clean_current_google_fonts();
                    $current_google_fonts = KTT_get_current_google_fonts();
                    $new_value['font'] = $fonts[$new_value['font_family']];
                    $current_google_fonts[$option_id] = $new_value;
                    update_option(KTT_var_name('current_google_fonts'), $current_google_fonts);

                }



            }
            // -----------------------------------------------------------------



            // save font weight ------------------------------------------------
            if (isset($new_value['variant']) && $new_value['variant']) {

              /**
              * We only keep the variant (weight) if there is a font_family defined
              */
              if (isset($new_value['font_weight']) && $new_value['font_weight']) {
                  $style_array[$option_id][$selector]['font-weight']['property'] = 'font-weight';
                  $style_array[$option_id][$selector]['font-weight']['value'] = $new_value['variant'];
                  KTT_add_custom_style($style_array);
              }

            }
            // -----------------------------------------------------------------


            // save font size ------------------------------------------------
            if (isset($new_value['size']) && isset($new_value['size_unit']) && $new_value['size']) {

                $style_array[$option_id][$selector]['font-size']['property'] = 'font-size';
                $style_array[$option_id][$selector]['font-size']['value'] = $new_value['size'] . $new_value['size_unit'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font color ------------------------------------------------
            if (isset($new_value['color']) && $new_value['color']) {

                $style_array[$option_id][$selector]['color']['property'] = 'color';
                $style_array[$option_id][$selector]['color']['value'] = $new_value['color'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font style ------------------------------------------------
            if (isset($new_value['font_style']) && $new_value['font_style']) {

                $style_array[$option_id][$selector]['font-style']['property'] = 'font-style';
                $style_array[$option_id][$selector]['font-style']['value'] = $new_value['font_style'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font style ------------------------------------------------
            if (isset($new_value['line_height']) && $new_value['line_height']) {

                $style_array[$option_id][$selector]['line-height']['property'] = 'line-height';
                $style_array[$option_id][$selector]['line-height']['value'] = $new_value['line_height'] . 'em';
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


        }



        // we save the font data in the option --------------------------------------------------
        if (isset($new_value['font_family']) && $new_value['font_family']) {
            $new_value['font'] = $fonts[$new_value['font_family']];
        }
        // --------------------------------------------------------------------------------------



    }

    return $new_value;

}
