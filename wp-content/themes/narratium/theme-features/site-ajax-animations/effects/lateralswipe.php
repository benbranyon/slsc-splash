<?php
/*
Effect Name: Lateral Swipe
Scripts Dependencies: snap.svg-min, svgLoader
CSS Dependencies: ajax-transitions-base
*/




/**
* This animation runs just before the page is loaded
*/
function KTT_ajax_preload_effect_animation() {

  ?>
  loader.show();
  <?php

}
add_action('KTT_theme_ajax_load_content_before', 'KTT_ajax_preload_effect_animation');







/**
* This animation is executed when the load is finished
*/
function KTT_ajax_finally_effect_animation() {

  ?>
    window.scrollTo(0, 0);
    loader.hide();
  <?php

}
add_action('KTT_theme_ajax_load_content_after', 'KTT_ajax_finally_effect_animation');







/**
* This hook is responsible for adding the necessary html to the start of the body tag
*/
function KTT_ajax_body_html() {

  ?>
  <div id="loader" class="pageload-overlay" data-opening="M 40,-65 145,80 -65,80 40,-65" data-closing="m 40,-65 0,0 L -65,80 40,-65">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
					<path d="M 40,-65 145,80 40,-65"/>
				</svg>
	</div>
  <?php

}
add_action('KTT_theme_body_start', 'KTT_ajax_body_html', 5);
