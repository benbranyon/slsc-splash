<?php

// # https://gist.github.com/Latz/7f923479a4ed135e35b2
// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------

/*
Plugin Name: Test List Table Example
*/
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class PluginsManagerTable extends WP_List_Table {

    var $example_data = array();

    function __construct(){
    global $status, $page;
        parent::__construct( array(
            'singular'  => __( 'feature', 'narratium' ),      //singular name of the listed records
            'plural'    => __( 'features', 'narratium' ),     //plural name of the listed records
            'ajax'      => false                                //does this table support ajax?
    ) );
    add_action( 'admin_head', array( &$this, 'admin_header' ) );
    }



    function admin_header() {
      $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
      if( 'my_list_test' != $page )
      return;
      echo '<style type="text/css">';
      echo '.wp-list-table .column-id { width: 5%; }';
      echo '.wp-list-table .column-featurename { width: 40%; }';
      echo '.wp-list-table .column-author { width: 35%; }';
      echo '.wp-list-table .column-isbn { width: 20%;}';
      echo '</style>';
    }
    function no_items() {
      _e( 'No features found.', 'narratium' );
    }




    function column_default( $item, $column_name ) {
        switch( $column_name ) {
            case 'featurename':
            case 'description':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
        }
    }



    function get_sortable_columns() {
      $sortable_columns = array(
        'featurename'  => array('Name',false),
        'description' => array('Description',false),
      );
      return $sortable_columns;
    }



    function get_table_classes() {
        return array( 'widefat', 'fixed', 'plugins', 'striped', $this->_args['plural'] );
    }




    function get_columns(){
            $columns = array(
                'cb'        => '<input type="checkbox" />',
                'featurename' => __( 'Feature', 'narratium' ),
                'description'    => __( 'Description', 'narratium' ),
            );
             return $columns;
        }
    function usort_reorder( $a, $b ) {
      // If no sort, default to title
      $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'featurename';
      // If no order, default to asc
      $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
      // Determine sort order
      $result = strcmp( $a[$orderby], $b[$orderby] );
      // Send final sort direction to usort
      return ( $order === 'asc' ) ? $result : -$result;
    }


    function column_cb($item) {
        return sprintf('<input type="checkbox" name="feature[]" value="%s" />', $item['ID']);
    }


    function column_featurename($item){
      if (strtolower($item['Status']) == 'disabled') $actions = array('enable'      => sprintf('<a href="?page=%s&action=%s&feature=%s">Enable</a>',$_REQUEST['page'],'enable',$item['ID']));
      else $actions = array('disable'      => sprintf('<a href="?page=%s&action=%s&feature=%s">Disable</a>',$_REQUEST['page'],'disable',$item['ID']));
      return sprintf('<b>%1$s</b>%2$s', $item['Name'], $this->row_actions($actions, true) );
    }



    function column_description($item) {
      $actions = array(
        'Version ' . $item['Version'],
        'By Rafael Martín',
      );

      return sprintf('<p>%1$s</p>%2$s', $item['Description'], $this->row_actions($actions, true) );
    }



    /**
    * Generates content for a single row of the table
    *
    * @param object $item The current item
    */
    function single_row( $item ) {

        $class = '';
        if (KTT_feature_is_enabled($item['ID'])) $class = "active";
        echo '<tr class="' . $class . '">';
        echo KTT_esc_forest($this->single_row_columns( $item ));
        echo '</tr>';
    }





    function get_bulk_actions() {
      $actions = array(
        //'delete'    => 'Delete'
      );
      return $actions;
    }

    function prepare_items() {
      $columns  = $this->get_columns();
      $hidden   = array();
      $sortable = $this->get_sortable_columns();
      $this->_column_headers = array( $columns, $hidden, $sortable );
      //usort( $this->example_data, array( &$this, 'usort_reorder' ) );

      $per_page = 555;
      $current_page = $this->get_pagenum();
      $total_items = count( $this->example_data );

      // only ncessary because we have sample data
      $this->found_data = array_slice( $this->example_data,( ( $current_page-1 )* $per_page ), $per_page );
      $this->set_pagination_args( array(
        'total_items' => $total_items,                  //WE have to calculate the total number of items
        'per_page'    => $per_page                     //WE have to determine how many items to show on a page
      ) );
      $this->items = $this->example_data;
    }



} //class







 ?>
