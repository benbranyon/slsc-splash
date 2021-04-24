<?php

/**
* We get the author
*/
if ( $author_id = get_query_var( 'author' ) ) { $author = KTT_get_user_by( 'id', $author_id ); }

/**
* We obtain the template that corresponds to the current object
*/
$template = KTT_get_user_template($author);

/**
* If there is a template, we put it
*/
if ($template) require($template->path);
