<?php
/**
* We define custom image sizes
*
* [...]
* Image sizes handles have the same problem as the styles and scripts.
* Themes and plugins use handles that describe where the images are used.
* The problem with that is if the handles is defined twice the second definition is used.
* The recommendation for this reason has been always to prefix the handles.
* The problem with that is that the handles are saved to the database when the image size is generated.
* So when you switch from theme you would need to regenerate all of the images even if both themes used the same image dimensions.
*
* By defining a naming standard the plugins and themes can work better with each other.
* The handles should be named after the dimensions and crop setting.
* [...]
*
* #https://github.com/grappler/wp-standard-handles
*
*/
add_action( 'after_setup_theme', 'KTT_custom_image_sizes' );
function KTT_custom_image_sizes() {

    /**
    * Thumbnail image of 500x500px
    */
    add_image_size( ktt_theme_var_name('500x500-crop'), 500, 500, true ); // (cropped)

    /**
    * Thumbnail image of 1000x1000px
    */
    add_image_size( ktt_theme_var_name('1000x1000-crop'), 1000, 1000, true ); // (cropped)
}



/**
* That hook is responsible for adding the option to the dropdowns of the media library
*/
add_filter( 'image_size_names_choose', 'KTT_custom_images_sizes_dropdown' );
function KTT_custom_images_sizes_dropdown( $sizes ) {
    return array_merge( $sizes, array(
        ktt_theme_var_name('500x500-crop') => esc_html__( 'Square 500', 'narratium' ),
        ktt_theme_var_name('1000x1000-crop') => esc_html__( 'Square 1000', 'narratium' ),
    ) );
}



 ?>
