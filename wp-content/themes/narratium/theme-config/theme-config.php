<?php

/**
* THEME Check
*/
if ( ! isset( $content_width ) ) $content_width = 800;


/**
* Through this script we add all the configuration of the theme needed to include
* all the necessary php files
*/
foreach (glob(get_theme_file_path("/theme-config/*"), GLOB_ONLYDIR) as $filename) {
		include($filename . '/' . basename($filename) . '.php');
};
?>
