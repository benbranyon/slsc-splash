<?php
/**
 *	Function responsible for completing the information of a term with the taxmetas linked
 *
 *
 * @package printcore
 */


add_action('get_term', 'complete_term_with_taxmetas_NEW', 6, 1);
function complete_term_with_taxmetas_NEW($term) {
	global $wpdb;

	/**
	* We define the identifier of the theme with which all the variables related to the
	*/
	$theme_id = KTT_var_name();

	/**
	* We make the consultation that will return all the postmetas of the post related to the theme
	*/
	$metas = $wpdb->get_results('SELECT meta_key, meta_value FROM '  . $wpdb->termmeta . ' WHERE term_id = ' . $term->term_id . ' AND meta_key LIKE "' . $theme_id . '%"');

	foreach($metas as $nodo => $meta ) {
		$key = KTT_remove_prefix($meta->meta_key);
		$value = maybe_unserialize($meta->meta_value);
		$term->$key = $value;
	}

	return $term;
}






/**
* This function is responsible for checking if the global post is defined on the current page and if so, search all its posts related to the theme and add them to the object
*/
function KTT_add_termmetas_to_global_term_object($term) {

  /**
  * We define the identifier of the theme with which all the variables related to it begin
  */
  $theme_id = KTT_var_name();

  /**
  * Invoke wpdb
  */
  global $wpdb;

  /**
  * We make the consultation that will return all the postmetas of the post related to the theme
  */
  $metas = $wpdb->get_results($wpdb->prepare('SELECT meta_key, meta_value FROM '  . $wpdb->termmeta . ' WHERE term_id = %d AND meta_key LIKE "' . $theme_id . '%"', $term->term_id));

  /**
  * If we have not found postmetas we left here
  */
  if (!$metas) return;

  /**
  * We go for each one of the postmetas and we add them to the post object
  */
	foreach($metas as $nodo => $meta ) {
		$key = KTT_remove_prefix($meta->meta_key);
		$value = maybe_unserialize($meta->meta_value);

		$term->$key = $value;
	}

	return $term;

}





?>
