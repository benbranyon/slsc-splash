<?php
/**
 * settings option
 *
 *
 */



/*
* option field
*/
function KTT_wp_editor_field($option, $current_value) {

  if ($option->option_type != 'wp_editor') return;



                    ?>
                    <style>
                        #wp-link-wrap {
                            z-index: 99999999999999;
                        }
                        #wp-link-backdrop {
                            z-index: 99999999999999;
                        }
                        .mce-floatpanel, .mce-toolbar-grp.mce-inline-toolbar-grp {
                          z-index: 99999999999999 !important;
                        }
                    </style>
                    <input
                    type="hidden" <?php $option->link($option->option_id); ?>
                    value="<?php echo esc_textarea( $current_value ); ?>">
                    <?php
                    wp_editor(
                        $current_value,
                        $option->option_id,
                        $option->option_type_vars
                    );

                    /**
                    * This loads the libraries js to be able to activate the editor
                    */
                    do_action('admin_footer');
                    do_action('admin_print_footer_scripts');



                    if ($option->option_description) {?> <p class="description"><?php echo esc_html($option->option_description);?></p> <?php }


}
add_action('KTT_settings_option_field', 'KTT_wp_editor_field', 2, 2);



/*
* Add the required js stuff to detect changes in textareas with tinyMCE
*/
function KTT_Custom_WPEditor_JS(){
	wp_enqueue_script('KTT_wp_editor_setting_customizer', get_parent_theme_file_uri('kohette-framework/modules/settings-creator/options/option-wp_editor/js/customizer.js'), array( 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'KTT_Custom_WPEditor_JS' );
