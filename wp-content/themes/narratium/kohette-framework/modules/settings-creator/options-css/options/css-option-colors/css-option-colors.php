<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_css_colors_field($option, $current_value) {


  if ($option->option_type != 'css_colors') return;

  ?>

                        <?php foreach ($option->option_type_vars as $key => $val) { ?>

                            <input type="hidden" name="<?php echo wp_kses($option->option_id);?>[<?php echo wp_kses($key);?>][option_id]" value="<?php echo wp_kses($option->option_id);?>">
                            <input type="hidden" name="<?php echo wp_kses($option->option_id);?>[<?php echo wp_kses($key);?>][selector]" value="<?php echo wp_kses($val['selector']);?>">
                            <input type="hidden" name="<?php echo wp_kses($option->option_id);?>[<?php echo wp_kses($key);?>][property]" value="<?php echo wp_kses($val['property']);?>">

                            <label>
                            <input
                            type="color"
                            style="border-radius:2px;height:28px;margin-top:1px;"
                            id="<?php echo wp_kses($option->option_id . $key);?>"
                            name="<?php echo wp_kses($option->option_id) ;?>[<?php echo wp_kses($key);?>][value]"
                            value="<?php echo wp_kses($current_value[$key]['value']);?>">
                            <?php echo (isset($val['label']) ? wp_kses($val['label']) : '');?>
                            </label><br>

                        <?php } ?>


                    <?php


                    if ($option->option_description) {?> <p class="description"><?php echo wp_kses($option->option_description, wp_kses_allowed_html('post'));?></p> <?php }




}
add_action('KTT_settings_option_field', 'KTT_css_colors_field', 2, 2);



// !! register hook, used to save the font settings in the custom style variable
function KTT_css_colors_option_register_hook($option) {
    if ($option->option_type == 'css_colors') add_filter( 'pre_update_option_' . $option->option_id, 'KTT_save_css_option', 10, 2 );
}

add_action('KTT_settings_option_register', 'KTT_css_colors_option_register_hook', 2, 1);
