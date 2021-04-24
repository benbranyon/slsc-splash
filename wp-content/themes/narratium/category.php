<?php
/**
 * This is the category template
 * From here we will load the real template that we will use for the category that is indicated
 */


/**
* First of all we get the id of the category that is being used
*/
$category_id = $cat;

/**
* We obtain the template that the category has linked
*/
$category_template = KTT_get_category_template($category_id);

/**
* We include the template through your path
*/
if ($category_template) require($category_template->path);
