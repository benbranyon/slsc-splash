<?php
/**
* Thanks to this script we can attribute one or several classes to the body element
*/
function KTT_add_color_scheme_to_html($classes) {

        $scheme_id = KTT_get_theme_option('site_color_scheme', 'default');
        $scheme_class = 'color-scheme-' . $scheme_id;

        /**
        * We add the class that defines the color template
        */
        $classes[] = $scheme_class;

        /**
        * We return the modified font array
        */
        return $classes;
}
add_filter('html_class', 'KTT_add_color_scheme_to_html');


 ?>
