<?php
/**
* Custom header support
*/

/**
* We define an array with the header configuration
*/
$header_info = array(
    'width'         => 510,
    'flex-width'    => true,
    'height'        => 1200,
    'flex-height'    => true,
    'random-default'        => false,
    'uploads'       => true,
    'video' => true,
);
add_theme_support( 'custom-header', $header_info );

 ?>
