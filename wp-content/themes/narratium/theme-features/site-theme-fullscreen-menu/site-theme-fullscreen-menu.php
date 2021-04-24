<?php
/**
* This script is responsible for adding a topbar to our site that we will use as an interface help for general navigation on the web, here you can integrate navigation elements and logos, helps, then
*/



/**
* This function is responsible for adding the necessary html for the fullscreen menu at the start of the body tag...
*/
function KTT_add_thme_fullscreen_menu_html() {

    ?>
    <!-- MENU -->
    <div id="site-menu-block"
          data-layout-align="start center"
          class=" max-width-400px width-100 position-relative overlay-contentpush overlay site-left-sidenav site-sidenav site-palette-yang-2-background-color site-palette-yin-2-color"
          data-layout="column">

          <md-button
          id="close-site-menu"
          aria-label="Menu"
          data-flex
          data-ng-click="open_left_sidenav()"
          style="right:-37px;float:right;line-height:20px;padding:0;vertical-align:middle;top: 45%"
          class="close-site-menu position-absolute hide-xs show-gt-xs display-block text-align-center md-fab site-palette-yang-1-color site-palette-yin-1-background-color" >
          <i style="margin:0;font-size:30px;" class="material-icons">close</i>
          </md-button>

          <div
          data-layout="column"
          class="width-100 text-size-small  site-palette-yin-2-color">






                    <?php
                    /**
                    * Here will go the sidebar of the site
                    */
                    ?>
                    <div class="section classic-link-inside padding-both-20">


                      <md-button
                        data-flex
                        data-ng-click="open_left_sidenav()"
                        data-hide-gt-xs
                        aria-label="Close"
                        data-md-no-ink
                        style="text-transform:none;border-radius:0 4px 4px 0;margin:0;padding:0;"
                        class=" display-block cursor-pointer padding-both-10 padding-left-20 padding-right-20  text-align-center site-palette-yang-2-color site-palette-yin-1-background-color">
                        <i class="text-size-4xlarge material-icons">close</i>
                        <span class=" text-size-xsmall" data-hide-xs ><?php esc_html_e('Close', 'narratium');?></span>
                      </md-button>



                      <?php if(get_option(KTT_theme_var_name('site_display_sidebar_backtohome'))) {?>

                        <div
                        data-layout="row"
                        data-layout-align="space-between stretch"
                        class="margin-bottom-20 clear-both width-100 overflow-hidden border-radius-4">

                          <a
                            data-flex="auto"
                            data-md-no-ink
                            aria-label="Home"
                            href="<?php echo esc_url(home_url("/"));?>"
                            class="button-behaviour cursor-pointer display-block padding-both-10 padding-left-20 padding-right-20  text-align-center site-palette-yin-2-color site-palette-yang-4-background-color" >
                            <i class=" text-size-4xlarge material-icons">home</i>
                            <span class=" text-size-small font-weight-700"  ><?php esc_html_e('Go back to home', 'narratium');?></span>
                          </a>

                        </div>

                        <hr class="margin-bottom-20 site-palette-yang-4-border-color ">

                        <?php }?>


                        <?php if ( has_nav_menu( 'main-menu' ) ) {?>

                          <div class="margin-bottom-20 padding-both-20 border-radius-3 site-palette-yang-4-background-color widget widget_nav_menu ">
                          <?php wp_nav_menu(
                            array(
                              'theme_location' => 'main-menu',
                              'menu_class' => 'main-menu  margin-auto display-inline',
                            )); ;?>
                          </div>
<hr class="margin-bottom-20 site-palette-yang-4-border-color ">
                        <?php } ?>

                        <?php if ( is_active_sidebar( 'main-menu-area' ) ) dynamic_sidebar( 'main-menu-area' ); ?>

                    </div>

                    <div class="padding-bottom-40 padding-left-40 padding-right-40 text-align-center typo-size-xsmall">

                        <?php if ( has_nav_menu( 'bottom-menu' ) ) {?>
        									<div class="classic-link-inside bottom-menu-container">
        											<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu', 'menu_class' => 'bottom-menu display-inline',  )); ;?>
        									</div>
        								<?php } ?>

                        <?php $website_firm = get_option(KTT_var_name('website_firm'));
                  			if ($website_firm) {?>
                  			<div class=" footer-firm ">
                  							<?php echo wp_kses_post($website_firm);?>
                  			</div>
                  			<?php } ?>
                    </div>


          </div>



    </div>
    <?php

}
add_action('KTT_theme_body_start', 'KTT_add_thme_fullscreen_menu_html', 5);





/**
* If the ajax navigation is active we have to add a small fix to hide the menu each time a new page is loaded if the menu is visible...
*/
function KTT_add_theme_fullscreen_menu_ajax_navigation_fix() {

  // javascript
  ?>
  if ( jQuery('#site-menu-block').hasClass("open")) {
    jQuery('#site-menu-block').removeClass('open');
    jQuery('html #site-wrap.overlay-open').removeClass('overlay-open');
  }
  <?php

}
if (KTT_ajax_is_enabled()) add_action('KTT_theme_ajax_load_content_finally', 'KTT_add_theme_fullscreen_menu_ajax_navigation_fix');
