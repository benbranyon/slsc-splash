<?php
/**
* A template system for the themes
*/

/**
* We load the functions related to the system of templates
*/
require_once('site-custom-templates-system-functions.php');

/**
* Load the hooks related to the template system
*/
require_once('site-custom-templates-system-hooks.php');



/**
* We define the administration panel within which all the sections and options related to the theme template system will go...
*/
$args = array();
$args['panel_id'] 						= KTT_theme_var_name('custom-templates-system');
$args['panel_title'] 					= esc_html__('Templates','narratium');
$args['panel_description'] 		= esc_html__("Customize and configure the theme's templates.", 'narratium');
$args['panel_priority'] 			= 10;
new KTT_new_customize_panel($args);

$args = array();
$args['panel_id'] 						= KTT_theme_var_name('custom-templates-system2');
$args['panel_title'] 					= esc_html__('Templates','narratium');
$args['panel_description'] 		= esc_html__("Customize and configure the theme's templates.", 'narratium');
$args['panel_priority'] 			= 10;
new KTT_new_customize_panel($args);



$args                           	= array();
$args['section_id']              	= KTT_theme_var_name('custom-templates-system');
$args['section_title']            = esc_html__('Default Templates', 'narratium');
$args['section_description']     	= sprintf(esc_html__('Select the default templates to use in the site', 'narratium'), get_bloginfo('name'));
$args['section_panel']            = KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_section($args);




/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('post');
$templates = wp_list_pluck($templates, 'name', 'id');


$args                           = array();
$args['option_id']              = KTT_theme_var_name('post_template');
$args['option_name']           	= esc_html__('Post Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in posts pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-simple-sidebar-v2.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('page');
$templates = wp_list_pluck($templates, 'name', 'id');



$args                           = array();
$args['option_id']              = KTT_theme_var_name('page_template');
$args['option_name']           	= esc_html__('Page Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-simple.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);




/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('category');
$templates = wp_list_pluck($templates, 'name', 'id');


$args                           = array();
$args['option_id']              = KTT_theme_var_name('category_template');
$args['option_name']           	= esc_html__('Category Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in category pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-simple-sidebar-v2.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('post_tag');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = KTT_theme_var_name('post_tag_template');
$args['option_name']           	= esc_html__('Tag Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in tag pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-simple-sidebar-v2.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('archive');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = KTT_theme_var_name('archive_template');
$args['option_name']           	= esc_html__('Archive Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in archive pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-simple.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('search');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = KTT_theme_var_name('search_template');
$args['option_name']           	= esc_html__('Search Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in search pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-search.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);


/**
* We define the general options regarding theme templates
*/
$templates = KTT_get_theme_templates_by_type('user');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = KTT_theme_var_name('user_template');
$args['option_name']           	= esc_html__('Author Template', 'narratium');
$args['option_description']     = esc_html__('Select the default template to use in author profile pages.', 'narratium');
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-simple-sidebar-v2.php';
$args['option_section']    			= KTT_theme_var_name('custom-templates-system');
new KTT_new_customize_setting($args);
















/**
* This allow us to load the template options in the customize pages of the administration
*/
function KTT_load_template_option_pages() {

    /**
    * We get the list of theme templates
    */
    $templates = KTT_get_theme_templates();

    /**
    * We plan for each of the templates and include them in the request to load your options...
    */
    $config_mode = true;
    if( current_user_can('administrator')) if ($templates) foreach($templates as $template) {

        /**
        * We created the section
        */
        $args                           	= array();
        $args['section_id']              	= KTT_theme_var_name('template_options_page_' . $template->id);
        $args['section_title']            = esc_html__('Template', 'narratium') . ': ' . $template->name;
        $args['section_description']     	= (isset($template->description) ? $template->description :  '');
        $args['section_panel']            = KTT_theme_var_name('custom-templates-system');
        new KTT_new_customize_section($args);

        /**
        * After creating the section we try to obtain the array of options that the template itself should provide
        */
        $template_options = include($template->path);

        /**
        * This fine filter allows us to add options dynamically to the template from third functions
        */
        $template_options = apply_filters('KTT_theme_template_options',  $template_options, $template);

        /**
        * If we have obtained an array of options, we will go through each of them and add them to the list
        */
        if ($template_options) foreach ($template_options as $option_id => $args) {

              /**
              * If you do not have option_id we will create a
              */
              if (!isset($args['option_id'])) $args['option_id'] = KTT_theme_var_name('template_' . $template->id . '_option_' . $option_id);

              /**
              * If a section has not been indicated, we will create the handle
              */
              if (!isset($args['option_section'])) $args['option_section'] = KTT_theme_var_name('template_options_page_' . $template->id);

              /**
              * We add the option to admin!
              */
              new KTT_new_customize_setting($args);

        }


    }
    $config_mode = false;


}
add_Action('init', 'KTT_load_template_option_pages');
