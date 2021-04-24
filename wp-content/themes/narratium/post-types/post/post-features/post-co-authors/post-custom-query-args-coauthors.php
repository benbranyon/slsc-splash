<?php
/**
 * This class is responsible for generating the necessary hooks to take into account the coauthores field in the case in which the author has been indicated as a filter in the query
 */




/**
* Necessary class to add the "store" parameter
*/
class KTT_argument_coauthor {

    // current query
    private $query;

    // the value of the argument
    private $value;

    public function __construct(){
        add_action( 'parse_query', array( $this, 'parse_query' ) );
    }



    public function parse_query( $query ) {

    	  // we save the current query
        $this->query = $query;

        // if the arguments have the date_limit in the orderby ...
        if( isset( $query->query_vars['author']) &&  $query->query_vars['author'] ) $this->value = $query->query_vars['author'];
        if( isset( $query->query_vars['author_name']) &&  $query->query_vars['author_name'] ) $this->value = $query->query_vars['author_name'];


        if ($this->value) {

            /**
            * If the value we have is not numeric it means that instead of the user id we have the nickname, therefore we are going to try to obtain the id
            */
            if (!is_numeric($this->value)) $this->value = get_user_by('slug', $this->value)->ID;

            /**
            * Filter to add the necessary join to include the post goal with the deadline
            */
            add_filter('posts_where', array( $this, 'filter_where' ));

            /**
            * once the posts are selected, we delete the filters
            */
            add_filter( 'posts_selection', array( $this, 'remove_filters' ) );

        }
    }


    /**
    * we create the estate that will allow us to select the deadline (timestamp format)
    */
    public function filter_where($where_string = '') {
        global $wpdb;

        if ($this->value) $where_string .= " OR (SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '" . KTT_var_name('post_coauthors') . "' AND post_id = {$wpdb->posts}.ID AND meta_value LIKE '%" . ':"' . $this->value . '";' . "%') ";

        return $where_string;

    }


    /**
    * we eliminate the hooks to return to normal
    */
    public function remove_filters() {
        remove_filter( 'posts_where', array( $this, 'filter_where' ) );
    }


}

// we activate the new parameter
$argument_coauthor = new KTT_argument_coauthor();
