<?php

/**
* Register the js libraries that you find in the js directory of the theme
*/
function KTT_register_theme_prefix($prefixes) {

      /**
      * We add the prefix of the theme to the list of prefixes
      */
      $prefixes[] = THEME_PREFIX;

      /**
      * We return the list
      */
      return $prefixes;

}
add_filter('KTT_meta_prefixes', 'KTT_register_theme_prefix', 1);
