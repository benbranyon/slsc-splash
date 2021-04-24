<?php

/**
* This function that intercepts the hook of the app in angular to add the code needed to operate the sidenav of the site
*/
function KTT_site_angularjs_sidenav() {

  ?>


  $scope.open_left_sidenav = function() {;

        var container = jQuery( '#site-wrap' );
        overlay = jQuery( '#site-menu-block' );

        var btnclick = function rm() {

          overlay.removeClass('open');
          container.removeClass('overlay-open');
          jQuery('body').removeClass('overflow-hidden');
          overlay.addClass('close');
          jQuery('.site-menu-handle-open').show();
          jQuery('.site-menu-handle-close').hide();

        }

        if( overlay.hasClass('open') ) {

            btnclick();
            document.getElementById("site-wrap").removeEventListener("click", btnclick);

        } else {

              overlay.addClass( 'open' );
              container.addClass( 'overlay-open' );
              overlay.removeClass('close');
              jQuery('body').addClass('overflow-hidden');
              jQuery('.site-menu-handle-close').show();
              jQuery('.site-menu-handle-open').hide();

              document.getElementById("site-wrap").addEventListener("click", btnclick);

        }


  }



  <?php

}
add_action("THEME_angularjs_main_app", "KTT_site_angularjs_sidenav", 5);
 ?>
