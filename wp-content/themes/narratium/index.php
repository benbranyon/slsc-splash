<?php


/**
* We obtain the template that the category has linked
*/
$template = KTT_get_frontpage_posts_template();

/**
* If there is no template we show an error message
*/
if (!$template) {
	esc_html_e("Please, select a template in Settings -> Reading", 'narratium');
	return;
}

$config_mode = false;
/**
* We include the template through your path
*/
require($template->path);
