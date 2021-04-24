<?php





/**
* With this we take care of having an option in site identity where can select which social networks will appear on the site...
*/
$options = array(
  '100%' => '100%',
  '75%' => '75%',
  '50%' => '50%',
  '25%' => '25%',
  '' => esc_html__("Don't display", 'narratium')
);
$args                           = array();
$args['option_id']              = KTT_theme_var_name('site_logo_size');
$args['option_name']            = "Logo size";
$args['option_label']           = '';
$args['option_description']     = sprintf(esc_html__("Select a size to display the site logo.", 'narratium'), get_bloginfo('name'));
$args['option_type']            = 'select';
$args['option_priority']				= 11;
$args['option_default']         = '100%';
$args['option_type_vars']		    = $options;
$args['option_section']         = 'title_tagline';
new KTT_new_customize_setting($args);
