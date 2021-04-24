<?php





/**
* This function will add an option to customize image heights in
* some Templates
*/
function KTT_add_posts_order_setting_to_templates($template_options, $template) {


    /**
    * if e detect the display/hide option in the template wewill add the read time
    * checkbox to the array of options
    */
    if (array_intersect($template->types, array('post_tag', 'category', 'frontpage'))) {


          /**
          * Posts per page
          */
          $template_options['posts_order']['option_name']             = esc_html__('Posts order', 'narratium');
          $template_options['posts_order']['option_description']      = esc_html__("Designates the ascending or descending order of the items displayed by this template.", 'narratium');
          $template_options['posts_order']['option_priority'] 	      = 2;
          $template_options['posts_order']['option_type']             = 'select';
          $template_options['posts_order']['option_type_vars']			  = array(
                                                                          '' => esc_html__("default", 'narratium'),
                                                                          'DESC' => esc_html__("DESC", 'narratium'),
                                                                          'ASC' => esc_html__("ASC", 'narratium'),
                                                                        );
          $template_options['posts_order']['option_default']					= '';



    }

    /**
    * We return the template options array
    */
    return $template_options;

}
add_filter('KTT_theme_template_options', 'KTT_add_posts_order_setting_to_templates', 2, 2);








/**
* This function hook allows us to modify the posts order option of the current
* page if is in use anu template with this option confgured
*/
function KTT_template_setting_custom_posts_order( $query ) {

    /**
    * Not the main query? get out
    */
    if ( !$query->is_main_query() ) return;

    /**
    * We get the tempalte for this page
    */
    $template = KTT_get_current_theme_template();

    /**
    * If we have not a template then return
    */
    if (!$template) return;

    /**
    * We get the saved template options
    */
    $template_options = KTT_get_template_options($template->id);

    /**
    * We look into the tempalte options to find the post_per_page option
    * if we found the option, then que mod the $query
    */
    if (isset($template_options['posts_order']) && $template_options['posts_order']) $query->set('order', $template_options['posts_order']);

}
if (!is_admin()) add_action( 'pre_get_posts', 'KTT_template_setting_custom_posts_order' );


?>
