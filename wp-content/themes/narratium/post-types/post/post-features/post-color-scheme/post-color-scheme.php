<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */





 /**
 * Creation of the metabox_id with the hyper-amazing KTT Framework
 */
 $args = array();
 $args['metabox_id'] 						= 	'post_color_scheme';
 $args['metabox_name']					= 	esc_html__("Color Scheme", 'narratium');
 $args['metabox_post_type'] 		= 	'post';
 $args['metabox_vars'] 					= 	array(
                                       KTT_theme_var_name('post_color_scheme')
                                   );
 $args['metabox_callback']			= 	'KTT_post_color_scheme_meta_box';
 $args['metabox_context']				= 	'side';
 $args['metabox_priority']			= 	'default';
 $metabox = new KTT_new_metabox($args);






// META BOX FORM
function KTT_post_color_scheme_meta_box( $post ) {

    /**
    * We get the color list registered templates
    */
    $schemes = KTT_get_theme_color_schemes();

    /**
    * If there are no templates we show a message indicating that there are not
    */
    if (!$schemes) {
      ?>
      <p>
        <?php esc_html_e("Color schemes not found.",'narratium');?>
      </p>
      <?php return;
    }

    /**
    * This fix allows us to access the posts attribute later on, although
    *  do not have it registered
    */
    if (!isset($post->post_color_scheme)) $post->post_color_scheme = '';

    ?>

    <p>
      <?php esc_html_e("Select a color scheme for this posts.",'narratium');?>
    </p>
    <select name="<?php echo KTT_theme_var_name('post_color_scheme');?>">
      <option value=""><?php esc_html_e('Default', 'narratium');?></option>
      <?php foreach ($schemes as $scheme) {?>
        <option <?php selected($post->post_color_scheme, $scheme['id']);?> value="<?php echo esc_html($scheme['id']);?>"><?php echo esc_html($scheme['name']);?></option>
      <?php } ?>
    </select>

    <p>
      <?php esc_html_e('Color schemes allow you to display the post with custom color schemes.', 'narratium');?>
    </p>

    <?php

}






/**
* With this hook we make sure to add the class to the Post class list
*/
function KTT_add_color_scheme_class_to_post_class($classes) {

    /**
    * We get the full post
    */
    global $post;

    /**
    * If the post does not have a defined template color, we will leave here
    */
    if (!isset($post->post_color_scheme) || !$post->post_color_scheme) return $classes;

    /**
    * We add our color template to the list
    */
    $classes[] = KTT_get_color_scheme_classname($post->post_color_scheme);

    /**
    * Finally, we return the array of classes
    */
    return $classes;
}
add_filter('html_class', 'KTT_add_color_scheme_class_to_post_class', 10, 1);





/**
* This filter is responsible for adding the css to the site
*/
function KTT_add_color_scheme_css_to_post_page($current_css, $pid) {

    /**
    * If we are not on a single page we leave here
    */
    if (!$pid) return $current_css;

    /**
    * We get the post that we are driving
    */
    $post = KTT_get_post($pid);
    if (!$post) return $current_css;
    if ($post->ID != $pid) return $current_css;

    /**
    * If we have not defined a color scheme we left
    */
    if (!isset($post->post_color_scheme)) return $current_css;
    if (!$post->post_color_scheme) return $current_css;

    /**
    * We get the template
    */
    $template_css = KTT_get_theme_color_scheme_css($post->post_color_scheme);

    /**
    * If there is template ...
    */
    if ($template_css) {

        /**
        * We get the template css
        */
        $current_css .= ';' . $template_css;

    }

    /**
    * We return the modified css
    */
    return $current_css;
}
add_action('KTT_print_site_custom_css', 'KTT_add_color_scheme_css_to_post_page', 6, 2);

?>
