<?php
/**
 * Customize options for the theme
 *
 */




 // --------------------------------------------------------------------------------------------------------------
 // options form for the admin pages
 // --------------------------------------------------------------------------------------------------------------



 				// add page to theme options

 				$args = array();
 				$args['panel_id'] 						= KTT_var_name('customize-typography');
 				$args['panel_title'] 					= esc_html__('Fonts & Typography','narratium');
 				$args['panel_description'] 		= esc_html__("Customize the theme's typography related elements.", 'narratium');
 				$args['panel_priority'] 			= 1;
 				new KTT_new_customize_panel($args);





 				/**
 				* A section helps us organize the elements of the page
 				*/

 				$args                           	= array();
 				$args['section_id']              	= KTT_var_name('site-typefaces');
 				$args['section_title']            = esc_html__('Typography Typefaces', 'narratium');
 				$args['section_description']     	= sprintf(esc_html__('Select the custom typefaces to use in %s.', 'narratium'), get_bloginfo('name'));
 				$args['section_panel']            = KTT_var_name('customize-typography');
 				new KTT_new_customize_section($args);







 				// add option to admin panel

 				$args                           = array();
 				$args['option_id']              = KTT_var_name('site_typeface_title');
 				$args['option_name']           = esc_html__('Titles typeface', 'narratium');
 				$args['option_description']     = esc_html__('This is the typeface used in titles.', 'narratium');
 				$args['option_priority'] 				= 1;
 				$args['option_type']            = 'font';
 				$args['option_type_vars']				= array(
 																					'selector' => '.site-typeface-title, site-typeface-title-1, site-typeface-title-2, site-typeface-title-3',
 																					'font_family' => true,

 																					);
 				$args['option_default'] 				= array(
 																					'font_family' => 'playfair+display',
 																					'font_weight' => 'regular',
 																					'load_all_weights' => true,
 																					);
 				$args['option_section']    			= KTT_var_name('site-typefaces');
 				new KTT_new_customize_setting($args);







 				// add option to admin panel

 				$args                           = array();
 				$args['option_id']              = KTT_var_name('site_typeface_headline');
 				$args['option_name']           = esc_html__('Headlines typeface', 'narratium');
 				$args['option_description']     = esc_html__('This is the typeface used by headlines and subtitles.', 'narratium');
 				$args['option_type']            = 'font';
 				$args['option_priority'] 				= 2;
 				$args['option_type_vars']				= array(
 																						'selector' => '.site-typeface-headline',
 																						'font_family' => true,
 																				);
 				$args['option_default'] 				= array(
 																						'font_family' => 'lato',
 																						'font_weight' => 'regular',
 																						'load_all_weights' => true,
 																				);
 				$args['option_section']    			= KTT_var_name('site-typefaces');;
 				new KTT_new_customize_setting($args);







 				// add option to admin panel

 				$args                           = array();
 				$args['option_id']              = KTT_var_name('site_typeface_content');
 				$args['option_name']           = esc_html__('Content typeface', 'narratium');
 				$args['option_description']     = esc_html__('This is the typeface used in post/page contents.', 'narratium');
 				$args['option_type']           	= 'font';
 				$args['option_priority'] 				= 3;
 				$args['option_type_vars']		= array(
 																					'selector' => '.site-typeface-content',
 																					'font_family' => true,
 																				);
 				$args['option_default'] 				= array(
 																					'font_family' => 'pt+serif',
 																					'font_weight' => 'regular',
 																					'load_all_weights' => true,
 																				);

 				$args['option_section']    			= KTT_var_name('site-typefaces');;
 				new KTT_new_customize_setting($args);









 				// add option to admin panel

 				$args                           = array();
 				$args['option_id']              = KTT_var_name('site_typeface_body');
 				$args['option_name']           = esc_html__('Body typeface', 'narratium');
 				$args['option_description']     = esc_html__('This is the typeface used by default in the site.', 'narratium');
 				$args['option_type']            = 'font';
 				$args['option_priority'] 				= 4;
 				$args['option_type_vars']		= array(
 																					'selector' => '.site-typeface-body',
 																					'font_family' => true,
 																				);
 				$args['option_default'] 				= array(
 																					'font_family' => 'lato',
 																					'font_weight' => 'regular',
 																					'load_all_weights' => true,
 																				);
 				$args['option_section']    			= KTT_var_name('site-typefaces');;
 				new KTT_new_customize_setting($args);




















 				/**
 				* A section helps us organize the elements of the page
 				*/

 				$args                           	= array();
 				$args['section_id']              	= KTT_var_name('custom-typography-basic-section');
 				$args['section_title']            = esc_html__('Basic Typography', 'narratium');
 				$args['section_description']     	= esc_html__('Configure the basic typography of the site.', 'narratium');
 				$args['section_panel']            = KTT_var_name('customize-typography');
 				new KTT_new_customize_section($args);









 				// add option to admin panel

 				$args                           	= array();
 				$args['option_id']              	= KTT_var_name('typo_style_body');
 				$args['option_name']            	= esc_html__('Default site font', 'narratium');
 				$args['option_description']     	= esc_html__('This is the font used in the entire site by default.', 'narratium');
 				$args['option_type']            	= 'font';
 				$args['option_priority'] 					= 1;
 				$args['option_type_vars']					= array(
 																						'selector' => 'html, body',
 																						'font_size' => true,
 																						'line_height' => true,
 																						'font_family' => false,
 																					);
 				$args['option_default'] 					= array(
 																						'font_size' => '18',
 																						'font_size_unit' => 'px',
 																						'line_height' => '1.4',
 																					);
 				$args['option_section']    				= KTT_var_name('custom-typography-basic-section');;
 				new KTT_new_customize_setting($args);





 				// add option to admin panel ----------------------------------------------------------------

 				$args                           	= array();
 				$args['option_id']              	= KTT_var_name('typo_style_h1');
 				$args['option_name']            	= esc_html__('Headline 1', 'narratium');
 				$args['option_description']     	= esc_html__('Adjust the size and line height used in h1 tags.', 'narratium');
 				$args['option_type']            	= 'font';
 				$args['option_priority'] 					= 2;
 				$args['option_type_vars']					= array(
 																						'selector' => 'body h1',
 																						'font_size' => true,
 																						'font_family' => false,
 																						'line_height' => true,
 																					);
 				$args['option_default'] 					= array(
 																						'font_size' => '2.2',
 																						'font_size_unit' => 'em',
 																						'line_height' => '1.1',
 																						'font_family' => '',
 																						'font_weight' => 'regular'
 																					);
 				$args['option_section']    				= KTT_var_name('custom-typography-basic-section');;
 				new KTT_new_customize_setting($args);




 				// add option to admin panel ----------------------------------------------------------------

 				$args                           	= array();
 				$args['option_id']              	= KTT_var_name('typo_style_h2');
 				$args['option_name']            	= esc_html__('Headline 2', 'narratium');
 				$args['option_description']     	= esc_html__('Adjust the size and line height used in h2 tags.', 'narratium');
 				$args['option_type']            	= 'font';
 				$args['option_priority'] 					= 3;
 				$args['option_type_vars']					= array(
 																						'selector' => 'body h2',
 																						'font_size' => true,
 																						'font_family' => false,
 																						'line_height' => true,
 																					);
 				$args['option_default'] 					= array(
 																						'font_size' => '2',
 																						'font_size_unit' => 'em',
 																						'line_height' => '1.1',
 																						'font_family' => '',
 																						'font_weight' => 'regular'
 																					);
 				$args['option_section']    				= KTT_var_name('custom-typography-basic-section');;
 				new KTT_new_customize_setting($args);




 				// add option to admin panel ----------------------------------------------------------------

 				$args                           	= array();
 				$args['option_id']              	= KTT_var_name('typo_style_h3');
 				$args['option_name']            	= esc_html__('Headline 3', 'narratium');
 				$args['option_description']     	= esc_html__('Adjust the size and line height used in h3 tags.', 'narratium');
 				$args['option_type']            	= 'font';
 				$args['option_priority'] 					= 4;
 				$args['option_type_vars']					= array(
 																						'selector' => 'body h3',
 																						'font_size' => true,
 																						'font_family' => false,
 																						'line_height' => true,
 																					);
 				$args['option_default'] 					= array(
 																						'font_size' => '1.8',
 																						'font_size_unit' => 'em',
 																						'line_height' => '1.1',
 																						'font_family' => '',
 																						'font_weight' => 'regular'
 																					);
 				$args['option_section']    				= KTT_var_name('custom-typography-basic-section');;
 				new KTT_new_customize_setting($args);








 				/**
 				* A section helps us organize the elements of the page
 				*/
 				$args                           	= array();
 				$args['section_id']              	= KTT_var_name('custom-typography-body-section');
 				$args['section_title']            = esc_html__('Post/Pages Typography', 'narratium');
 				$args['section_description']     	= esc_html__('Configure the typography of the site used by default in posts and pages.', 'narratium');
 				$args['section_panel']            = KTT_var_name('customize-typography');
 				new KTT_new_customize_section($args);




 				// add option to admin panel

 				$args                           	= array();
 				$args['option_id']              	= KTT_var_name('typo_style_content');
 				$args['option_name']            	= esc_html__('Content', 'narratium');
 				$args['option_description']     	= esc_html__('Adjust the font style of text used in main contents of the site. This font style is used in the body content of posts and pages by default.', 'narratium');
 				$args['option_type']            	= 'font';
 				$args['option_priority'] 					= 10;
 				$args['option_type_vars']					= array(
 																						'selector' => '.typo-size-content',
 																						'font_size' => true,
 																						'line_height' => true,
 																						'font_family' => false,
 																					);
 				$args['option_default'] 					= array(
 																						'font_size' => '21',
 																						'font_size_unit' => 'px',
 																						'line_height' => '1.6',
 																					);
 				$args['option_section']    				= KTT_var_name('custom-typography-body-section');;
 				new KTT_new_customize_setting($args);



?>
