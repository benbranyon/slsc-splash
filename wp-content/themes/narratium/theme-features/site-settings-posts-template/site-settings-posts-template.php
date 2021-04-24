<?php


// add option to admin panel

$templates = KTT_get_theme_templates_by_type('frontpage');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = KTT_theme_var_name('frontpage_posts_template');
$args['option_name']            = esc_html__('Posts frontpage', 'narratium');
$args['option_label']           = esc_html__('Select a template to display posts.', 'narratium');
$args['option_description']     = esc_html__('Select a template to display your latest posts', 'narratium');
$args['option_type']            = 'select';
$args['option_priority']        = 12;
$args['option_type_vars']       = $templates;
$args['option_default'] 		    = key($templates);
$args['option_page']            = 'reading';
$args['option_section']         = 'static_front_page';

$KTT_new_setting = new KTT_new_setting($args);
new KTT_new_customize_setting($args);







 ?>
