<?php
/**
* Here we will agglutinate the functions related to the sideheaders of the site the sideheaders are the substitutes of the header that are shown to the left of the theme pagians
*/




require_once('site-theme-sideheaders-frontpage.php');
require_once('site-theme-sideheaders-single.php');
require_once('site-theme-sideheaders-category.php');
require_once('site-theme-sideheaders-user.php');
require_once('site-theme-sideheaders-archive.php');


/**
* This function determines which sideheader should be displayed on the current page
*/
function KTT_display_sideheader($object = '') {


    if (is_single() || is_page()) KTT_single_sideheader($object);

    elseif (is_author()) KTT_user_sideheader();

    elseif (is_front_page()) KTT_frontpage_sideheader();

    elseif (is_category() || is_tag()) KTT_category_sideheader();

    elseif (is_archive()) KTT_archive_sideheader();

    else KTT_frontpage_sideheader();


}




?>
