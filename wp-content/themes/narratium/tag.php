<?php
/**
 * This is the category template
 * From here we will load the real template that we will use for the category that is indicated
 */

/**
* We obtain the template that the category has linked
*/
$template = KTT_get_current_theme_template();

/**
* We include the template through your path
*/
require($template->path);
