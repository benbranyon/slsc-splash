<?php

/**
* Thanks to this script we can attribute one or several classes to the body element
*/
function KTT_add_color_class_to_body($classes) {

        /***
        * This class defines the background color
        */
        $classes[] = 'site-palette-yang-1-background-color';

        /**
        * This class defines the font color
        */
        $classes[] = 'site-palette-yin-1-color';

        /**
        * And in passing we add the class that defines the typeface that we will use
        * default in the body
        */
        $classes[] = 'site-typeface-body';

        /**
        * We return the modified font array
        */
        return $classes;
}
add_filter('body_class', 'KTT_add_color_class_to_body');

 ?>
