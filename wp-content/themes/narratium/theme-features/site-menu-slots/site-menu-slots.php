<?php
/**
 * WP3.0 menu support
 *
 *
 * @package Narratium
 */

add_action( 'init', 'KTT_menus' );
function KTT_menus() {

    register_nav_menu( 'main-menu', esc_html__( 'Main Menu', 'narratium') ); // main menu - this menu appear in the top-right corner

    // Frontpage sidebar menu
    register_nav_menu( 'frontpage-extra-menu', esc_html__( 'Frontpage Extra Menu', 'narratium') ); // main menu - this menu appear in the top-right corner

  	// bottom menu
  	register_nav_menu( 'bottom-menu', esc_html__( 'Bottom Menu', 'narratium') ); // bottom menu - this menu appear in the bottom-right corner


}
?>
