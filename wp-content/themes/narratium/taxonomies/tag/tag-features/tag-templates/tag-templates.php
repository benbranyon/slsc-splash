<?php


/**
* We obtain the templates available for the categories
*/
$templates = KTT_get_theme_templates_by_type('post_tag');
$templates = wp_list_pluck($templates, 'name', 'id');
$templates[''] = 'Default';


// add featured image option to post_tag admin pages
$args                          	 = array();
$args['taxmeta_taxonomy']        = 'post_tag';
$args['taxmeta_id']              = KTT_theme_var_name('post_tag_template');
$args['taxmeta_name']            = esc_html__('Template', 'narratium');
$args['taxmeta_description']     = esc_html__('Select a template for this tag.', 'narratium');
$args['taxmeta_default']         = KTT_get_theme_option('post_tag_template');
$args['taxmeta_type']            = 'select';
$args['taxmeta_type_vars'] 		   = $templates;

$KTT_new_taxonomy_meta = new KTT_new_taxonomy_meta($args);





/**
* we create the column
*/
function KTT_add_template_column_to_post_tag( $columns ){
    $columns['template'] = esc_html__('Template', 'narratium');
    return $columns;
}
add_filter( "manage_edit-post_tag_columns", 'KTT_add_template_column_to_post_tag', 10);



function KTT_add_template_column_to_post_tag_content( $value, $column_name, $term_id ){
     if ($column_name == 'template') {

          /**
          * We get the template
          */
          $template = KTT_get_post_tag_template($term_id);

          /**
          * We get the template
          */
          echo esc_html($template->name);

     }
}
add_action( "manage_post_tag_custom_column", 'KTT_add_template_column_to_post_tag_content', 10, 3);
