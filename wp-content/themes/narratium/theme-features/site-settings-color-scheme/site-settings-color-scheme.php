<?php


// add option to admin panel

$schemes = KTT_get_theme_color_schemes();
$schemes = wp_list_pluck($schemes, 'name', 'id');

$args                           = array();
$args['option_id']              = KTT_theme_var_name('site_color_scheme');
$args['option_name']            = esc_html__('Site color scheme', 'narratium');
$args['option_label']           = esc_html__('Select a color scheme for this site.', 'narratium');
$args['option_description']     = esc_html__('Select a color scheme for this site.', 'narratium');
$args['option_type']            = 'select';
$args['option_priority']        = 15;
$args['option_type_vars']       = $schemes;
$args['option_default'] 		    = 'sand';
$args['option_page']            = 'reading';
$args['option_section']         = 'colors';

$KTT_new_setting = new KTT_new_setting($args);
new KTT_new_customize_setting($args);








/**
* This filter is responsible for adding the css to the site
*/
function KTT_add_color_scheme_css_to_site($current_css) {

    /**
    * We get the option that contains the base color of the site
    */
    $color_scheme_id = get_option(KTT_theme_var_name('site_color_scheme'), 'default');

    /**
    * We get the template
    */
    $scheme_css = KTT_get_theme_color_scheme_css($color_scheme_id);

    /**
    * If there is scheme ...
    */
    if ($scheme_css) {

        /**
        * We get the css of the scheme
        */
        $current_css .=  $scheme_css;

    }

    /**
    * We return the modified css
    */
    return $current_css;
}
add_action('KTT_add_site_custom_css', 'KTT_add_color_scheme_css_to_site', 5, 1);


 ?>
