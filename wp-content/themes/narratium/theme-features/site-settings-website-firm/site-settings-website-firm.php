<?php
/**
 * Add a little firm/copyright text for the site in settings -> general
 *
 */




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------



				$args                           = array();
				$args['option_id']              = KTT_var_name('website_firm');
				$args['option_name']            = esc_html__('Website Firm', 'narratium');
				$args['option_label']           = '';
				$args['option_description']     = esc_html__('This text will appear in the bottom of the site. You can use it to display information about copyright and disclaimer message.', 'narratium');
				$args['option_type']            = 'wp_editor';
				$args['option_priority']				= 20;
				$args['option_default'] 				= '';
				$args['option_type_vars'] 			= array(
																		    	'wpautop' => false,
																		    	'media_buttons' => false,
																		    	'textarea_name' => KTT_var_name('website_firm'),
																		    	'textarea_rows' => 2,
																		    	'quicktags' => false,
																		    	'tinymce' => array(
																		        				'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor',
																										'toolbar2'=> '',
              																			'toolbar3'=> '',
              																			'toolbar4'=> '',
																		      	)
												      					);
				$args['option_section']         = 'title_tagline';
				new KTT_new_customize_setting($args);


?>
