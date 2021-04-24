<?php


// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_theme_var_name('site_menu_behaviour');
$args['option_name']            = esc_html__('Logo/Menu Icon behaviour', 'narratium');
$args['option_label']           = esc_html__('You can change the behaviour and look of the main site logo and menu handle of the site.', 'narratium');
$args['option_description']     = esc_html__('You can change the behaviour and look of the main site logo and menu handle of the site.', 'narratium');
$args['option_type']            = 'select';
$args['option_priority']        = 14;
$args['option_type_vars']       = array(
                                    'logo_and_menu_handle' => esc_html__("Display site logo and menu handle next to it.", 'narratium'),
                                    'logo_as_menu_handle' => esc_html__("Display just the site logo has menu handle.", 'narratium'),
                                  );
$args['option_default'] 		    = 'logo_and_menu_handle';
$args['option_page']            = 'reading';
$args['option_section']         = 'static_front_page';

$KTT_new_setting = new KTT_new_setting($args);
new KTT_new_customize_setting($args);







 ?>
