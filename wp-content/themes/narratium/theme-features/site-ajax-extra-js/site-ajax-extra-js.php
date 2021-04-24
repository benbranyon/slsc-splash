<?php
/**
* Ajax extra js field.
* Version 1.0
*
* This feature allow users to add extra js code to execute in every ajax request
*/



/**
* This functio is called by the AJAX hook and display the JS code
*/
function KTT_ajax_load_extra_js_finally() {

		/**
		* We load the JS coded inserted by the user in the extra js field
		*/
		$extra_js = get_option(KTT_var_name('ajax_extra_js_finally'));

		/**
		* If we dont have extra js get out of there
		*/
		if (!$extra_js) return;


}
add_action('KTT_theme_ajax_load_content_finally', 'KTT_ajax_load_extra_js_finally');





// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_var_name('ajax_extra_js_finally');
$args['option_name']           	= esc_html__('Extra JS code', 'narratium');
$args['option_description']     = esc_html__('This JS code will be execute at the end of every AJAX request. This field is useful to use with third-party plugins that needs special javascript load/execution in the load of the page.', 'narratium');
$args['option_priority'] 				= 44;
$args['option_type']            = 'wp_editor';
$args['option_type_vars'] 			= array(
																	'wpautop' => false,
																	'media_buttons' => false,
																	'textarea_name' => KTT_var_name('ajax_extra_js_finally'),
																	'textarea_rows' => 5,
																	'quicktags' => false,
																	'tinymce' => false,
																);
$args['option_default'] 				= '';
$args['option_section']    			= KTT_var_name('ajax-navigation');
new KTT_new_customize_setting($args);
