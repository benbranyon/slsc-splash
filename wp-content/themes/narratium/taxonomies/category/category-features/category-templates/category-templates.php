<?php


/**
* We obtain the templates available for the categories
*/
$templates = KTT_get_theme_templates_by_type('category');
$templates = wp_list_pluck($templates, 'name', 'id');
$templates[''] = 'Default';


// add featured image option to category admin pages
$args                          	 = array();
$args['taxmeta_taxonomy']        = 'category';
$args['taxmeta_id']              = KTT_theme_var_name('category_template');
$args['taxmeta_name']            = esc_html__('Template', 'narratium');
$args['taxmeta_description']     = esc_html__('Select a template for this category.', 'narratium');
$args['taxmeta_default']         = get_option(KTT_theme_var_name('category_template'));
$args['taxmeta_type']            = 'select';
$args['taxmeta_type_vars'] 		   = $templates;

$KTT_new_taxonomy_meta = new KTT_new_taxonomy_meta($args);









/**
* we create the column
*/
function KTT_add_template_column_to_category( $columns ){
    $columns['template'] = esc_html__('Template', 'narratium');
    return $columns;
}
add_filter( "manage_edit-category_columns", 'KTT_add_template_column_to_category', 10);



function KTT_add_template_column_to_category_content( $value, $column_name, $term_id ){
     if ($column_name == 'template') {

          /**
          * We get the template
          */
          $template = KTT_get_category_template($term_id);

          /**
          * We show the results
          */
          echo esc_html($template->name);

     }
}
add_action( "manage_category_custom_column", 'KTT_add_template_column_to_category_content', 10, 3);
