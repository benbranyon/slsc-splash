<?php
/*
Template Name: Dynamic Sidebar & Content
Template Post Type: post, page, category, post_tag, user, archive
Template Description: Custom template with left-side site cover.
Template Styles: template-single
*/
if(isset($config_mode) && $config_mode){



    // add option to admin panel

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




    /**
    * Posts per page
    */
    $options['posts_per_page']['option_name']             = esc_html__('Posts per page', 'narratium');
    $options['posts_per_page']['option_description']      = esc_html__("You can select how many posts per page are going to be shown by this template.", 'narratium');
    $options['posts_per_page']['option_priority'] 	      = 5;
    $options['posts_per_page']['option_type']             = 'select';
    $options['posts_per_page']['option_type_vars']			  = array_merge(array('' => esc_html__("default", 'narratium')), array_combine(range(1,30), range(1,30)));
    $options['posts_per_page']['option_default']					= '';




    return $options;

}


get_header();

?>



<?php echo KTT_display_sideheader();?>

    <div data-flex id="site-body">


    		<div class="typography-responsive site-body-content-wrap padding-both-10 padding-top-40">
    			<div class="site-typeface-content <?php echo KTT_get_content_width_classname();?> site-body-content min-height-50vh padding-bottom-40 padding-top-40 margin-auto typo-size-content">

            <?php if (have_posts()) : ?>
    				<?php while (have_posts()) : the_post(); ?>


              <?php if (is_single() || is_page()) {?>

                    <?php if (is_page()) {?>
                    <span class="display-block opacity-08 margin-auto classic-link-inside site-typeface-body typo-size-xsmall typo-weight-400">
                      <?php KTT_breadcrumbs();?>
                    </span>
                    <?php } ?>


                    <?php the_content();?>

                    <div class="clearfix  padding-both-30"></div>


                    <?php
                    global $multipage;
                    if (0 !== $multipage) {?>
                    <div class="multi-page-pagination site-typeface-caption-1 site-palette-yang-3-background-color text-align-center padding-both-5 margin-both-50">
                      <?php wp_link_pages();?>
                    </div>
                    <?php }?>


                    <?php
                    /**
                    * Tags list!
                    */
                    ?>
                    <p class="display-block padding-top-20">
                      <?php if (!post_password_required()) KTT_post_display_html_tags($post->ID)?>
                    </p>

              <?php } else {?>

                    <p><a
                    title="<?php the_title();?>"
                    href="<?php the_permalink();?>"
                    class="classic-link padding-top-30 site-palette-yin-2-color display-block padding-bottom-5 site-typeface-title typo-size-xxlarge post-title">
                      <?php echo strip_tags(KTT_get_the_title(), '<strong>,<b>,<i>,<em>,<u>');?>
                    </a></p>

                    <?php if($post->post_subtitle) { ?>
                    <h2 class="typo-weight-300 site-palette-yin-3-color padding-top-5 padding-bottom-10 site-typeface-headline typo-size-medium post-subtitle">
                      <?php echo strip_tags(KTT_get_the_subtitle(), '<strong>,<b>,<i>,<em>,<u>');?>
                    </h2>
                    <?php }?>

                    <?php the_excerpt();?>

                    <p><a
                    title="<?php the_title();?>"
                    href="<?php the_permalink();?>"
                    class="classic-link padding-top-10 site-palette-special-1-color">
                      <?php esc_html_e('Continue reading', 'narratium')?>
                    </a></p>

                    <div class="padding-both-30"></div>
                    <hr class="site-palette-yang-4-border-color">
                    <div class="padding-both-20"></div>


              <?php } ?>


    				<?php endwhile; ?>
    				<?php endif; ?>





    			</div>
    		</div>







        <?php
        /**
        * Obtain the links of previous and next
        */
        $pagination_links = KTT_get_next_previous_links();


        ?>
        <div data-hide-gt-sm>
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










        <?php
          // If comments are open or we have at least one comment, load up the comment template
          if (is_single() || is_page()) if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
          endif;
        ?>


    </div>





<?php
get_footer();
