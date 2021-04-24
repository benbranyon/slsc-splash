<?php
/**
* This functionality allows us to implement color templates in the theme
* Version 1.2
*/



/**
* This function is responsible for returning the list of color schemes registered in the site
*
* @package Kohette Framework\Color schemes
* @return Array It contains a composite list with all registered color schemes.
*/
function KTT_get_theme_color_schemes() {

      /**
      * A scheme should have this format
      * [scheme_id] = array(
      *   'id' => scheme_id,
      *   'name' => 'Nombre de la scheme',
      *   'description' => 'Descripcion de la scheme'
      *   'colors' => array(
      *     'yin' => array(
      *       'yin_1' => '#000000',
      *       'yin_2' => '#000000',
      *       'yin_3' => '#000000',
      *       'yin_4' => '#000000',
      *       'yin_special_1' => '#000000',
      *       'yin_special_2' => '#000000',
      *     )
      *     'yang' => array (
      *       'yang_1' => '#000000',
      *       'yang_2' => '#000000',
      *       'yang_3' => '#000000',
      *       'yang_4' => '#000000',
      *       'yang_special_1' => '#000000',
      *       'yang_special_2' => '#000000',
      *      )
      *
      *   )
      * )
      */

      /**
      * We register the results array
      */
      $result = array();

      /**
      * We apply a filter, this allows us to add schemes from third functions
      */
      $result = apply_filters('KTT_THEME_color_schemes', $result);

      /**
      * We return the array with the results
      */
      return $result;

}


/**
* This function is responsible for creating the class name of a scheme
*
* @package Kohette Framework\Color schemes
*
* @param String $scheme_id Identificador de color scheme.
* @return String Returns the CSS class that identifies the scheme_id that is passed as a parameter, this will be the class that is used in the html.
*/
function KTT_get_color_scheme_classname($scheme_id) {
  return 'color-scheme-' . $scheme_id;
}



/**
* This function is responsible for obtaining the scheme that has been indicated as a parameter
*
* @package Kohette Framework\Color schemes
*
* @param String $scheme_id Schema color identifier.
* @return Array Returns all the relevant information of the scheme in the form of an array.
*/
function KTT_get_theme_color_scheme($scheme_id) {

      /**
      * First of all we get the complete list of templates
      */
      $schemes = KTT_get_theme_color_schemes();

      /**
      * if the id we are looking for is not found in the list, we return a false
      */
      if (!isset($schemes[$scheme_id])) return;

      /**
      * We return the scheme
      */
      return $schemes[$scheme_id];

}



/**
* From the scheme we get the CSS that forms the colors
*
* @package Kohette Framework\Color schemes
*/
function KTT_get_theme_color_scheme_css($scheme_id) {

      /**
      * We define the css var
      */
      $css = '';

      /**
      * We define the properties that we are going to define in the css
      */
      $properties = array('color', 'background-color', 'border-color');

      /**
      * we get the scheme
      */
      $scheme = KTT_get_theme_color_scheme($scheme_id);

      /**
      * If there is no scheme id we leave here
      */
      if (!$scheme) return;

      /**
      * If there are no colors we leave here
      */
      if (!isset($scheme['colors']) && !$scheme['colors']) return;



      foreach ($scheme['colors']['yang_special'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-scheme-' . $scheme_id;
          foreach ($scheme['colors']['yang'] as $base_id => $base_value) {
            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-color a,';
          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array['color'] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }

      foreach ($scheme['colors']['yin_special'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-scheme-' . $scheme_id;
          foreach ($scheme['colors']['yin'] as $base_id => $base_value) {
            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-color a,';
          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array['color'] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }







      foreach ($scheme['colors']['yang'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-scheme-' . $scheme_id;
          $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-background-color a';

          $var = array_slice($scheme['colors']['yin_special'], 0, 1);
          $first = array_shift($var);
          $css_array['color'] = $first;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }

      /**
      * This is responsible for putting the light colored links in dark background and vice versa
      */
      foreach ($scheme['colors']['yin'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-scheme-' . $scheme_id;
          $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-background-color a';

          $var = array_slice($scheme['colors']['yang_special'], 0, 1);
          $first = array_shift($var);
          $css_array['color'] = $first;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }











      foreach ($scheme['colors']['yin_special'] as $color_id => $color_value) {
        foreach ($properties as $property) {
          $css_array = array();
          $css_array['selector'] = ' .color-scheme-' . $scheme_id;
          foreach ($scheme['colors']['yin'] as $base_id => $base_value) {


            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-' . $property;
            $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-' . $property . ',';


          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array[$property] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
        }




      }





      foreach ($scheme['colors']['yin_special'] as $color_id => $color_value) {
        foreach ($properties as $property) {
          $css_array = array();
          $css_array['selector'] = ' .color-scheme-' . $scheme_id;
          foreach ($scheme['colors']['yin'] as $base_id => $base_value) {


            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-' . $property;
            $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-' . $property . ',';


          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array[$property] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
        }
      }













      /**
      * We walk through each of the properties and add a card_classes that defines a color for each property
      */
      foreach ($properties as $property) {
          /**
          * We go for each of the colors
          */
          foreach ($scheme['colors']['yin'] as $color_id => $color_value) {

              $css_array = array();
              $css_array['selector'] = ' .color-scheme-' . $scheme_id . ' .' . str_replace('_', '-', $color_id) . '-' . $property ;
              $css_array['selector'] .= ', .color-scheme-' . $scheme_id . ' a.' . str_replace('_', '-', $color_id) . '-' . $property;
              $css_array[$property] = $color_value;

              $css .= KTT_theme_css_option_array_to_code($css_array);
          }

          foreach ($scheme['colors']['yang'] as $color_id => $color_value) {

              $css_array = array();
              $css_array['selector'] = ' .color-scheme-' . $scheme_id . ' .' . str_replace('_', '-', $color_id) . '-' . $property ;
              $css_array['selector'] .= ', .color-scheme-' . $scheme_id . ' a.' . str_replace('_', '-', $color_id) . '-' . $property;
              $css_array[$property] = $color_value;

              $css .= KTT_theme_css_option_array_to_code($css_array);
          }
      }



      /**
      * We create the css for gradients
      */

      foreach ($scheme['colors']['yin'] as $color_id => $color_value) {

        $css_array = array();
        $css_array['selector'] = ' .color-scheme-' . $scheme_id . ' .' . str_replace('_', '-', $color_id) . '-gradient-from-20' ;
        $css_array['background'] = 'linear-gradient(0deg, ' . $color_value . ' 20%, rgba(200,200,200,0) 100%)';

        $css .= KTT_theme_css_option_array_to_code($css_array);

      }


      foreach ($scheme['colors']['yang'] as $color_id => $color_value) {

        $css_array = array();
        $css_array['selector'] = ' .color-scheme-' . $scheme_id . ' .' . str_replace('_', '-', $color_id) . '-gradient-from-20' ;
        $css_array['background'] = 'linear-gradient(0deg, ' . $color_value . ' 20%, rgba(200,200,200,0) 100%)';

        $css .= KTT_theme_css_option_array_to_code($css_array);

      }






      /**
      * return the css
      */
      return $css;


}
