<?php

/**
* This function hook allows us to modify the posts order option of the current
* page if is in use anu template with this option confgured
*/
function KTT_template_setting_custom_filter_by_category( $query ) {

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
    * not for single a pages
    */
    if (is_single()) return;

    /**
    * We get the saved template options
    */
    $template_options = KTT_get_template_options($template->id);

    /**
    * We look into the tempalte options to find the post_per_page option
    * if we found the option, then que mod the $query
    */
    if (isset($template_options['category_filter']) && $template_options['category_filter']) $query->set('category_name', $template_options['category_filter']);

}
if (!is_admin()) add_action( 'pre_get_posts', 'KTT_template_setting_custom_filter_by_category' );





/**
* This function will add an option to customize image heights in
* some Templates
*/
function KTT_add_category_filter_setting_to_templates($template_options, $template) {


    /**
    * if e detect the display/hide option in the template wewill add the read time
    * checkbox to the array of options
    */
    if (array_intersect($template->types, array('post_tag', 'category', 'frontpage'))) {


        /**
        * Filter by category
        */
        $categories = get_categories(array(
          'orderby' => 'name',
          'order'   => 'ASC'
        ) );
        array_unshift($categories ,  array('name' => esc_html__('Select category', 'narratium'), 'slug' => '') );
        $categories = wp_list_pluck($categories, 'name', 'slug');

        $template_options['category_filter']['option_name']              = esc_html__('Filter by Category', 'narratium');
        $template_options['category_filter']['option_description']       = esc_html__("Filter posts by category. Only the posts belonging to the selected category will be displayed in this template.", 'narratium');
        $template_options['category_filter']['option_priority'] 	       = 2;
        $template_options['category_filter']['option_type']              = 'select';
        $template_options['category_filter']['option_type_vars']			   = $categories;
        $template_options['category_filter']['option_default']					 = '';


    }

    /**
    * We return the template options array
    */
    return $template_options;

}
add_filter('KTT_theme_template_options', 'KTT_add_category_filter_setting_to_templates', 2, 2);




?>
