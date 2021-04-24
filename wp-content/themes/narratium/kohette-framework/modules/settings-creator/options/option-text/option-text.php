<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_text_field($option, $current_value) {

  if (!in_array($option->option_type, array('text', 'number', 'date', 'time'))) return;

  ?>

                    <input
                    type="<?php echo esc_attr($option->option_type);?>"
                    step="any"
                    style="<?php echo esc_html($option->option_style);?>"
                    class="regular-text ltr"
                    id="<?php echo esc_attr($option->option_id);?>"
                    name="<?php echo esc_attr($option->option_id);?>"
                    <?php $option->link($option->option_id);?>
                    value="<?php echo esc_html($current_value) ;?>">

                    <?php echo esc_html($option->option_label);?>

                    <?php if ($option->option_description) {?> <p class="description"><?php echo esc_html($option->option_description);?></p> <?php } ?>


                    <?php


}
add_action('KTT_settings_option_field', 'KTT_text_field', 2, 2);
