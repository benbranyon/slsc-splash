<?php


/**
* This function prints the js code to fix the adminbar margin issue
*/
function KTT_adminbar_fix_js() {

    /**
    * If user is not logged let get out of Here
    */
    if ( !is_user_logged_in() ) return;

    ?>

      <script>

      function ktt_fix_adminbar() {


        var windowsize = jQuery(window).width();
        var html_height = jQuery(window).height();
        var adminbar_height = jQuery('#wpadminbar').height();

        if (windowsize > 960) {

            jQuery("html, body").height(jQuery(window).height());
            jQuery("html, body").css('min-height', 'auto');
            jQuery("html, body").height(html_height - adminbar_height);
            jQuery("html").css('margin-top', adminbar_height + 'px');
            jQuery(".height-100vh").height(html_height - adminbar_height);

        } else {
            jQuery(".height-100vh").height(html_height - adminbar_height);
            jQuery(".height-100vh").css('min-height', html_height - adminbar_height + 'px');
            jQuery("html, body").css('height', 'auto');
            jQuery("html").css('margin-top', adminbar_height + 'px');

        }


      }

      jQuery(window).resize(function () {
        ktt_fix_adminbar();
      });

      jQuery(window).ready(function () {
        ktt_fix_adminbar();
      });


      </script>

    <?php
}
add_action( 'wp_footer', 'KTT_adminbar_fix_js', 9999 );



/**
* This animation is executed when the load is finished
*/
function KTT_adminbar_fix_js_AJAX() {
  /**
  * If user is not logged let get out of Here
  */
  if ( !is_user_logged_in() ) return;
  ?>
    setTimeout(ktt_fix_adminbar, 1000);
  <?php
}
if (KTT_ajax_is_enabled()) add_action('KTT_theme_ajax_load_content_finally', 'KTT_adminbar_fix_js_AJAX', 9999999);







?>
