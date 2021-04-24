<?php
/**
* This script is responsible for intercepting the hook that only triggers when the theme is activated and saving all the default options in the database
*/
function KTT_save_default_theme_options () {

  /*+
  * We get all the default options of the starter-content
  */
  $defaults = KTT_get_starter_content_data();

  /**
  * From the array of defaults we are only interested in the "options" so if we do not find any we leave here
  */
  if (!isset($defaults['options']) && !$defaults['options']) return;


  /**
  * We will roam through each of the default options and check one by one if that option already exists in the database, if so we leave it as is, but if it does not exist we create it
  */
  foreach ($defaults['options'] as $option_id => $option_default) {

      /**
      * We get the value that already has the option in our ddbb
      */
      $value = get_option($option_id);

      /**
      * If we do not have a value, we will save the option
      */
      if (!$value) add_option($option_id, $option_default);


  }

}
add_action('after_switch_theme', 'KTT_save_default_theme_options');

 ?>
