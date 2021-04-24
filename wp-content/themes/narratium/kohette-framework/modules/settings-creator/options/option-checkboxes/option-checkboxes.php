<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_checkboxes_field($option, $current_value) {

  if ($option->option_type != 'checkboxes') return;

  print_r(get_option(KTT_var_name('template_displays')));

  ?>

                        <?php foreach ($option->option_type_vars as $key => $val) {

                            ?>
                            <label>

                                <input
                                type="checkbox"
                                <?php $option->link($key);?>
                                style="<?php echo (isset($option->option_style) ? $option->option_style : '') ;?>"
                                name="<?php echo esc_html($option->option_id) ;?>[<?php echo esc_html($key);?>]"
                                <?php  checked( $current_value ); ?>
                                value="<?php echo esc_html($option->value($key));?>">


                                <?php echo esc_html($val);?>

                            </label><br>

                        <?php } ?>


                    <?php


                    if ($option->option_description) {?> <p class="description"><?php echo esc_html($option->option_description);?></p> <?php }




}
add_action('KTT_settings_option_field', 'KTT_checkboxes_field', 2, 2);
