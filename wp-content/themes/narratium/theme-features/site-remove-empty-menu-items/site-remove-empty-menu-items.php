<?php

/**
* With this filter we avoid to display menu items without title
*/
add_filter( 'wp_get_nav_menu_items', 'KTT_remove_empty_menu_items', 10, 3 );
function KTT_remove_empty_menu_items ( $items, $menu, $args ) {

    /**
    * We itinerate for every item and remove the items without title
    */
    if ($items) foreach ($items as $item_key => $item) if (!$item->title) unset($items[$item_key]);

    /**
    * Return the items list
    */
    return  $items;

}

?>
