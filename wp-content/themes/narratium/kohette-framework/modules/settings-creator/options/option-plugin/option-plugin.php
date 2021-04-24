<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_plugin_field($option, $current_value) {

  if ($option->option_type != 'plugin') return;

  global $KTT_plugins;

  ?>
                  <h4 style="pading:0;margin:0"><?php echo esc_attr($KTT_plugins[$current_value['ID']]['Name']);?></h4>
                  <p style=""><?php echo esc_attr($KTT_plugins[$current_value['ID']]['Description']);?></p>
                  <p style="padding-bottom:5px">Version <?php echo esc_attr($KTT_plugins[$current_value['ID']]['Version']);?></p>

                  <input type="hidden" name="<?php echo esc_attr($option->option_id) ;?>[ID]" value="<?php echo esc_attr($current_value['ID']);?>">

                  <select
                  style="<?php echo esc_html($option->option_style);?>"
                  id="<?php echo esc_attr($option->option_id);?>"
                  name="<?php echo esc_attr($option->option_id) ;?>[Status]"
                  >
                    <option <?php if (strtolower($current_value['Status']) == 'enabled') {?>selected<?php } ?> value="Enabled"><?php echo esc_html('Enabled');?></option>
                    <option <?php if (strtolower($current_value['Status']) == 'disabled') {?>selected<?php } ?> value="Disabled"><?php echo esc_html('Disabled');?></option>
                  </select>


                  <?php if ($option->option_description) {?> <p class="description"><?php echo esc_html($option->option_description);?></p> <?php } ?>





  <?php



}
add_action('KTT_settings_option_field', 'KTT_plugin_field', 2, 2);
