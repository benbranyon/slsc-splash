<?php

/**
* We obtain the template that corresponds to the current object
*/
$template = KTT_get_post_template($post);

/**
* If there is a template, we put it
*/
if ($template) require($template->path);
