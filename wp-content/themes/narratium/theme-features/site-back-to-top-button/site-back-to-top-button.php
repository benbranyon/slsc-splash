<?php
/**
 * Back-top-top Button
 * version 1.1
 */


 /**
 * Return true if the back-to-top button is enabled
 */
 function KTT_back_to_top_button_is_enabled() {
	 return KTT_get_theme_option('back_to_top_button_enable');
 }

 /**
 * With this hook we make sure to add to the footer of the site the code needed to activate angularjs (here goes the app)
 */
 function KTT_back_to_top_button_js() {
   	?>
		 	jQuery('body').on( 'DOMMouseScroll mousewheel', function ( event ) {
		 		if( event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0 ) {
		 			//The scroll is going down...
		 			jQuery('.back-to-top-trigger').removeClass('show').addClass('hide');
		 		} else {
		 			//Scroll is going up. Only if we are far from top we display the div
		 			if (jQuery(window).scrollTop() > jQuery(window).height()) {
		 				jQuery('.back-to-top-trigger').addClass('show').removeClass('hide');
		 			}
		 		}
		 	});
  	<?php
 }



/**
* This function returns the html of the back to top button
*/
function KTT_add_back_to_top_button(){

	/**
	* up arrow icon
	*/
	$up_arrow_icon = get_option(KTT_theme_var_name("back_to_top_button_icon"), "keyboard_arrow_up");

	?>
	<span
	id="back-to-top-trigger"
	onclick="jQuery('html,body').animate({ scrollTop: 0 }, 'slow');jQuery('.back-to-top-trigger').removeClass('show').addClass('hide');"
	class="back-to-top-trigger hide text-size-3xlarge line-height-0 button-behaviour box-shadow padding-both-0 border-rounded-full site-palette-yin-1-background-color site-palette-yang-1-color margin-right-20 margin-bottom-20 cursor-pointer position-fixed pin-bottom pin-right ">
			<i class="material-icons"><?php echo esc_attr($up_arrow_icon);?></i>
	</span>
	<?php
}






/**
* With this function we add our angularjs controller after the main app library load
*/
function KTT_load_back_to_top_button_library() {
    ob_start();
    $result = KTT_back_to_top_button_js();
    $result = ob_get_clean();
    wp_add_inline_script( 'main-app', $result );
}





/**
* If we have enabled the back-to-top button we call the needed
* actions and scripts
*/
if (KTT_back_to_top_button_is_enabled()) {
	add_action('KTT_theme_body_end', 'KTT_add_back_to_top_button');
	add_action( 'wp_enqueue_scripts', 'KTT_load_back_to_top_button_library' );
}








/**
* A section helps us organize the elements of the page
*/

$args                           	= array();
$args['section_id']              	= KTT_theme_var_name('back_to_top_button');
$args['section_title']            = esc_html__('Back-to-top Button', 'narratium');
$args['section_description']     	= esc_html__('Configure the back-to-top button.', 'narratium');
new KTT_new_customize_section($args);



// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_theme_var_name('back_to_top_button_enable');
$args['option_name']           	= esc_html__('Display back-to-top button', 'narratium');
$args['option_description']     = esc_html__('Enable or disable the back-top-top button in the site.', 'narratium');
$args['option_label']     			= esc_html__('Enable', 'narratium');
$args['option_priority'] 				= 10;
$args['option_type']            = 'checkbox';
$args['option_default'] 				= 1;
$args['option_section']    			= KTT_theme_var_name('back_to_top_button');
new KTT_new_customize_setting($args);



$args                           = array();
$args['option_id']              = KTT_theme_var_name('back_to_top_button_icon');
$args['option_name']           	= esc_html__('Button icon', 'narratium');
$args['option_description']     = esc_html__("Insert the ID of the icon that's will be displayed in the button. You can insert any ID from the Google Material icons library.", 'narratium');
$args['option_priority'] 				= 11;
$args['option_type']            = 'text';
$args['option_default'] 				= 'keyboard_arrow_up';
$args['option_section']    			= KTT_theme_var_name('back_to_top_button');
new KTT_new_customize_setting($args);




?>
