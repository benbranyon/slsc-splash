<?php
/*
Template Name: Front Page
Template Post Type: post, page, user, category, post_tag, frontpage, archive, search
Template Description: Simple list of posts. This template can be used for single pages too.
Template styles: template-single
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

  <div data-flex data-layout="column"  data-layout-align="center stretch">
    <div  id="site-body" <?php if (is_single()) post_class();?>>

    		<div class="typography-responsive site-body-content-wrap max-width-1500">
    			<div class="margin-auto site-typeface-content site-body-content padding-left-0 padding-right-0 typo-size-content">


            <?php if (!$wp_query->posts) {?>
                <div data-flex >
                  <div class="typo-size-upper-big icon-emo-unhappy"></div>
                  <div class="typo-size-medium padding-top-20 typo-weight-300"><?php esc_html_e('Sorry, no results found.', 'narratium');?></div>
                </div>
            <?php } ?>


            <?php if (have_posts()) : ?>
    				<?php while (have_posts()) : the_post(); ?>



                  <?php if (is_single() || is_page()) {?>
                        <div id="scene-container">
                          <canvas id="stage"></canvas>
                        </div>
                        <?php 
                          $url = site_url( '/the-stalker-state', 'https' ); 
                        ?>
                        <div class="intro-button">
                          <a class="button-behaviour cursor-pointer display-block padding-both-10 padding-left-20 padding-right-20 text-align-center site-palette-yin-2-color site-palette-yang-4-background-color flex-auto" href="<?php echo $url?>">Enter</a>
                          <h1>The Stalker State</h1> 
                          <p>A sprawling web of entities committed to data-collection, with the intent to police us and cause harm.</p>
                          <p>Here are three concepts we hope will help paint the picture.</p>
                        </div>

                        <div class="clearfix"></div>


                        <?php
                        global $multipage;
                        if (0 !== $multipage) {?>
                        <div class="multi-page-pagination site-typeface-caption-1 site-palette-yang-3-background-color text-align-center padding-both-5 margin-both-50">
                          <?php wp_link_pages();?>
                        </div>
                        <?php }?>

                  <?php } else {?>

                        <h2 class=" typo-size-large">
                          <a href="<?php echo get_permalink();?>" class=" classic-link site-palette-yin-1-color site-typeface-title typo-size-xlarge post-title">
                          <?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
                          </a>
                        </h2>

                        <h3 class="typo-weight-300 site-palette-yin-3-color padding-top-0 padding-bottom-5 site-typeface-headline typo-size-medium post-subtitle">
                          <?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
                        </h3>

                        <?php the_excerpt();?>

                        <p>
                          <a class="typo-size-xsmall site-typeface-body margin-left-5 display-inline-block border-style-solid  md-whiteframe-2dp border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 button-behaviour padding-bottom-10 " href="<?php echo the_permalink();?>">
                          <em class="icon-book-open padding-right-5 "></em> <?php esc_html_e('Read more', 'narratium');?>
                          </a>
                        </p>

                        <div class="padding-both-30"></div>
                        <hr class="site-palette-yang-4-border-color">
                        <div class="padding-both-20"></div>

                  <?php } ?>
    				<?php endwhile; ?>
    				<?php endif; ?>
    			</div>
    		</div>
    </div>
  </div>

<?php
get_footer();
