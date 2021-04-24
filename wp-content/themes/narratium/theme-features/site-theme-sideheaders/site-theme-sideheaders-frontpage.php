<?php
/**
* This sideheader is shown in the frontpage and by default in the pages that do not have other types of sideheaders
*/



/**
* This function is responsible for showing the main sidebar / header of the site by helping in the function KTT_display_sidebard_card
*/
function KTT_frontpage_sideheader() {

      /**
      * We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
      */
      $args = array(
          "wrap_classes" => "max-width-400px min-width-400px basic-sideheader overflow-hidden site-palette-yin-1-background-color",
          "card_id" => "basic-sideheader",
          "card_classes" => "text-align-center font-white-color backdrop-dark-gradient-light height-100vh site-palette-yang-1-color",

          /**
          * We get the image data header
          */
          "card_background_attachment" => KTT_get_header_image_attachment_id(),

          /**
          * We call the function that is responsible for creating the content of the site header, we only pass the name of the project because this parameter acts as a callback
          */
          "card_content" => "KTT_frontpage_sideheader_content",

          /**
          * We enable the video if it has it
          */
          "card_video" => true,


          "card_align" => "end stretch",

      );

      /**
      * We execute the function that is really responsible for showing the header
      */
      KTT_display_image_card($args);

}





/**
* This function is responsible for creating the html and content that will use the header / sidebar of our site
*/
function KTT_frontpage_sideheader_content() {

    /**
    * We get the registered social media array
    */
    $social_media = KTT_get_site_social_media();

    /**
    * We get the options that say that social media should show and what not. with array filter we make sure that we only get options with value 1 (eliminate the nulls)
    */
    $site_display_social_media = get_option(KTT_var_name('site_display_social_media'));
    $social_media_display = '';
    if ($site_display_social_media) $social_media_display = array_filter($site_display_social_media);

    /**
    * We get the logo url
    */
    $logo_image_url = KTT_get_site_logo_url('large');

    ?>


    <div class="padding-both-50 use-responsive-text-sizes-fixes">

        <?php if($logo_image_url && get_option(KTT_theme_var_name('site_logo_size'))) {?>
        <a
        href="<?php echo esc_url(home_url("/"));?>"
        class="padding-bottom-20 typo-size-upper-small site-header-subtitle display-block site-palette-yang-1-color">
          <img alt="<?php esc_attr_e('Logo', 'narratium');?>" style="width:<?php echo get_option(KTT_theme_var_name('site_logo_size'), '100%');?>" src="<?php echo esc_url($logo_image_url);?>">
        </a>
        <?php } ?>

        <?php
        /**
        * Option: "Display site title and tagline"
        */
        if (display_header_text()) {?>
            <a
            href="<?php echo esc_url(home_url("/"));?>"
            class="word-wrap-break-word link-white-color site-typeface-title typo-size-xxxlarge site-header-title display-block site-palette-yang-1-color">
                <?php echo esc_attr(get_bloginfo('name'));?>
            </a>

            <div class="word-wrap-break-word max-width-500px margin-auto text-size-base opacity-05 site-header-subtitle display-block site-palette-yang-1-color">
              <?php echo wpautop(get_option( KTT_var_name('website_slogan'), get_bloginfo('description') ));?>
            </div>
        <?php } ?>


        <?php if ( has_nav_menu( 'frontpage-extra-menu' ) ) {?>

          <hr class="opacity-01">
          <div class="link-white-color  padding-top-5 padding-bottom-5 typo-size-small menu-site-menu-container">
          <?php wp_nav_menu(
            array(
              'theme_location' => 'frontpage-extra-menu',
              'menu_class' => 'frontpage-extra-menu  margin-auto display-inline',
            )); ;?>
          </div>
          <hr class="opacity-01">

        <?php } ?>



        <?php if ($social_media_display) {?>
        <div data-layout="row"  class="display-block site-social-media padding-top-10 ">

            <?php if ($social_media_display) foreach($social_media_display as $social_id => $value) {

              /**
              * If the social media does not have a value, we move on to the next one
              */
              if (!$social_media[$social_id]['value']) continue;
              ?>

              <span class="padding-top-10" data-flex="15">
              <a
              target="_blank"
              href="<?php echo esc_url($social_media[$social_id]['share_url']);?>"
              title="<?php echo esc_attr($social_media[$social_id]['name']);?>"
              class="typo-size-small button-behaviour border-radius-100 padding-both-10 icon icon-<?php echo esc_attr($social_id);?>">

              </a>
              </span>

            <?php } ?>

        </div>
        <?php } ?>

        <div class="padding-both-20"></div>

    </div>







    <?php
    /**
    * Obtain the links of previous and next
    */
    $pagination_links = KTT_get_next_previous_links();
    ?>

    <div data-hide-xs class="nextprev-buttons post-item-meta  link-white-color text-align-center" data-layout="row">

        <span data-flex="50">

          <?php if ($pagination_links['next']['url']) {?>
            <md-tooltip md-direction="top"><?php echo esc_attr($pagination_links['next']['title']);?></md-tooltip>
            <a
            class="site-palette-yang-1-color padding-top-20 padding-bottom-20 display-block"
            title="<?php echo esc_attr($pagination_links['next']['title']);?>"
            href="<?php echo esc_url($pagination_links['next']['url']);?>">
              <span class="icon-left-open"></span> <?php echo esc_html($pagination_links['next']['label']);?>
            </a>
          <?php } else  {?>
            <a class="site-palette-yang-1-color opacity-03 padding-top-20 padding-bottom-20 display-block"><span class="icon-left-open"></span> <?php echo esc_html($pagination_links['next']['label']);?></a>
          <?php } ?>

        </span>

        <span data-flex="50">

          <?php if ($pagination_links['previous']['url']) {?>
            <md-tooltip md-direction="top"><?php echo esc_attr($pagination_links['previous']['title']);?></md-tooltip>
            <a
            class="site-palette-yang-1-color padding-top-20 padding-bottom-20 display-block"
            title="<?php echo esc_attr($pagination_links['previous']['title']);?>"
            href="<?php echo esc_url($pagination_links['previous']['url']);?>">
             <?php echo esc_html($pagination_links['previous']['label']);?> <span class="icon-right-open"></span>
            </a>
          <?php } else {?>
            <a class="site-palette-yang-1-color opacity-03 padding-top-20 padding-bottom-20 display-block"> <?php echo esc_html($pagination_links['previous']['label']);?> <span class="icon-right-open"></span></a>
          <?php } ?>

        </span>

    </div>


    <?php

}



?>
