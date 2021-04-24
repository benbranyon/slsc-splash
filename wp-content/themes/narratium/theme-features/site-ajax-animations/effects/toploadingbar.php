<?php
/*
Effect Name: Top Loading Bar
Scripts Dependencies:
CSS Dependencies: ajax-transitions-base
*/




/**
* This animation runs just before the page is loaded
*/
function KTT_ajax_preload_effect_animation() {
  ?>
  jQuery('#loader').fadeIn();
  <?php
}
add_action('KTT_theme_ajax_load_content_before', 'KTT_ajax_preload_effect_animation');







/**
* This animation is executed when the load is finished
*/
function KTT_ajax_finally_effect_animation() {
  ?>
  window.scrollTo(0, 0);
  jQuery('#loader').fadeOut('normal', function() {});
  <?php
}
add_action('KTT_theme_ajax_load_content_after', 'KTT_ajax_finally_effect_animation');







/**
* This hook is responsible for adding the necessary html to the start of the body tag
*/
function KTT_ajax_body_html() {

  ?>
  <div id="loader" class="pageload-overlay show" style="display:none;background-color:rgba(255,255,255, 0.5)">
    <md-progress-linear class="md-hue-1" md-mode="indeterminate"></md-progress-linear>
  </div>
  <?php

}
add_action('KTT_theme_body_start', 'KTT_ajax_body_html', 5);
