<?php
/**
* This sideheader is shown in the frontpage and by default in the pages that do not have other types of sideheaders
*/




/**
* This function is responsible for showing the main sidebar / header of the site, helping itself in the function KTT_display_sidebard_card...
*/
function KTT_category_sideheader() {

      $object = get_queried_object();

      /**
      * We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
      */
      $args = array(
          "wrap_classes" => "max-width-400px min-width-400px basic-sideheader overflow-hidden site-palette-yin-1-background-color",
          "card_id" => "basic-sideheader",
          "card_classes" => "font-white-color backdrop-dark-gradient-light height-100vh text-align-left category-sideheader site-palette-yang-1-color",

          /**
          * We get the image data header
          */
          "card_background_attachment" => KTT_get_category_featured_image_id($object->term_id),

          /**
          * We call the function that is in charge of creating the content of the site heade we pass only the name of the project because this parameter acts as a callback...
          */
          "card_content" => "KTT_category_sideheader_content",

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
function KTT_category_sideheader_content() {

      /**
      * We call the globla that contains the id of the category
      */
      $object = get_queried_object();

      /**
      * We define the class that is responsible for indicating what size the title should have
      */
      $title_typo_size_class = "typo-size-xxlarge";
      if (mb_strlen($object->name) > 20) $title_typo_size_class = "typo-size-large";
      if (mb_strlen($object->name) < 10) $title_typo_size_class = "typo-size-xxlarge";

      /**
      * We define the class that is responsible for indicating what size the title should have
      */
      $subtitle_typo_size_class = "typo-size-medium";
      if (mb_strlen($object->description) > 150) $subtitle_typo_size_class = "typo-size-small";
      if (mb_strlen($object->description) < 10) $subtitle_typo_size_class = "typo-size-medium";

      ?>

      <div class="padding-both-40"></div>

      <div>

            <div class="padding-both-50">

                <div class="icon-folder typo-size-small basic-sideheader-meta category-sideheader-meta padding-bottom-10 opacity-03">
                  <span class="typo-size-xsmall"><?php echo sprintf(esc_html__('%s articles filed in', 'narratium'), $object->count)?></span>
                </div>

                <div class="word-wrap-break-word site-typeface-title padding-bottom-10 <?php echo esc_attr($title_typo_size_class);?> ">
                  <?php echo esc_html($object->name);?>
                </div>
                <div class="site-typeface-headline opacity-08 padding-bottom-10 <?php echo esc_attr($subtitle_typo_size_class);?>  ">
                  <?php echo esc_html($object->description);?>
                </div>

            </div>

            <div class="padding-both-20"></div>

            <div>

              <?php
              /**
              * Obtain the links of previous and next
              */
              $pagination_links = KTT_get_next_previous_links();
              ?>

              <div data-hide-xs class="nextprev-buttons post-item-meta  text-align-center" data-layout="row">

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
                      <a class="opacity-03 site-palette-yang-1-color padding-top-20 padding-bottom-20 display-block"><span class="icon-left-open"></span> <?php echo esc_html($pagination_links['next']['label']);?></a>
                    <?php } ?>

                  </span>

                  <span data-flex="50">

                    <?php if ($pagination_links['previous']['url']) {?>
                      <md-tooltip data-md-direction="top"><?php echo esc_attr($pagination_links['previous']['title']);?></md-tooltip>
                      <a
                      class="padding-top-20 padding-bottom-20 site-palette-yang-1-color display-block"
                      title="<?php echo esc_attr($pagination_links['previous']['title']);?>"
                      href="<?php echo esc_url($pagination_links['previous']['url']);?>">
                       <?php echo esc_html($pagination_links['previous']['label']);?> <span class="icon-right-open"></span>
                      </a>
                    <?php } else {?>
                      <a class="opacity-03 site-palette-yang-1-color padding-top-20 padding-bottom-20 display-block"> <?php echo esc_html($pagination_links['previous']['label']);?> <span class="icon-right-open"></span></a>
                    <?php } ?>

                  </span>

              </div>


            </div>

      </div>


      <?php

}



?>
