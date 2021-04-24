<?php
/**
* This sideheader is shown in the frontpage and by default in the pages that do not have other types of sideheaders
*/








/**
* This function is responsible for showing the main sidebar / header of the site by helping in the function KTT_display_sidebard_card
*/
function KTT_user_sideheader($user_id = '') {

      /**
      * If an id has not been indicated, we will try to obtain it
      */
      if (!$user_id) {

          /**
          * If we are in a page of author we obtain his id
          */
          if (is_author()) {
            $user_id = get_query_var( 'author' );

          /**
          * If we are not in a page of author we obtain the id of the logged in user
          */
          } else {
            global $user_ID;
            $user_id = $user_ID;
          }

      }


      /**
      * We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
      */
      $args = array(
          "wrap_classes" => "max-width-400px min-width-400px basic-sideheader overflow-hidden site-palette-yin-1-background-color",
          "card_id" => "basic-sideheader",
          "card_classes" => "font-white-color text-align-center backdrop-dark-gradient-light height-100vh site-palette-yang-1-color",

          /**
          * We get the image data header
          */
          "card_background_attachment" => KTT_get_user_featured_image_id($user_id),

          /**
          * We call the function that is responsible for creating the content of the site header, we only pass the name of the project because this parameter acts as a callback
          */
          "card_content" => array("KTT_user_sideheader_content", $user_id),

          /**
          * We enable the video if it has it
          */
          "card_video" => true,

      );

      /**
      * We execute the function that is really responsible for showing the header
      */
      KTT_display_image_card($args);

}





/**
* This function is responsible for creating the html and content that will use the header / sidebar of our site
*/
function KTT_user_sideheader_content($user_id = '') {

      /**
      * We get the category
      */
      $user = KTT_get_user_by('ID', $user_id);

      /**
      * We define the class that is responsible for indicating what size the title should have
      */
      $title_typo_size_class = "typo-size-big";
      if (mb_strlen($user->name) > 20) $title_typo_size_class = "typo-size-medium";
      if (mb_strlen($user->name) < 10) $title_typo_size_class = "typo-size-big";

      /**
      * We define the class that is responsible for indicating what size user description should have
      */
      $subtitle_typo_size_class = "typo-size-medium";
      if (mb_strlen($user->user_description) > 150) $subtitle_typo_size_class = "typo-size-small";
      if (mb_strlen($user->user_description) < 10) $subtitle_typo_size_class = "typo-size-upper-medium";

      ?>

      <div></div>

      <div>

            <div class="padding-both-50">

                <div class="padding-bottom-10">
                  <?php echo get_avatar( $user_id, '150', '', $user->display_name, array( 'class' => array( 'border-radius-100', 'md-whiteframe-3dp' ) ) );; ;?>
                </div>
                <div class="site-typeface-title padding-bottom-5 <?php echo esc_attr($title_typo_size_class);?> basic-sideheader-title user-sideheader-title typo-size-xlarge">
                  <?php echo esc_attr($user->display_name);?>
                </div>
                <div class="site-typeface-headline padding-bottom-10 <?php echo esc_attr($subtitle_typo_size_class);?> basic-sideheader-subtitle user-sideheader-subtitle">
                  <?php echo wpautop($user->user_description);?>
                </div>

                <div>
                  <?php

                  /**
                  * Social fields list
                  */
                  if (function_exists('KTT_get_user_social_fields')) {
                  $list = KTT_get_user_social_fields();
            
                  foreach ($list as $key => $field) {
                      if (!isset($user->data->{'user_' . $field['id']}) || !$user->data->{'user_' . $field['id']}) continue;
                      ?>
                      <md-button
                      aria-label="<?php echo esc_attr($field['label']);?>"
                      ng-attr-target="_blank"
                      href="<?php echo esc_url($field['url']);?><?php echo esc_attr($user->data->{'user_' . $field['id']});?>"
                      class="typo-size-medium md-raised site-palette-yin-1-background-color md-fab <?php echo esc_attr($field['icon']);?>">
                      </md-button>
                      <?php
                  }
                  }

                  ?>
                </div>

            </div>


            <div class="padding-both-20"></div>


            <?php
            /**
            * Obtain the links of previous and next
            */
            $pagination_links = KTT_get_next_previous_links();
            ?>

            <div data-hide-xs data-hide-sm class="nextprev-buttons post-item-meta  text-align-center" data-layout="row">

                <span data-flex="50">

                  <?php if ($pagination_links['next']['url']) {?>
                    <md-tooltip data-md-direction="top"><?php echo esc_attr($pagination_links['next']['title']);?></md-tooltip>
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
                    <md-tooltip data-md-direction="top"><?php echo esc_attr($pagination_links['previous']['title']);?></md-tooltip>
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

      </div>


      <?php

}



?>
