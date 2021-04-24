<?php
/**
 * Narratium functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Narratium
*/

/**
* We include the configuration files of the theme
*/
require_once(get_parent_theme_file_path('theme-config/theme-config.php'));

/**
* load the kohette framework (handy functions!)
*/
require_once(get_parent_theme_file_path('kohette-framework/kohette-framework.php'));

/**
* create a kohette framework object
*/
$theme = new kohette_framework();

/**
* We execute the function that is responsible for activating the theme and load the default options when it is activated for the first time from the themes page of the administration.
*/
$theme->start_kohette_framework();
