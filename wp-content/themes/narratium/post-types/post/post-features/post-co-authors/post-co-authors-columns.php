<?php
/**
* Columns
*/

/**
* We define the columns that the table will have
*/
function KTT_add_coauthors_column_head( $defaults ) {

    /**
    * We are going to form a nuvo array with all the columns
    */
    $result = array();

    /**
    * We walk through each of the columns
    */
    if ($defaults) foreach ($defaults as $key => $value) {

        /**
        * We add the column to the new arrays
        */
        $result[$key] = $value;

        /**
        * If the current column is that of author we add right next to that of coauthors
        */
        if ($key == 'author') $result['coauthors'] = esc_html__('Co-Authors', 'narratium');

    }

    /**
    * We return the new arrays
    */
  	return $result;

}
add_filter('manage_posts_columns', 'KTT_add_coauthors_column_head');




/**
* We define the columns that the table will have
*/
function KTT_add_coauthors_column( $column_name, $post_ID ) {

    /**
    * We get the full post
    */
    $post = KTT_get_post($post_ID);

    /**
    * We identify the columns
    */
    if ($column_name == 'coauthors') {

        /**
        * We get the coauthors of the post
        */
        $coauthors = KTT_get_post_coauthors($post);

        /**
        * If there are coauthors ...
        */
        $prefix = '';
        if ($coauthors) foreach ($coauthors as $user) {

            /**
            * We show the author
            */
            echo esc_attr($prefix);
            ?><a href="<?php echo admin_url('edit.php?author=' . $user->ID);?>"><?php echo esc_html($user->display_name);?></a><?php
            $prefix = ', ';
        }

    }


}
add_action('manage_posts_custom_column', 'KTT_add_coauthors_column', 10, 2);
