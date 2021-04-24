<?php
/**
 * Add an slogan input for the site in settings -> general
 *
 */






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = KTT_var_name('website_slogan');
				$args['option_name']            = esc_html__('Website Slogan', 'narratium');
				$args['option_label']           = '';
				$args['option_description']     = esc_html__('This text will be displayed next to the website logo/name.', 'narratium');
				$args['option_type']            = 'wp_editor';
				$args['option_priority']				= 15;
				$args['option_default'] 				= get_bloginfo('description');
				$args['option_type_vars'] 			= array(
																		    	'wpautop' => false,
																		    	'media_buttons' => false,
																		    	'textarea_name' => KTT_var_name('website_slogan'),
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
