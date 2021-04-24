<?php

function KTT_add_profile_avatar( $user ) {

  /**
  * Los subscribers nanay
  */
  if ( current_user_can( 'subscriber' ) )
    return FALSE;

  $var_id = KTT_var_name('user_avatar');

  $value = get_user_meta($user->ID, KTT_var_name('user_avatar'), true);

  $image = get_post($value);
  if (!$image) {
      $value = '';
  } else {
      $image_src = wp_get_attachment_url( $value );
  }

  wp_enqueue_media();
  wp_enqueue_script('media-upload');

?>

	<table class="form-table">
		<tr>
			<th>
				<label for="address"><?php esc_html_e('Profile avatar', 'narratium'); ?>
			</label></th>
			<td>

					<div id="upload-field-<?php echo esc_attr($var_id);?>">

                        <div  style="margin-bottom:20px;<?php if (!$value) {?>display:none;<?php } ?>"  class="show-on-image">

                            <img alt="<?php echo esc_attr__('Profile avatar image', 'narratium');?>" id="uploaded-image-<?php echo esc_attr($var_id);?>" style="display:block;max-height:160px;max-width:500px;" src="<?php echo esc_url($image_src);?>">

                        </div>

                       <span
                       data-uploader_title="<?php echo esc_attr__('Profile avatar image', 'narratium');?>"
                       id="upload-button-<?php echo esc_attr($var_id);?>"
                       class="button button-primary">
                            <?php esc_html_e('Select image', 'narratium');?>
                       </span>


                	     <span
                       <?php if (!$value) {?>style="display:none;"<?php } ?>
                       id="remove-button-<?php echo esc_attr($var_id);?>"
                       onclick="jQuery('#upload-field-<?php echo esc_attr($var_id);?> .show-on-image').hide();jQuery('#upload-image-<?php echo esc_attr($var_id);?>').val('');"
                       class="show-on-image button button-secondary">
                            <?php esc_html_e('Remove','narratium');?>
                       </span>



                        <input
                        id="upload-image-<?php echo esc_attr($var_id);?>"
                        type="hidden"
                        id="<?php echo esc_attr($var_id) ;?>"
                        name="<?php echo esc_attr($var_id) ;?>"
                        value="<?php echo esc_html($value);?>">




                    </div>

                	<script>

                    // Uploading files
                    var file_frame;

                      jQuery('#upload-button-<?php echo esc_attr($var_id);?>').on('click', function( event ){

                        event.preventDefault();

                        button = jQuery(this);


                        // Create the media frame.
                        file_frame = wp.media.frames.file_frame = wp.media({
                          title: jQuery( this ).data( 'uploader_title' ),
                          button: {
                            text: jQuery( this ).data( 'uploader_button_text' ),
                          },
                          multiple: false  // Set to true to allow multiple files to be selected
                        });

                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                          // We set multiple to false so only get one image from the uploader
                          attachment = file_frame.state().get('selection').first().toJSON();
                          jQuery('#upload-image-<?php echo esc_attr($var_id);?>').val(attachment.id);

                          jQuery('#uploaded-image-<?php echo esc_attr($var_id);?>').attr('src', attachment.url);

                          jQuery('#upload-field-<?php echo esc_attr($var_id);?> .show-on-image').show();

                        });

                        // Finally, open the modal
                        file_frame.open();
                      });

					</script>


				<p class="description"><?php esc_html_e('Select or upload an image to show as profile avatar.', 'narratium'); ?></p>

			</td>
		</tr>
	</table>
<?php }







function KTT_save_profile_avatar( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;

	update_user_meta( $user_id, KTT_var_name('user_avatar'), $_POST[KTT_var_name('user_avatar')] );



}

add_action( 'show_user_profile', 'KTT_add_profile_avatar' );
add_action( 'edit_user_profile', 'KTT_add_profile_avatar' );

add_action( 'personal_options_update', 'KTT_save_profile_avatar' );
add_action( 'edit_user_profile_update', 'KTT_save_profile_avatar' );
