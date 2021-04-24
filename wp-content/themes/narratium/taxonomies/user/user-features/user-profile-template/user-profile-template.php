<?php
/**
 * background image for users.
 *
 */





/**
* This function is responsible for displaying the input on the administration page
*  of user editing
*/
function KTT_add_user_template( $user ) {

    /**
    * The nanay subscribers
    */
    if ( current_user_can( 'subscriber' ) )
      return FALSE;

    /**
    * We obtain the complete list of templates that can be used
    * in user profiles
    */
    $templates = KTT_get_theme_templates_by_type('user');

    /**
    * We obtain the template that the user must have
    */
    $template_id = KTT_get_user_saved_template_id($user->ID);

    ?>

  	<table class="form-table">
  		<tr>
  			<th>
  				<label for="address"><?php esc_html_e('Profile template', 'narratium'); ?>
  			</label></th>
  			<td>

  					<select name="<?php echo esc_attr(KTT_theme_var_name('user_template'));?>">
              <option value="">Default</option>
              <?php foreach ($templates as $template) {?>
                <option <?php selected($template->id, $template_id);?> value="<?php echo esc_attr($template->id);?>"><?php echo esc_html($template->name);?></option>
              <?php } ?>
            </select>

  				<p class="description"><?php esc_html_e('Select a template to use in the profile page of this user.', 'narratium'); ?></p>

  			</td>
  		</tr>
  	</table>
<?php }







function KTT_save_user_template( $user_id ) {

    	  if ( !current_user_can( 'edit_user', $user_id ) ) return FALSE;
        update_user_meta( $user_id, KTT_theme_var_name('user_template'), $_POST[KTT_theme_var_name('user_template')] );

}

add_action( 'show_user_profile', 'KTT_add_user_template' );
add_action( 'edit_user_profile', 'KTT_add_user_template' );

add_action( 'personal_options_update', 'KTT_save_user_template' );
add_action( 'edit_user_profile_update', 'KTT_save_user_template' );
