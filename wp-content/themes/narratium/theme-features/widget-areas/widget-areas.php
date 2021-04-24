<?php
/**
 * Register widgetized areas
 *
 */


 function KTT_widgets_init() {

 	register_sidebar( array(
 		'id' 								=> 'main-menu-area',
 		'name' 							=> 'Main Menu Area',
 		'description'   		=> esc_html__('Use this area to place widgets that will appear in the main menu window.', 'narratium'),
 		'before_widget' 		=> '<div id="%1$s" class="padding-both-20 border-radius-3 site-palette-yang-1-background-color widget %2$s">',
 		'after_widget' 			=> '</div>',
 		'before_title' 			=> '<h2 class="margin-bottom-10 padding-top-0 site-palette-3-yang-color typo-size-base font-weight-700 widget-title rounded">',
 		'after_title' 			=> '</h2>',
 	) );

 }
 add_action( 'widgets_init', 'KTT_widgets_init' );




?>
