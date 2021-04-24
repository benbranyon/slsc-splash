<?php
/**
* animations for ajax transitions
* version 1.0
*/
require_once('ajax-animations-functions.php');
require_once('ajax-animations-admin.php');

/**
* We get the activated effect
*/
$current_effect = KTT_get_current_ajax_animation_effect();

/**
* If we do not have an effect we leave Aqui
*/
if (!$current_effect) return;

/**
* If the effect has dependencies, let's invoke them
*/
if (isset($current_effect->dependencies) && $current_effect->dependencies) {
  if (isset($current_effect->dependencies['js']) && $current_effect->dependencies['js']) require_once('ajax-animations-load-js-dependencies.php');
  if (isset($current_effect->dependencies['css']) && $current_effect->dependencies['css']) require_once('ajax-animations-load-css-dependencies.php');
}

/**
* We invoke the effect
*/
require_once($current_effect->path);
