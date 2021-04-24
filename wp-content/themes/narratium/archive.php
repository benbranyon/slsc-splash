<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

 /**
 * We obtain the template that the category has linked
 */
 $template = KTT_get_current_theme_template();

 /**
 * We include the template through your path
 */
 require($template->path);
