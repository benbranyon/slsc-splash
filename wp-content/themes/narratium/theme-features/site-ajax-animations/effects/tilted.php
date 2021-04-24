<?php
/*
Effect Name: Tilted
Scripts Dependencies: snap.svg-min, svgLoader
CSS Dependencies: ajax-transitions-base
*/




/**
* This animation runs just before the page is loaded
*/
function KTT_ajax_preload_effect_animation() {

  ?>
  loader.show();
  jQuery('#site-wrap').fadeToggle("normal", function() {

  });
  <?php

}
add_action('KTT_theme_ajax_load_content_before', 'KTT_ajax_preload_effect_animation');







/**
* This animation is executed when the load is finished
*/
function KTT_ajax_finally_effect_animation() {

  ?>
  window.scrollTo(0, 0);
  jQuery('#site-wrap').fadeToggle("fast", function() {
    loader.hide();
  });

  <?php

}
add_action('KTT_theme_ajax_load_content_after', 'KTT_ajax_finally_effect_animation');







/**
* This hook is responsible for adding the necessary html to the start of the body tag
*/
function KTT_ajax_body_html() {

  ?>
  <div id="loader" class="pageload-overlay" data-opening="M 0,0 80,-10 80,60 0,70 0,0" data-closing="M 0,-10 80,-20 80,-10 0,0 0,-10">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
					<path d="M 0,70 80,60 80,80 0,80 0,70"/>
				</svg>
	</div>
  <?php

}
add_action('KTT_theme_body_start', 'KTT_ajax_body_html', 5);
