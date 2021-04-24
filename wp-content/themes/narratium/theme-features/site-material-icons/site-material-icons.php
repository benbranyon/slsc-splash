<?php
/**
 * Add a little firm/copyright text for the site in settings -> general
 *
 */









/**
* Returns true if the material icons option is enabled
*/
function KTT_is_material_icons_active() {
	return true;
}



/**
* Function to load the library google fonto of material icons
*/
function KTT_load_material_icons_font() {
	wp_enqueue_style( KTT_var_name('-material-icons'), 'https://fonts.googleapis.com/icon?family=Material+Icons', false );
}
if (KTT_is_material_icons_active()) add_action( 'wp_enqueue_scripts', 'KTT_load_material_icons_font' );




?>
