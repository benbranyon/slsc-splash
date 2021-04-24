<?php
/**
 * Theme Index page
 *
 * @package    Narratium
 * @subpackage Common
 * @author     Rafael Martín <rafaelmartinanguita@gmail.com>
 */

?><!DOCTYPE html>
<html <?php html_class('overflow-hidden'); ?> data-layout="row" <?php language_attributes(); ?>>
    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>

    </head>
    <body
    <?php KTT_body_attrs();?>
    data-ng-cloak
    data-layout="column"
    data-flex
    <?php body_class(); ?>>

        <?php wp_body_open(); ?>
        <?php do_action('KTT_theme_body_start');?>

        <div
        id="site-wrap"
        data-flex="auto"
        data-layout="row"
        data-layout-sm="column"
        data-layout-xs="column"
        class="site-wrap">
