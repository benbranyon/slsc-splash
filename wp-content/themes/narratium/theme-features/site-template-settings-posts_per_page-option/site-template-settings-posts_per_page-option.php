<?php

/**
* This function hook allows us to modify the posts_per_page option of the current
* page if is in use anu template with this option confgured
*/
function KTT_template_setting_custom_posts_per_page( $query ) {

    /**
    * Not the main query? get out
    */
    if ( !$query->is_main_query() ) return;

    /**
    * We get the tempalte for this page
    */
    $template = KTT_get_current_theme_template();

    /**
    * If we have not a template then return
    */
    if (!$template) return;

    /**
    * We get the saved template options
    */
    $template_options = KTT_get_template_options($template->id);

    /**
    * We look into the tempalte options to find the post_per_page option
    * if we found the option, then que mod the $query
    */
    if (isset($template_options['posts_per_page']) && $template_options['posts_per_page']) $query->set('posts_per_page', $template_options['posts_per_page']);

}
if (!is_admin()) add_action( 'pre_get_posts', 'KTT_template_setting_custom_posts_per_page' );

?>
