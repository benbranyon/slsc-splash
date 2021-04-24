<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Narratium
 */

 /**
 * We obtain the template that the category has linked
 */
 $template = KTT_get_current_theme_template();

 /**
 * We include the template through your path
 */
 if ($template) require($template->path);
