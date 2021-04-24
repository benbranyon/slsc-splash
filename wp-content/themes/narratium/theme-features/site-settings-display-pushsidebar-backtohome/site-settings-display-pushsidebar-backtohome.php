<?php


// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_theme_var_name('site_display_sidebar_backtohome');
$args['option_name']            = esc_html__('Display sidebar go-back-to-home button', 'narratium');
$args['option_label']           = esc_html__('Hide or display the back-to-home button in the main sidebar of the site.', 'narratium');
$args['option_description']     = esc_html__('Hide or display the back-to-home button in the main sidebar of the site.', 'narratium');
$args['option_type']            = 'checkbox';
$args['option_priority']        = 15;
$args['option_default'] 		    = true;
$args['option_page']            = 'reading';
$args['option_section']         = 'static_front_page';

$KTT_new_setting = new KTT_new_setting($args);
new KTT_new_customize_setting($args);







 ?>
