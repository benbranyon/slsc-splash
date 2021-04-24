<?php


// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_var_name('ajax_transition_animations');
$args['option_name']           	= esc_html__('Transition Animations', 'narratium');
$args['option_description']     = esc_html__('Check this option to active the transition animations for AJAX navigation', 'narratium');
$args['option_priority'] 				= 41;
$args['option_type']            = 'checkbox';
$args['option_default'] 				= 1;
$args['option_section']    			= KTT_var_name('ajax-navigation');
//new KTT_new_customize_setting($args);





$effects = KTT_get_ajax_animations_effects();
$effects = wp_list_pluck($effects, 'name', 'id');
$effects[''] = esc_html__('No animation', 'narratium');

// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_var_name('ajax_transition_animation');
$args['option_name']           	= esc_html__('Transition Effect', 'narratium');
$args['option_description']     = esc_html__('Select an animation effect to use in AJAX transitions', 'narratium');
$args['option_priority'] 				= 42;
$args['option_type']            = 'select';
$args['option_type_vars']       = $effects;
$args['option_default'] 		    = "lateralswipe.php" ;//key($effects);
$args['option_section']    			= KTT_var_name('ajax-navigation');
new KTT_new_customize_setting($args);


 ?>
