<?php
/**
* This sideheader is shown on the SINGLE pages
*/




/**
* This function is responsible for showing the main sidebar / header of the site by helping in the function KTT_display_sidebard_card
*/
function KTT_single_sideheader($post) {

      if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

      /**
      * We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
      */
      $args = array(
          "wrap_classes" => "max-width-400px min-width-400px basic-sideheader overflow-hidden site-palette-yin-1-background-color",
          "card_id" => "basic-sideheader",
          "card_classes" => "font-white-color height-100vh overflow-hidden backdrop-dark-gradient-light text-align-left",

          /**
          * We get the image data header
          */
          "card_background_attachment" => get_post_thumbnail_id($post->ID),

          /**
          * We call the function that is responsible for creating the content of the site header, we only pass the name of the project because this parameter acts as a callback
          */
          "card_content" => array("KTT_single_sideheader_content", $post->ID),

          /**
          * align
          */
          "card_align" => "end stretch",

          // we permit video covers!
          "card_video" => true,

      );

      /**
      * We execute the function that is really responsible for showing the header
      */
      KTT_display_image_card($args);

}











/**
* This function is responsible for creating the html and content that will be used in the post card
*/
function KTT_single_post_card_content($post, $template = '') {
    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    ?>

    <a href="<?php echo get_permalink($post->ID);?>" data-flex>

    </a>


    <div>
        <a href="<?php echo get_permalink($post->ID);?>" class="site-palette-yang-1-color display-block padding-both-20">
            <div class="max-width-400px margin-auto word-wrap-break-word typo-size-medium site-typeface-title padding-left-10 padding-right-10 typo-size-subtitle padding-bottom-20">
              <?php echo KTT_get_post_title_formated($post)?>
            </div>
            <div class="max-width-400px margin-auto site-typeface-headline opacity-05 padding-left-10 padding-right-10 text-size-small">
              <?php echo KTT_get_post_subtitle_formated($post)?>
            </div>
        </a>


        <?php if (
					(isset($template->options['displays'])
					&& isset($template->options['displays']['post_author'])
					&& $template->options['displays']['post_author'])
          || !$template
				)  {?>

        <div data-flex class="post-item-meta padding-left-30 padding-right-30" >
          <hr class="opacity-02">
        </div>

        <div data-flex class="site-typeface-body typo-size-xsmall post-item-meta padding-left-30 padding-top-5 padding-bottom-5 padding-right-30" >
          <?php
          /**
          * We get the list of authores
          */
          if (function_exists("get_coauthors")) $authors = get_coauthors($post->ID);
          else if (function_exists("KTT_get_post_author_and_coauthors")) $authors = KTT_get_post_author_and_coauthors($post);
          else $authors = array(KTT_get_user($post->post_author));

          /**
          * We plan for each of them
          */
          if ($authors) foreach($authors as $author) {?>

              <strong class="by-user"><a class="site-palette-yang-1-color" href="<?php echo esc_url(get_author_posts_url($author->ID));?>"><?php echo esc_html($author->display_name);?></a></strong>

          <?php } ?>

        </div>

        <?php } ?>







    </div>


    <div class="padding-bottom-20">


      <?php
      /**
      * If both, read time and comments count are disabled then we
      * hide the entire div containing both
      */
      if (

        ($template && isset($template->options['displays']) && isset($template->options['displays']['post_comments_count']) && $template->options['displays']['post_comments_count'])

        ||

        ($template && isset($template->options['displays']) && isset($template->options['displays']['post_read_time']) && $template->options['displays']['post_read_time'])

        ||

        !$template
      ) { ?>


      <div data-flex class="post-item-meta padding-left-30 padding-right-30" >
        <hr class="opacity-02">
      </div>

        <div layout-align="center center" class="post-item-meta typo-size-xsmall site-typeface-body padding-left-30  padding-right-30 padding-top-10" data-layout="row">


          <?php if (
            (isset($template->options['displays'])
            && isset($template->options['displays']['post_comments_count'])
            && $template->options['displays']['post_comments_count'])
            || !$template
          )  {?>
            <span data-flex="50">

              <?php comments_number( esc_html__('No responses', 'narratium') , esc_html__('One response','narratium'), esc_html__('% responses','narratium') );?>

            </span>
          <?php } ?>


          <?php if (
            (isset($template->options['displays'])
            && isset($template->options['displays']['post_read_time'])
            && $template->options['displays']['post_read_time'])
            || !$template
          )  {?>
            <span data-flex="50">
              <?php KTT_display_post_read_time();?>
            </span>
          <?php } ?>

        </div>

      <?php } ?>


    </div>
    <?php

}






/**
* This function is responsible for creating the html and content that will be used in the post card
*/
function KTT_single_sideheader_content($post) {
    global $template;

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    ?>

    <div class="padding-both-40"></div>



    <div  class="typography-responsive site-palette-yang-1-color width-100 display-block padding-both-20 padding-left-50 padding-right-50">

            <div class="word-wrap-break-word  site-typeface-title text-size-2xlarge  padding-bottom-20">
              <?php echo KTT_get_post_title_formated($post)?>
            </div>
            <div class="word-wrap-break-word  site-typeface-headline opacity-08 text-size-basic padding-bottom-20  ">
              <?php echo KTT_get_post_subtitle_formated($post);?>
            </div>

            <div data-flex class="item-meta post-item-meta classic-link-inside typo-size-xsmall padding-bottom-40">



                <?php if (
                  isset($template->options['displays'])
                  && isset($template->options['displays']['post_author'])
                  && $template->options['displays']['post_author']
                )  {?>
                <?php
                  /**
                  * We get the list of authores
                  */
                  if (function_exists("get_coauthors")) $authors = get_coauthors($post->ID);
                  else if (function_exists("KTT_get_post_author_and_coauthors")) $authors = KTT_get_post_author_and_coauthors($post);
                  else $authors = array(KTT_get_user($post->post_author));

                  /**
                  * We plan for each of them
                  */
                  if ($authors) {
                ?>
                <span class="meta opacity-08 ornament-line-before-amper">
                    <?php echo esc_html__('By', 'narratium');?>
                    <?php foreach($authors as $author) {?>
                      <strong class="by-user"><a class="site-palette-yang-1-color" href="<?php echo get_author_posts_url($author->ID);?>"><?php echo esc_html($author->display_name);?></a></strong>
                    <?php } ?>
                </span>
                <?php } ?>
                <?php } ?>




                <?php if (
                  (isset($template->options['displays'])
                  && isset($template->options['displays']['post_categories'])
                  && $template->options['displays']['post_categories'])
                  ||
                  (isset($template->options['displays'])
                  && isset($template->options['displays']['post_date'])
                  && $template->options['displays']['post_date'])
                )  {?>
                <span class="meta opacity-05 ornament-line-before-amper">

                    <?php esc_html_e('Posted', 'narratium');?>
                    <?php if (
                      isset($template->options['displays'])
                      && isset($template->options['displays']['post_categories'])
                      && $template->options['displays']['post_categories']
                    )  { ?>
                      <?php esc_html_e('in', 'narratium');?> <b><?php the_category('</b>, <b>'); ?></b>
                    <?php } ?>

                    <?php if (
                      isset($template->options['displays'])
                      && isset($template->options['displays']['post_date'])
                      && $template->options['displays']['post_date']
                    )  { ?>
                      <?php echo sprintf(esc_html__("on %s", 'narratium'), get_the_date());?>
                    <?php } ?>
                </span>
                <?php } ?>



                <?php if (
                  isset($template->options['displays'])
                  && isset($template->options['displays']['post_comments_count'])
                  && $template->options['displays']['post_comments_count']
                )  {?>
                <span class="meta opacity-08 ornament-line-before-amper">
                  <span class="disqus-comment-count"> <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'narratium'), number_format_i18n( get_comments_number() ) );?></span>
                </span>
                <?php } ?>



                <?php if (
                  isset($template->options['displays'])
                  && isset($template->options['displays']['post_read_time'])
                  && $template->options['displays']['post_read_time']
                )  {?>
                <span class="meta opacity-05 ornament-line-before-amper">
                  <?php KTT_display_post_read_time();?>
                </span>
                <?php } ?>


                <?php if ($post->post_credits) {?>
                <div class="classic-link-inside typo-size-small opacity-04"><?php echo wpautop($post->post_credits);?></div>
                <?php } ?>

            </div>




    </div>



    <div>



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
