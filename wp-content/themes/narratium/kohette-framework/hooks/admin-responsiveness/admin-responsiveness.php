<?php
/**
 *	This load the libraries needed to make responsive the admin tables, metaboxes, etc.
 *
 *
 */

function load_admin_responsiveness_style() {

        wp_register_style( 'admin-responsiveness',  get_parent_theme_file_uri('kohette-framework/hooks/admin-responsiveness/stylesheets/responsive.css'), false, '1.0.0' );
        wp_enqueue_style( 'admin-responsiveness' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_responsiveness_style' );
