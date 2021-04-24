<?php
/*
Template Name: Search Simple
Template Post Type: search
Template Description: Simple list of results.

*/
if(isset($config_mode) && $config_mode){


  $options   = array();
  $options['displays']['option_name']           	= esc_html__('Display / Hide Elements', 'narratium');
  $options['displays']['option_description']     	= esc_html__("Check the elements to display in this template.", 'narratium');
  $options['displays']['option_priority'] 				= 1;
  $options['displays']['option_type']            	= 'checkboxes';
  $options['displays']['option_type_vars']				= array(
                                                    'post_categories' => esc_html__('Post categories', 'narratium'),
                                                    'post_author' => esc_html__('Post author', 'narratium'),
                                                    'post_comments_count' => esc_html__('Post comments count', 'narratium'),
                                                    'post_categories' => esc_html__('Post categories', 'narratium'),
                                                    'post_date' => esc_html__('Post date', 'narratium'),
                                                  );
  $options['displays']['option_default']					= array(
                                                    'post_categories' => 1,
                                                    'post_author' => 1,
                                                    'post_comments_count' => 1,
                                                    'post_categories' => 1,
                                                    'post_date' => 1,
                                                  );

  if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) {
    $options['displays']['option_type_vars']['post_read_time'] = esc_html__('Post read time', 'narratium');
    $options['displays']['option_default']['post_read_time'] = 1;
  }

  return $options;

}



get_header();
?>

  <div data-flex data-layout="column"  data-layout-align="space-between stretch">
    <div id="site-body" class="template-search-default site-palette-yang-1-background-color site-palette-yin-2-color">


      <div
      id="template-search-form"
      class="box-shadow text-align-center site-palette-yang-4-background-color site-palette-yin-3-color"
      data-layout="column"
      data-layout-align="center stretch">

          <div class="padding-both-20"></div>

          <div class="padding-both-40">
            <small class="<?php echo KTT_get_content_width_classname();?> site-typeface-title text-size-large site-palette-yin-2-color margin-auto padding-both-10 width-100 display-block text-align-left">
              <?php echo sprintf(esc_html__('Search in %s', 'narratium'), '<strong>' . esc_attr(get_bloginfo('name')) . '</strong>' );?>
            </small>
            <div class="<?php echo KTT_get_content_width_classname();?> border-radius-3 padding-both-10 site-palette-yin-4-background-color margin-auto">
              <?php get_search_form( );?>
            </div>
            <small class="<?php echo KTT_get_content_width_classname();?> text-size-small margin-auto padding-both-10 width-100 display-block text-align-left">
              <?php esc_html_e('Enter a keyword to search and press enter', 'narratium');?>
            </small>
          </div>


          <div class="site-palette-yang-3-background-color site-palette-yin-2-color">
            <div class="padding-left-40 padding-right-40">
              <div class="<?php echo KTT_get_content_width_classname();?> margin-auto padding-both-10 padding-top-20 padding-bottom-20 width-100 display-block text-align-left">
                <?php
                global $wp_query;
                $total_results = $wp_query->found_posts;

                if (!$total_results) echo esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'narratium');
                else echo sprintf(esc_html__("%s search results found for: %s", 'narratium'), $total_results, esc_attr(get_query_var('s')));

                ?>
              </div>
            </div>
          </div>

      </div>



    		<div class="typography-responsive site-body-content-wrap padding-top-40 padding-bottom-40 max-width-1500">
    			<div class="<?php echo KTT_get_content_width_classname();?> text-align-left margin-auto site-typeface-content padding-top-40 site-body-content padding-left-40 padding-bottom-40 padding-right-40 typo-size-content">


            <?php if (!$wp_query->posts) {?>
                <div data-flex class="text-align-center" >
                  <div class="text-size-4xlarge icon-emo-unhappy"></div>
                </div>
            <?php } ?>


            <?php if (have_posts()) : ?>
    				<?php while (have_posts()) : the_post(); ?>


                        <h2 class="typo-size-medium">
                          <a href="<?php echo get_permalink();?>" class="classic-link site-palette-yin-1-color site-typeface-title typo-size-medium post-title">
                          <?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
                          </a>
                        </h2>

                        <span class="text-size-base"><?php the_excerpt();?></span>

                        <div class="padding-top-40 padding-bottom-40">
                          <hr class="site-palette-yang-4-border-color">
                        </div>






    				<?php endwhile; ?>
    				<?php endif; ?>









    			</div>
    		</div>






        <?php

        $pagination_links = KTT_get_next_previous_links();
        ?>

        <div class="padding-both-30"></div>
        <hr class="site-palette-yang-4-border-color">

        <p class="<?php echo KTT_get_content_width_classname();?> site-typeface-title-1  typo-size-small text-align-center  padding-top-10 margin-auto" data-layout="row">


            <span data-flex>

              <?php if ($pagination_links['next']['url']) {?>
                <a
                class="site-palette-yin-3-color margin-left-5 display-block   padding-top-10 padding-left-20 padding-right-20 classic-link padding-bottom-10 "
                title="<?php echo esc_attr($pagination_links['next']['title']);?>"
                href="<?php echo esc_url($pagination_links['next']['url']);?>">
                  <span class="icon-left-hand"></span> <span data-hide-xs><?php echo esc_html($pagination_links['next']['label']);?></span>
                </a>
              <?php } else {?>
                <span class="margin-left-5 display-block  opacity-03 padding-top-10 padding-left-20 padding-right-20 padding-bottom-10"><span class="icon-left-hand"></span> <span data-hide-xs><?php echo esc_html($pagination_links['next']['label']);?></span></span>
              <?php } ?>

            </span>

            <span
            data-flex="30"
            data-flex-sm="20"
            class="padding-both-10 site-palette-yin-4-color  <?php if (!$pagination_links['next']['url'] && !$pagination_links['previous']['url']) {?> opacity-03 <?php }?> "
            data-layout="row"
            data-layout-align="space-around center"
            data-hide-xs>
              <em class="icon-dot"></em>
              <em class="typo-size-medium icon-book-open"></em>
              <em class="icon-dot"></em>
            </span>

            <span data-flex>

              <?php if ($pagination_links['previous']['url']) {?>
                <a
                class="site-palette-yin-3-color margin-right-5 display-block padding-top-10 padding-left-20 padding-right-20 classic-link padding-bottom-10 "
                title="<?php echo esc_attr($pagination_links['previous']['title']);?>"
                href="<?php echo esc_url($pagination_links['previous']['url']);?>">
                  <span data-hide-xs><?php echo esc_html($pagination_links['previous']['label']);?></span> <span class="icon-right-hand"></span>
                </a>
              <?php }else {?>
                <span class="margin-right-5 opacity-03 display-block padding-top-10 padding-left-20 padding-right-20 padding-bottom-10 "><span data-hide-xs><?php echo esc_html($pagination_links['previous']['label']);?></span> <span class="icon-right-hand"></span></span>
              <?php } ?>

            </span>



        </p>



    </div>
  </div>





<?php
get_footer();
