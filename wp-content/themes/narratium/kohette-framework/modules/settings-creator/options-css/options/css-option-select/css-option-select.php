<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_css_select_field($option, $current_value) {

  if ($option->option_type != 'css_select') return;

  $current_value['selector']  = $option->option_type_vars['selector'];
  $current_value['property']  = $option->option_type_vars['property'];
  $current_value['value']     = $option->option_default['value'];

  /**
  * If we are facing an option customize we load the values that may have saved
  */
  if ($option->value('value')) $current_value['value'] = $option->value('value');



  ?>


                            <?php
                            $style = '';
                            $label = '';

                            ?>

                            <input
                            type="hidden"
                            <?php echo esc_attr($option->link('selector'));?>
                            name="<?php echo esc_attr($option->option_id);?>[selector]"
                            value="<?php echo esc_attr($current_value['selector']);?>">

                            <input
                            type="hidden"
                            <?php echo esc_attr($option->link('property'));?>
                            name="<?php echo esc_attr($option->option_id);?>[property]"
                            value="<?php echo esc_attr($current_value['property']);?>">


                            <select
                            name="<?php echo esc_attr($option->option_id) ;?>[value]"
                            <?php echo esc_html($option->link('value'));?>
                            >

                            <?php foreach ($option->option_type_vars['values'] as $key => $name) {

                                $elem_value = $key;
                                $elem_name  = $name;

                                if (is_array($elem_name)) {
                                    if(isset($name['value'])) $elem_value = $name['value'];
                                    if(isset($name['name'])) $elem_name = $name['name'];
                                }

                                ?>
                                <option <?php if ($current_value['value'] == $elem_value) {?>selected<?php } ?> value="<?php echo esc_attr($elem_value);?>"><?php echo esc_attr($elem_name);?></option>
                            <?php } ?>

                            </select>





                    <?php


                    if ($option->option_description) {?> <p class="description"><?php echo esc_html($option->option_description);?></p> <?php }




}
add_action('KTT_settings_option_field', 'KTT_css_select_field', 2, 2);
