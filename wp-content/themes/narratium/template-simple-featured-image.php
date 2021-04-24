<?php
/*
Template Name: Full Featured Image & Content
Template Post Type: post, page
Template Styles: template-single
Template Description: This template display the post with the post's featured image as cover in the header.
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
	/**
	* If we have the active read time option in the theme we add it as an option in the array
	*/
	if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) {
		$options['displays']['option_type_vars']['post_read_time'] = esc_html__('Post read time', 'narratium');
		$options['displays']['option_default']['post_read_time'] = 1;
	}




	// add option to customize backdrop


	$options['post_items_overlay']['option_name']           	= esc_html__('Items Image Overlay', 'narratium');
	$options['post_items_overlay']['option_description']     	= esc_html__("Select an overlay style to display in post items.", 'narratium');
	$options['post_items_overlay']['option_priority'] 				= 1;
	$options['post_items_overlay']['option_type']            	= 'select';
	$options['post_items_overlay']['option_type_vars']				= array(
																																'' => esc_html__('None', 'narratium'),

																																'backdrop-dark-gradient-subtle' => esc_html__('Dark Gradient Subtle', 'narratium'),
																																'backdrop-dark-gradient-light' => esc_html__('Dark Gradient Light', 'narratium'),
																																'backdrop-dark-gradient-medium' => esc_html__('Dark Gradient Medium', 'narratium'),
																																'backdrop-dark-gradient-high' => esc_html__('Dark Gradient High', 'narratium'),

																																'backdrop-dark-flat-10' => esc_html__('Dark Flat 10%', 'narratium'),
																																'backdrop-dark-flat-20' => esc_html__('Dark Flat 20%', 'narratium'),
																																'backdrop-dark-flat-30' => esc_html__('Dark Flat 30%', 'narratium'),
																																'backdrop-dark-flat-40' => esc_html__('Dark Flat 40%', 'narratium'),
																																'backdrop-dark-flat-50' => esc_html__('Dark Flat 50%', 'narratium'),
																																'backdrop-dark-flat-60' => esc_html__('Dark Flat 60%', 'narratium'),
																																'backdrop-dark-flat-70' => esc_html__('Dark Flat 70%', 'narratium'),
																																'backdrop-dark-flat-80' => esc_html__('Dark Flat 80%', 'narratium'),
																														);
	$options['post_items_overlay']['option_default']					= 'backdrop-dark-gradient-light';





	/**
	* We return the list of options
	*/
	return $options;

}



/**
* This function generates the content of the post cover
*/
if (!function_exists('KTT_post_cover')) {
function KTT_post_cover() {
  global $post, $template;

  ?>


  <div class="padding-left-40 padding-right-40 padding-bottom-30 <?php echo KTT_get_content_width_classname();?> width-100 typography-responsive">
  <div class="width-100 text-align-left  " >

		<h1 class="padding-top-30 padding-bottom-10 site-typeface-title text-size-3xlarge post-title">
			<?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
		</h1>

		<?php if($post->post_subtitle) { ?>
		<h2 hide-xs class="typo-weight-300 opacity-05 padding-top-10 padding-bottom-10 site-typeface-headline text-size-large post-subtitle">
			<?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
		</h2>
		<h2 hide show-xs class="typo-weight-300 opacity-05 padding-top-5 padding-bottom-5 site-typeface-headline text-size-medium post-subtitle">
			<?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
		</h2>
		<?php }?>



		<p class="classic-link-inside text-size-small padding-bottom-10 opacity-04">


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
				<span class="meta ornament-line-before-amper">
						<?php esc_html_e('By', 'narratium');?>
						<?php foreach($authors as $author) {?>
							<strong class="by-user"><a href="<?php echo esc_url(get_author_posts_url($author->ID));?>"><?php echo esc_html($author->display_name);?></a></strong>
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
				<span class="meta ornament-line-before-amper">

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
				<span class="meta ornament-line-before-amper">
					<span class="disqus-comment-count"> <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'narratium'), number_format_i18n( get_comments_number() ) );?></span>
				</span>
				<?php } ?>



				<?php if (
					isset($template->options['displays'])
					&& isset($template->options['displays']['post_read_time'])
					&& $template->options['displays']['post_read_time']
				)  {?>
				<span class="meta ornament-line-before-amper">
					<?php  KTT_display_post_read_time();?>
				</span>
				<?php } ?>




		</p>

      <div data-flex data-hide-xs class="post-item-meta" >
				<?php if ($post->post_credits) {?>
				<div class="classic-link-inside typo-size-xsmall opacity-03"><?php echo wpautop($post->post_credits);?></div>
				<?php } ?>
      </div>

  </div>
  </div>

	<div hide-xs class="padding-both-40"></div>





  <?php


}
}


global $template;
get_header();
?>


    <div data-flex id="site-body">


        <?php
        /**
        * We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
        */
        $args = array(
              "card_id" => "card-post-" . $post->ID,
              "card_classes" => "height-100vh link-white-color  min-height-600px site-palette-yang-1-color",

              /**
              * We get the image data header
              */
              "card_background_attachment" => get_post_thumbnail_id( $post->ID ),

              "card_image_large" => KTT_scaled_image_url(get_post_thumbnail_id( $post->ID ), 'full'),

              /**
              * We call the function that is responsible for creating the content of the site header, we only pass the name of the project because this parameter acts as a callback
              */
              "card_content" => "KTT_post_cover",

              /**
              * We align it as we want.
              */
              "card_align" => "end center",

              "card_video" => true,

        );



				/**
				* We add the overlay option Here
				*/
				$overlay_class = "";
				if (!isset($template->options['post_items_overlay'])) $overlay_class = "backdrop-dark-gradient-light";
				else $overlay_class = $template->options['post_items_overlay'];
				$args["card_classes"] .= " " . $overlay_class;


        /**
        * We execute the function that is really responsible for showing the header
        */
        ?><div id="<?php echo esc_attr($post->ID);?>" data-flex="100" <?php post_class();?>><?php
        KTT_display_image_card($args);
        ?></div>





    		<div class="site-body-content-wrap  site-palette-yin-2-color site-palette-yang-1-background-color padding-top-50 padding-bottom-50 max-width-1500">
    			<div class="<?php echo KTT_get_content_width_classname();?> margin-auto site-typeface-content padding-top-40 site-body-content padding-left-0 padding-bottom-40 padding-right-0 typo-size-content">

            <?php if (have_posts()) : ?>
    				<?php while (have_posts()) : the_post(); ?>



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
                        <p>
                          <?php KTT_post_display_html_tags($post->ID)?>
                        </p>


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

        <div class="padding-both-30"></div>
        <hr class="site-palette-yang-4-border-color">

        <p class="<?php echo KTT_get_content_width_classname();?> nextprev-buttons site-typeface-title-1  typo-size-small text-align-center  padding-top-10 padding-left-40 padding-right-40 margin-auto" data-layout="row">


            <span data-flex>

              <?php if ($pagination_links['next']['url']) {?>
                <a
                class="site-palette-yin-3-color text-align-left margin-left-5 display-block   padding-top-10 padding-left-20 padding-right-20 classic-link padding-bottom-10 "
                title="<?php echo esc_attr($pagination_links['next']['title']);?>"
                href="<?php echo esc_url($pagination_links['next']['url']);?>">
                  <span class="icon-left-hand"></span> <span data-hide-xs><?php echo esc_attr($pagination_links['next']['label']);?></span>
                </a>
              <?php } else {?>
                <span class="margin-left-5  text-align-left display-block opacity-03 padding-top-10 padding-left-20 padding-right-20 padding-bottom-10"><span class="icon-left-hand"></span> <span data-hide-xs><?php echo esc_html($pagination_links['next']['label']);?></span></span>
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
                <a class="site-palette-yin-3-color text-align-right margin-right-5 display-block padding-top-10 padding-left-20 padding-right-20 classic-link padding-bottom-10 "
								title="<?php echo esc_attr($pagination_links['previous']['title']);?>"
								href="<?php echo esc_url($pagination_links['previous']['url']);?>">
                  <span data-hide-xs><?php echo esc_html($pagination_links['previous']['label']);?></span> <span class="icon-right-hand"></span>
                </a>
              <?php }else {?>
                <span class="margin-right-5 text-align-right opacity-03 display-block padding-top-10 padding-left-20 padding-right-20 padding-bottom-10 "><span data-hide-xs><?php echo esc_html($pagination_links['previous']['label']);?></span> <span class="icon-right-hand"></span></span>
              <?php } ?>

            </span>



        </p>








        <?php
          // If comments are open or we have at least one comment, load up the comment template
					if (is_single() || is_page()) if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
          endif;
        ?>


    </div>





<?php
get_footer();
