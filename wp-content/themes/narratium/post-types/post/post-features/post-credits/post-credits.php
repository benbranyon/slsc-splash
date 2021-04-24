<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */





 /**
 * Creation of the metabox_id with the hyper-amazing KTT Framework
 */
 $args = array();
 $args['metabox_id'] 						= 	'post_credits';
 $args['metabox_name']					= 	esc_html__("Post Credits", 'narratium');
 $args['metabox_post_type'] 		= 	'post';
 $args['metabox_vars'] 					= 	array(
                                       KTT_var_name('post_credits')
                                   );
 $args['metabox_callback']			= 	'KTT_post_credits_meta_box';
 $args['metabox_context']				= 	'side';
 $args['metabox_priority']			= 	'default';
 $metabox = new KTT_new_metabox($args);






// META BOX FORM
function KTT_post_credits_meta_box( $post ) {

    $credit = get_post_meta($post->ID, KTT_var_name('post_credits'), true);

    $settings = array(
    	'wpautop' => false,
    	'media_buttons' => false,
    	'textarea_name' => KTT_var_name('post_credits'),
    	'textarea_rows' => 5,
    	//'teeny' 	=> true,
    	'quicktags' => false,
    	'tinymce' => array(
        				'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor',
                'toolbar2'=> '',
                'toolbar3'=> '',
                'toolbar4'=> '',
      	),

    );

    ?>

    <p><?php esc_html_e("If necessary, insert credits for this post. This field is useful to add image credits and post's copyright related stuff.",'narratium');?></p>
    <?php
    wp_editor( $credit, KTT_var_name('post_credits'), $settings );
}



?>
