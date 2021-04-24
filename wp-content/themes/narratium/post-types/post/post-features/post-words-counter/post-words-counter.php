<?php




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] 				= KTT_var_name('readtime-page');
				$args['page_title'] 		= esc_html__('Read Time','narratium');
				$args['page_description'] 	= '';
				$args['menu_title'] 		= esc_html__('Read Time','narratium');
				$args['menu_order'] 		= 10;
				$args['parent'] 			= 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section for read time

				$args                           	= array();
				$args['section_id']              	= KTT_var_name('read_time');
				$args['section_name']            	= esc_html__('Read Time for articles', 'narratium');
				$args['section_description']     	= esc_html__('Configure the Read Time option for articles.', 'narratium');
				$args['section_page']            	= KTT_var_name('readtime-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = KTT_var_name('post_show_read_time');
				$args['option_name']            = esc_html__('Display Read Time', 'narratium');
				$args['option_label']           = esc_html__('Active the display of the read time option in the articles.', 'narratium');
				$args['option_description']     = esc_html__('Check this option if you want to active read time','narratium');
				$args['option_type']            = 'checkbox';
				$args['option_page']            = KTT_var_name('readtime-page');
				$args['option_page_section']    = KTT_var_name('read_time');
				$args['option_default']			= '1';

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = KTT_var_name('post_read_time_type');
				$args['option_name']            = esc_html__('Display Type', 'narratium');
				$args['option_label']           = esc_html__('Choose display type.', 'narratium');
				$args['option_description']     = esc_html__('Select between display the read time or the number of words.','narratium');
				$args['option_type']            = 'select';
				$args['option_type_vars']       = array(
													'read_time' => esc_html__('Read time','narratium'),
													'words_count' => esc_html__('Words count','narratium')
												);
				$args['option_page']            = KTT_var_name('readtime-page');
				$args['option_page_section']    = KTT_var_name('read_time');
				$args['option_default']			= 'read_time';

				$KTT_new_setting = new KTT_new_setting($args);

}


?>
