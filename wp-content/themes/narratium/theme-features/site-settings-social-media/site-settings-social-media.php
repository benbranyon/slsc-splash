<?php

/**
* This function returns an array with all the social links that the site can have
*/
function KTT_social_media_available_options() {

  /**
  * create the array
  */
  $result = array(

      'mail' => array(
        'id' => 'mail',
        'name' => 'Mail address',
        'regex' => '//',
        'share_url' => 'mailto:%value%',
        'option_caption' => esc_html__('Mail contact address', 'narratium'),
        'option_description' => esc_html__('Insert your contact email address', 'narratium'), // msg displayed in admin options
        'share_action' => esc_html__('Contact email', 'narratium'),
        'value' => '',
      ),

      'facebook' => array(
        'id' => 'facebook',
        'name' => 'Facebook',
        'regex' => '//',
        'share_url' => 'https://facebook.com/%value%',
        'option_caption' => esc_html__('Facebook username', 'narratium'),
        'option_description' => esc_html__('Insert your username in Facebook', 'narratium'), // msg displayed in admin options
        'share_action' => esc_html__('Share on Facebook', 'narratium'),
        'value' => '',
      ),

      'twitter' => array(
        'id' => 'twitter',
        'name' => 'Twitter',
        'regex' => '//',
        'share_url' => 'https://twitter.com/%value%',
        'option_caption' => esc_html__('Twitter username', 'narratium'),
        'option_description' => esc_html__('Insert your username in Twitter', 'narratium'), // msg displayed in admin options
        'share_action' => esc_html__('Tweet this', 'narratium'),
        'value' => '',
      ),

      'instagram' => array(
        'id' => 'instagram',
        'name' => 'Instagram',
        'regex' => '//',
        'share_url' => 'https://instagram.com/%value%',
        'option_caption' => esc_html__('Instagram username', 'narratium'),
        'option_description' => esc_html__('Insert your username in Instagram', 'narratium'), // msg displayed in admin options
        'share_action' => esc_html__('Share on Instagram', 'narratium'),
        'value' => '',
      ),

      'linkedin' => array(
        'id' => 'linkedin',
        'name' => 'Linkedin',
        'regex' => '//',
        'share_url' => 'https://linkedin.com/in/%value%',
        'option_caption' => esc_html__('Linkedin username', 'narratium'),
        'option_description' => esc_html__('Insert your username in Linkedin', 'narratium'), // msg displayed in admin options
        'share_action' => esc_html__('Share on Linkedin', 'narratium'),
        'value' => '',
      ),

      'pinterest' => array(
        'id' => 'pinterest',
        'name' => 'Pinterest',
        'regex' => '//',
        'share_url' => 'https://pinterest.com/%value%0',
        'option_caption' => esc_html__('Pinterest username', 'narratium'),
        'option_description' => esc_html__('Insert your username in Pinterest', 'narratium'), // msg displayed in admin options
        'share_action' => esc_html__('Share on Pinterest', 'narratium'),
        'value' => '',
      ),

  );


  /**
  * return the options array
  */
  return $result;

}




/**
* This function is in charge of obtaining the social links of the site, for that it obtains the array of the KTT_social_media_available_options function and completes it with the social links that it finds in options
*/
function KTT_get_site_social_media() {

    /**
    * We obtain the array of available options
    */
    $options = KTT_social_media_available_options();

    /**
    * We plan for each of the options and look for a value in the database
    */
    foreach ($options as $option_id => $option) {

        /**
        * We look for a value
        */
        $value = get_option(KTT_var_name('site_social_id_' . $option_id));

        /**
        * If we have not found anything, we go from here to the next
        */
        if (!$value) continue;

        /**
        * We add the value to the array
        */
        $options[$option_id]['value'] = $value;

        /**
        * We correct the share link
        */
        $options[$option_id]['share_url'] = str_replace('%value%', $value, $options[$option_id]['share_url']);

    }

    /**
    * We return the array of options
    */
    return $options;
}








// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------


                // create a page to inset the social media vars of the main site
                // add page to theme options

                $args = array();
                $args['id'] = KTT_var_name('social-media-site-page');
                $args['page_title'] = 'Social Media';
                $args['page_description'] = esc_html__('Fill these fields to make the site and the articles fully shareables in social media sites.', 'narratium');
                $args['menu_title'] = 'Social Media';
                $args['menu_order'] = 3;
                $args['parent'] = 'theme-options';

                $new_admin_submenu = new KTT_admin_submenu($args);



/**
* We create an option for each value of the array of available options
*/
$options = KTT_social_media_available_options();
if (!$options) return;
foreach ($options as $option) {

    $n = 500;
    $args                           = array();
    $args['option_id']              = KTT_var_name('site_social_id_' . $option['id']);
    $args['option_name']            = $option['option_caption'];
    $args['option_label']           = '';
    $args['option_description']     = $option['option_description'];
    $args['option_type']            = 'text';
    $args['option_priority']				= $n;
    $args['option_page']            = KTT_var_name('social-media-site-page');
    $args['option_section']         = 'title_tagline';

    $KTT_new_setting = new KTT_new_setting($args);
    $n += 1;

}





/**
* With this we take care of having an option in site identity where you can select which social networks appear on the site
*/
$options = KTT_social_media_available_options();
$options = wp_list_pluck($options, 'name', 'id');
$args                           = array();
$args['option_id']              = KTT_var_name('site_display_social_media');
$args['option_name']            = "Social Media Links";
$args['option_label']           = '';
$args['option_description']     = sprintf(esc_html__("Select social media links to display them under the site title. You can configure the social media links of %s in Theme Options > Social Media", 'narratium'), get_bloginfo('name'));
$args['option_type']            = 'checkboxes';
$args['option_priority']				= 500;
$args['option_type_vars']		    = $options;
$args['option_section']         = 'title_tagline';
new KTT_new_customize_setting($args);
