<?php
/**
 * Custom functions by Kohette Framework.
 *
 */


function KTT_framework_unique_prefix() {
  return 'ktt_';
}


/**
* This detect if a special feature is enabled or note
* A feature is disabled only que que find the "disabled" word in status
*/
function KTT_feature_is_enabled($featureID) {
  global $KTT_plugins;
  if (!isset($KTT_plugins[$featureID])) return true;
  if (!isset($KTT_plugins[$featureID]['Status'])) return true;
  if (strtolower($KTT_plugins[$featureID]['Status']) == 'disabled') return false;
  return true;
}

/**
* return the correct name for a option (postmeta, usermeta, etc) adding the theme prefix
* @package Kohette Framework\Basic functions
*/
function KTT_add_prefix($string, $prefix = '') {
    if (!$prefix) $prefix = KTT_framework_unique_prefix();
    return $prefix . $string;
}

/**
* return the correct name for a option (postmeta, usermeta, etc) adding the frmwork prefix
* @package Kohette Framework\Basic functions
*/
function KTT_var_name($string = '') {
    return KTT_framework_unique_prefix() . $string;
}

/**
* Add prefix to string
* @package Kohette Framework\Basic functions
*/
function KTT_add_ktt_prefix($string = '', $prefix = '') {
    if (!$prefix) $prefix = KTT_framework_unique_prefix();
    return $prefix . $string;
}

/**
* return the correct name for a option (postmeta, usermeta, etc) adding the theme prefix
* @package Kohette Framework\Basic functions
*/
function KTT_theme_var_name($string = '') {
    return KTT_add_prefix($string, THEME_PREFIX);
}

/**
* This function adds the theme unique prefix to a string
* @package Kohette Framework\Basic functions
*/
function KTT_add_theme_prefix($string = '') {
    return KTT_add_prefix($string, THEME_PREFIX);
}

/**
* Remove the theme prefix
* @package Kohette Framework\Basic functions
*/
function KTT_remove_theme_prefix($string) {
    return KTT_remove_prefix($tring, KTT_add_theme_prefix());
}

/**
* Get a theme global variable
* @package Kohette Framework\Basic functions
*/
function KTT_get_global($variable_name) {
	return $GLOBALS[KTT_var_name($variable_name)];
}


/**
* set a theme global variable
* @package Kohette Framework\Basic functions
*/
function KTT_set_global($variable_name, $value) {
	$GLOBALS[KTT_var_name($variable_name)] = $value;
}





/**
* remove the theme prefix from string
* @package Kohette Framework\Basic functions
*/
function KTT_remove_prefix($string, $prefix = '') {
    if (!$prefix) $prefix = KTT_var_name();
    return str_replace($prefix, '', $string);
}


/**
* Transform a local path in a direct url
* @package Kohette Framework\Basic functions
*/
function KTT_path_to_url($string) {
    $string = str_replace("\\","/",$string);
    $correct_wp_content_url = str_replace(parse_url(WP_CONTENT_URL, PHP_URL_HOST), parse_url(home_url("/"), PHP_URL_HOST), WP_CONTENT_URL);
  	$result = str_replace( str_replace("\\","/", WP_CONTENT_DIR), $correct_wp_content_url, $string );
    $result = apply_filters('KTT_path_to_url_filter', $result);
    return $result;
}

/**
* transform a direct url in a local path
* @package Kohette Framework\Basic functions
*/
function KTT_url_to_path($string) {
    $string = str_replace("\\","/",$string);
    $correct_wp_content_url = str_replace(parse_url(WP_CONTENT_URL, PHP_URL_HOST), parse_url(home_url("/"), PHP_URL_HOST), WP_CONTENT_URL);
  	$result = str_replace(  $correct_wp_content_url, str_replace("\\","/", WP_CONTENT_DIR), $string );
    $result = apply_filters('KTT_url_to_path_filter', $result);
    return $result;
}


/**
* change the status of a post
* @package Kohette Framework\Basic functions
*/
function KTT_change_post_status($post_id, $new_status) {
	$args = array(
      'ID'           => $post_id,
      'post_status' => $new_status,
  	);

	return wp_update_post( $args );
}

/**
* this special hook change the {term}_status field of a term
* @package Kohette Framework\Basic functions
*/
function KTT_change_term_status($term_id, $new_status) {
    $term = get_term($term_id);
    if ($term) return update_term_meta($term_id, KTT_var_name($term->taxonomy . '_status'), $new_status);
}

/**
* Update the post to change the field indicated
* @package Kohette Framework\Basic functions
*/
function KTT_change_post_field($post_id, $post_field, $field_value) {

	$args = array(
      'ID'           => $post_id,
      $post_field => $field_value,
  	);

	return wp_update_post( $args );
}



/**
 * Thanks to: https://gist.github.com/kellenmace/6209d5f1e465cdcc800e690b472f8f16
 * Return the post excerpt, if one is set, else generate it using the
 * post content. If original text exceeds $num_of_words, the text is
 * trimmed and an ellipsis (…) is added to the end.
 *
 * @param  int|string|WP_Post $post_id   Post ID or object. Default is current post.
 * @param  int                $num_words Number of words. Default is 55.
 * @return string                        The generated excerpt.
 */
function KTT_get_the_excerpt( $post_id = null, $num_words = 55 ) {
	$post = $post_id ? get_post( $post_id ) : get_post( get_the_ID() );
	$text = ''; //get_the_excerpt( $post );
	if ( ! $text ) {
		$text = get_post_field( 'post_content', $post );
	}
	$generated_excerpt = wp_trim_words( $text, $num_words );
	return apply_filters( 'get_the_excerpt', $generated_excerpt, $post );
}



/**
* This function return all the prefixes that are been used in the querys of
* the site
*/
function KTT_get_all_site_variable_prefixes() {

    /**
    * We declare an array with the prefixes that we want to extract from the ddbb
    */
    $prefixes = array(KTT_framework_unique_prefix());

    /**
    * We add a filter to extract variables in a prefix from an external function
    */
    $prefixes = apply_filters('KTT_meta_prefixes', $prefixes);

    /**
    * We return the list of prefixes
    */
    return $prefixes;

}


/**
* Adds postmetas to post object
*/
function KTT_add_postmetas_to_post_object($post) {
      global $wpdb;

      /**
      * We get the prefixes for the variables
      */
      $prefixes = KTT_get_all_site_variable_prefixes();

      /**
      * Based on the list of prefixes we are going to create the query
      */
      $query_string = $wpdb->prepare("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d", $post->ID);

      /**
      * If there is a list of prefixes defined, we will go traveling through each of them and add them to the query
      */
      if ($prefixes) {
        $query_string .= " AND (";
        $c = 0;
        foreach ($prefixes as $prefix) {
          if ($c) $query_string .= " OR ";
          $query_string .= $wpdb->prepare("meta_key LIKE %s", $prefix . '%');
          $c += 1;
        }
        $query_string .= ")";
      }

      /**
      * We execute the query_string
      */
      $postmetas = $wpdb->get_results($query_string);

      /**
      * We add postmetas to the Post object
      */
      foreach($postmetas as $nodo => $meta ) {
        $key = $meta->meta_key;
        if ($prefixes) foreach ($prefixes as $prefix) $key = KTT_remove_prefix($key, $prefix);
        $value = maybe_unserialize($meta->meta_value);
        $post->$key = $value;
      }

      /**
      * Finally we return the post object
      */
      return $post;

}


/**
* This returns a post object with all their postmetas
* @package Kohette Framework\Basic functions
*/
function KTT_get_post($post_id) {
	$post = get_post($post_id);
	if (!$post) return;
  $post = KTT_add_postmetas_to_post_object($post);
	return $post;
}






/**
* This function can order a list of object by one of his properties/attributes
* @package Kohette Framework\Basic functions
*/
function KTT_order_objects_by_field($objects, $field, $order = 'ASC') {
  //$comparer = ($order === 'DESC') ? "return -strcmp(\$a->{$field},\$b->{$field});" : "return strcmp(\$a->{$field},\$b->{$field});";
  //usort($objects, create_function('$a,$b', $comparer));
  usort($objects, function($a, $b) {return ($order === 'DESC') ? -strcmp($a->{$field}, $b->{$field}) : -strcmp($a->{$field}, $b->{$field});});
  return $objects;
}

/**
* This returns a wp_user object with all their postmetas (related to the theme) added
* @package Kohette Framework\Basic functions
*/
function KTT_get_user_by($field, $value) {
    /**
    * First we get the common user object
    */
    $user = get_user_by($field, $value);

    /**
    * If not user then get out
    */
    if (!$user) return;

    /**
    * We use the wpdb object to make a request and get all the postmetas
    * related with the user and the theme
    */
    global $wpdb;
    $KTT_prefix = KTT_var_name();
    $theme_prefix = KTT_theme_var_name();
  	$usermetas = $wpdb->get_results($wpdb->prepare("SELECT meta_key, meta_value FROM {$wpdb->usermeta} WHERE user_id = %d AND (meta_key like '{$theme_prefix}%' OR  meta_key like '{$KTT_prefix}%')", $user->ID));
  	foreach($usermetas as $nodo => $meta ) {
    		$key = KTT_remove_prefix($meta->meta_key, $KTT_prefix);
        $key = KTT_remove_prefix($key, $theme_prefix);
    		$value = maybe_unserialize($meta->meta_value);
    		$user->data->$key = $value;
  	}

  	return $user;
}


/**
* Alias from KTT_get_user_by
* @package Kohette Framework\Basic functions
*/
function KTT_get_user($user_id = '') {

    /**
    * If not exists a user_id, we try to get the global id of the current user
    */
    if (!$user_id) {
      global $user_ID;
      $user_id = $user_ID;
    }

    if (!$user_id) return;

    return KTT_get_user_by('id', $user_id);
}

/**
* Ups.
*/
function KTT_esc_forest($input) {
  return $input;
}


/**
* This function is responsible for extracting an option from the site related to the theme
* @package Kohette Framework\Basic functions
*/
function KTT_get_theme_option($option_name) {
    return get_option(KTT_theme_var_name($option_name));
}

/**
* This function is responsible for extracting an option from the site related to the theme
* @package Kohette Framework\Basic functions
*/
function KTT_get_option($option_name) {
    return get_option(KTT_var_name($option_name));
}




/**
* Check if the user has the required permission to edit an object
* @package Kohette Framework\Basic functions
*/
function KTT_current_user_can_edit_object($object) {

	if (is_int($object) || is_string($object)) $object = KTT_get_post($object);

  $result = false;

	/**
	* We get the id of the logged user if exists
	*/
	global $user_ID;

  /**
  * If there is a user id and this is the author of the object then it can happen
  */
	if ($user_ID && ($user_ID == $object->post_author) ) $result = true;

  /**
  * We create a filter so that the output of this function can be edited from another function
  */
  $result = apply_filters('KTT_current_user_can_edit_object', $object, $user_ID, $result );

  /**
  * We return false if we have arrived here
  */
	return $result;
}



/**
* This function allows to add all the custom css of the site in one place
* @package Kohette Framework\Basic functions
*/
function KTT_get_site_custom_css() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    $result = apply_filters('KTT_add_site_custom_css', $result);

    /**
    * We return the resultado
    */
    return $result;

}



/**
* This function allows to add all the custom js code
* @package Kohette Framework\Basic functions
*/
function KTT_get_site_custom_js() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    ob_start();
    $result = apply_filters('KTT_add_site_custom_js', $result);
    $result = ob_get_clean();;

    /**
    * We return the resultado
    */
    return $result;

}


/**
* This function allows to add all the custom js code of the footer site in one place
* @package Kohette Framework\Basic functions
*/
function KTT_get_site_custom_js_footer() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    $result = apply_filters('KTT_add_site_custom_js_footer', $result);

    /**
    * We return the resultado
    */
    return $result;

}

/**
* This function allows to add all the custom js code of the header site in one place
* @package Kohette Framework\Basic functions
*/
function KTT_get_site_custom_js_header() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    $result = apply_filters('KTT_add_site_custom_js_header', $result);

    /**
    * We return the resultado
    */
    return $result;

}

/**
* Obtain a term object
* @package Kohette Framework\Basic functions
*/
function KTT_get_taxonomy_term($taxonomy, $term_id_or_slug) {

      $result = '';

      /**
      * We check first if it is an integer, if so, we will try to obtain it from the term_id
      */
      if (is_numeric($term_id_or_slug)) $result = @get_term_by('id', $term_id_or_slug, $taxonomy);

      /**
      * If a term has been obtained, we will return it
      */
      if ($result) return $result;

      /**
      * If at this point we have not yet obtained a term we will try to look for it through the slug
      */
      $result = @get_term_by('slug', $term_id_or_slug, $taxonomy);

      /**
      * We return the result
      */
      return $result;

}


/**
* Create a taxonomy's term in a easy way
* arguments: taxonomy and args
* args = array('taxonomy', 'name', 'slug', 'description', 'parent');
* return new term id or wp_error
* @package Kohette Framework\Basic functions
*/
function KTT_create_taxonomy_term( $term_args) {

      /**
      * If between the list of arguments we do not find the slug then we leave here returning a wp_error
      */
      if (!isset($term_args['slug']) || !isset($term_args['taxonomy'])) return new WP_Error( 'invalid_args', esc_html__('Invalid arguments.', 'narratium') );

      /**
      * First we will check if the term already exists, if so we return the existing term in the function
      */
      $term = KTT_get_taxonomy_term($term_args['taxonomy'], $term_args['slug']);
      if ($term) return $term;

      /**
      * If a parent has been indicated in the arguments, we will correct it to obtain the correct term if its term_id or slug has been passed.
      */
      if (isset($term_args['parent']) && $term_args['parent']) {
          $parent = KTT_get_taxonomy_term($term_args['taxonomy'], $term_args['parent']);
          if ($parent) $term_args['parent'] = $parent->term_id;
      }

      /**
      * We insert the new term
      */
      $term = wp_insert_term(
          $term_args['name'],
          $term_args['taxonomy'], // the taxonomy
          array(
            'description'=> (isset($term_args['description']) ? $term_args['description'] : ''),
            'slug' => (isset($term_args['slug']) ? $term_args['slug'] : ''),
            'parent'=> (isset($term_args['parent']) ? $term_args['parent'] : '')
          )
      );

      /**
      * If an error has occurred, we will return this error
      */
      if (is_wp_error($term)) return $term;

      /**
      * We return the term created object
      */
      return KTT_get_taxonomy_term($term_args['taxonomy'], $term['term_id']);

}







/**
* get the greatest common divisor of two numbers
* @package Kohette Framework\Basic functions
*/
function KTT_greatest_common_divisor( $a, $b ){
    return ($a % $b) ? KTT_greatest_common_divisor($b,$a % $b) : $b;
}

/**
* return the aspect ratio
* @package Kohette Framework\Basic functions
*/
function KTT_ratio( $x, $y ){
    $gcd = KTT_greatest_common_divisor($x, $y);
    return ($x/$gcd).':'.($y/$gcd);
}


/**
* Special attrs for body tag element
* @package Kohette Framework\Basic functions
*/
function KTT_body_attrs($attrs = '') {
    $result = '';
    $result .= ' ' . $attrs;
    $result = apply_filters( 'KTT_body_attrs', $result );
    echo esc_html($result);
}


/**
 * Get human readable time difference between 2 dates
 *
 * Return difference between 2 dates in year, month, hour, minute or second
 * The $precision caps the number of time units used: for instance if
 * $time1 - $time2 = 3 days, 4 hours, 12 minutes, 5 seconds
 * - with precision = 1 : 3 days
 * - with precision = 2 : 3 days, 4 hours
 * - with precision = 3 : 3 days, 4 hours, 12 minutes
 *
 * From: http://www.if-not-true-then-false.com/2010/php-calculate-real-differences-between-two-dates-or-timestamps/
 *
 * @package Kohette Framework\Basic functions
 *
 * @param mixed $time1 a time (string or timestamp)
 * @param mixed $time2 a time (string or timestamp)
 * @param integer $precision Optional precision
 * @return string time difference
 */
function KTT_get_date_diff( $time1, $time2, $precision = 2 ) {
	// If not numeric then convert timestamps
	if( !is_int( $time1 ) ) {
		$time1 = strtotime( $time1 );
	}
	if( !is_int( $time2 ) ) {
		$time2 = strtotime( $time2 );
	}

	// If time1 > time2 then swap the 2 values
	if( $time1 > $time2 ) {
		list( $time1, $time2 ) = array( $time2, $time1 );
	}

	// Set up intervals and diffs arrays
	$intervals = array( 'year', 'month', 'day', 'hour', 'minute', 'second' );
	$diffs = array();

	foreach( $intervals as $interval ) {
		// Create temp time from time1 and interval
		$ttime = strtotime( '+1 ' . $interval, $time1 );
		// Set initial values
		$add = 1;
		$looped = 0;
		// Loop until temp time is smaller than time2
		while ( $time2 >= $ttime ) {
			// Create new temp time from time1 and interval
			$add++;
			$ttime = strtotime( "+" . $add . " " . $interval, $time1 );
			$looped++;
		}

		$time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
		$diffs[ $interval ] = $looped;
	}

	$count = 0;
	$times = array();
	foreach( $diffs as $interval => $value ) {
		// Break if we have needed precission
		if( $count >= $precision ) {
			break;
		}
		// Add value and interval if value is bigger than 0
		if( $value > 0 ) {
			if( $value != 1 ){
				$interval .= "s";
			}
			// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$count++;
		}
	}

	// Return string with times
	return implode( ", ", $times );
}







/**
* Return a date as product of the sum of a date plus working days, skipping the weekends and custom dates
* http://codereview.stackexchange.com/questions/51895/calculate-future-date-based-on-business-days
*
* @package Kohette Framework\Basic functions
*
* @param DateTime   $startDate       Date to start calculations from
* @param DateTime[] $holidays        Array of holidays, holidays are no considered business days.
* @param int[]      $nonBusinessDays Array of days of the week which are not business days.
* USE:
$calculator = new KTT_business_days_calculator(
    new DateTime(), // Today
    [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
    [KTT_business_days_calculator::SATURDAY, KTT_business_days_calculator::FRIDAY]
);

$calculator->add_business_days(3); // Add three business days

var_dump($calculator->get_timestamp());
*/
class KTT_business_days_calculator {

    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 7;


    public function __construct(DateTime $startDate, array $holidays, array $nonBusinessDays) {
        $this->date = $startDate;
        $this->holidays = $holidays;
        $this->nonBusinessDays = $nonBusinessDays;
    }

    public function add_business_days($howManyDays) {
        $i = 0;
        while ($i < $howManyDays) {
            $this->date->modify("+1 day");
            if ($this->is_business_day($this->date)) {
                $i++;
            }
        }
    }

    public function get_date() {
        return $this->date;
    }

    public function get_timestamp() {
    	return $this->date->getTimestamp();
    }

    private function is_business_day(DateTime $date) {
        if (in_array((int)$date->format('N'), $this->nonBusinessDays)) {
            return false; //Date is a nonBusinessDay.
        }
        foreach ($this->holidays as $day) {
            if ($date->format('Y-m-d') == $day->format('Y-m-d')) {
                return false; //Date is a holiday.
            }
        }
        return true; //Date is a business day.
    }
}



/**
* Get a image path in the size indicated
*
* @package Kohette Framework\Basic functions
*/
function KTT_scaled_image_path($attachment_id, $size = 'thumbnail') {
    $file = get_attached_file($attachment_id, true);
    if (empty($size) || $size === 'full') {
        // for the original size get_attached_file is fine
        return realpath($file);
    }
    if (! wp_attachment_is_image($attachment_id) ) {
        return false; // the id is not referring to a media
    }
    $info = image_get_intermediate_size($attachment_id, $size);
    if (!is_array($info) || ! isset($info['file'])) {
        return false; // probably a bad size argument
    }

    return realpath(str_replace(wp_basename($file), $info['file'], $file));
}

/**
* Get a image url in the size indicated
*
* @package Kohette Framework\Basic functions
*/
function KTT_scaled_image_url($attachment_id, $size = 'thumbnail') {

  $medium_array = image_downsize( $attachment_id, $size);
  if (is_array($medium_array)) {
    $medium_path = $medium_array[0];
  } else {
    $medium_path = wp_get_attachment_url($attachment_id);
  }
  return $medium_path;

}
