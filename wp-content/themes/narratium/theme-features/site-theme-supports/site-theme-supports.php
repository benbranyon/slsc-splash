<?php
/**
* We define the WP functionalities that we support in the themes
*/

/**
* Support for Thumbnails
*/
add_theme_support( 'post-thumbnails' );

/**
* Support for html5
*/
add_theme_support( 'html5', array(
  'comment-list',
  'search-form',
  'comment-form',
  'gallery',
  'caption',
) );

/**
* Automatic feed links
*/
add_theme_support( 'automatic-feed-links' );

/**
* Support for title-tag
* #https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
*/
function KTT_theme_slug_setup() {add_theme_support( 'title-tag' );}
add_action( 'after_setup_theme', 'KTT_theme_slug_setup' );


/**
* Backwards compatibility for title tag
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function KTT_theme_slug_render_title() {
      ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
      <?php
    }
    add_action( 'wp_head', 'KTT_theme_slug_render_title' );
endif;


/**
* theme logo support
*/
function KTT_theme_logo_support() {

	add_theme_support( 'custom-logo', array(
		'flex-width' => true,
    'flex-height' => true,
	) );

}
add_action( 'after_setup_theme', 'KTT_theme_logo_support' );


 ?>
