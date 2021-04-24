<?php
/*
Template Name: Dynamic Sidebar & Masonry Columns
Template Post Type: category, post_tag, user, frontpage, archive, search
Template Styles: template-grid
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
                                                    'page_navigation_extra' => esc_html__('Extra navigation controls', 'narratium'),
                                                  );
  $options['displays']['option_default']					= array(
                                                    'post_categories' => 1,
                                                    'post_author' => 1,
                                                    'post_comments_count' => 1,
                                                    'post_categories' => 1,
                                                    'post_date' => 1,
                                                    'extra_navigation_controls' => 0
                                                  );

  if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) {
    $options['displays']['option_type_vars']['post_read_time'] = esc_html__('Post read time', 'narratium');
    $options['displays']['option_default']['post_read_time'] = 1;
  }




  /**
  * CSSGram for fun!
  */
  $options['post_items_image_effect']['option_name']           	= esc_html__('Items CSSGram Effects', 'narratium');
  $options['post_items_image_effect']['option_description']     = esc_html__("Select an image effect to display in post items featured images. See https://una.im/CSSgram/", 'narratium');
  $options['post_items_image_effect']['option_priority'] 				= 1;
  $options['post_items_image_effect']['option_type']            = 'select';
  $options['post_items_image_effect']['option_type_vars']				= array(
                                                                    '' => esc_html__('None', 'narratium'),
                                                                    '_1977'       => '1977',
                                                                    'aden'        => 'Aden',
                                                                    'brannan'     => 'Brannan',
                                                                    'broocklyn'   => 'Broocklyn',
                                                                    'clarendon'   => 'Clarendon',
                                                                    'earlybird'   => 'Earlybird',
                                                                    'gingham'     => 'Gingham',
                                                                    'hudson'      => 'Hudson',
                                                                    'inkwell'     => 'Inkwell',
                                                                    'kelvin'      => 'Kelvin',
                                                                    'lark'        => 'Lark',
                                                                    'lofi'        => 'Lofi',
                                                                    'maven'       => 'Maven',
                                                                    'mayfair'     => 'Mayfair',
                                                                    'moon'        => 'Moon',
                                                                    'nashville'   => 'Nashville',
                                                                    'perpetua'    => 'Perpetua',
                                                                    'reyes'       => 'Reyes',
                                                                    'rise'        => 'Rise',
                                                                    'slumber'     => 'Slumber',
                                                                    'stinson'     => 'Stinson',
                                                                    'toaster'     => 'Toaster',
                                                                    'valencia'    => 'Valencia',
                                                                    'walden'      => 'Walden',
                                                                    'willow'      => 'Willow',
                                                                    'xpro2'       => 'XPro2'
                                                              );
  $options['post_items_image_effect']['option_default']			= '';






  /**
  * Posts per page
  */
  $options['posts_per_page']['option_name']             = esc_html__('Posts per page', 'narratium');
  $options['posts_per_page']['option_description']      = esc_html__("You can select how many posts per page are going to be shown by this template.", 'narratium');
  $options['posts_per_page']['option_priority'] 	      = 5;
  $options['posts_per_page']['option_type']             = 'select';
  $options['posts_per_page']['option_type_vars']			  = array(
                                                          '' => esc_html__("default", 'narratium'),
                                                          6 => "6",
                                                          9 => "9",
                                                          12 => "12",
                                                          15 => "15",
                                                          18 => "18",
                                                          21 => "21",
                                                          24 => "24"
                                                        );
  $options['posts_per_page']['option_default']					= '';






  return $options;

}


/**
* This template requires some custom CSS for masonry purposes
*/
if (!function_exists('KTT_add_template_custom_css')) {

  function KTT_add_template_custom_css() {
      ?>
        <style>
          @media screen and (max-width: 1120px){#posts-list[data-columns]::before {content: '1 .column.size-1of1';}}
          @media screen and (min-width: 1120px) and (max-width: 1700px) {#posts-list[data-columns]::before {content: '2 .column.size-1of2';}}
          @media screen and (min-width: 1700px) {#posts-list[data-columns]::before {content: '3 .column.size-1of3';}}
          #posts-list[data-columns] > .column > div {border-style:solid;border-width: 0px 0 1px 0;}
          #posts-list[data-columns] > .column {border-style:solid;border-width: 0 1px 0px 0;}
          #posts-list[data-columns] > .column:last-child {border-width: 0;}
          .column { float: left; }
          .size-1of1 { width: 100%; }
          .size-1of2 { width: 50%; }
          .size-1of3 { width: 33.333%; }
        </style>
      <?php
  }

  add_action( 'wp_enqueue_scripts', 'KTT_add_template_custom_css', 9999 );

}














/**
* Start the template
*/
global $wp_query, $template;
get_header();

?>


<?php echo KTT_display_sideheader();?>

<div data-flex id="site-body" class="template-masonry-default site-palette-yang-1-background-color site-palette-yin-2-color">


      <?php if (!$wp_query->posts) {?>
          <div data-flex >
            <div class="typo-size-xxxlarge icon-emo-unhappy"></div>
            <div class="typo-size-medium padding-top-20 typo-weight-300"><?php esc_html_e('Sorry, no results found.', 'narratium');?></div>
          </div>
      <?php } ?>


      <?php if (have_posts()) : ?>
        <div
        id="posts-list"
        data-columns
        class="text-align-left">
          <?php while (have_posts()) : the_post(); ?>

                <div

                style="vertical-align:top;"
                class=" site-palette-yang-4-border-color padding-both-50">

                  <?php
                  $thumb = get_post_thumbnail_id($post->ID);

                  $image_effect = '';
                  if (isset($template->options['post_items_image_effect'])) $image_effect = $template->options['post_items_image_effect'];

                  if ($thumb) {?>
                    <a class="classic-link site-palette-special-1-color" title="<?php the_title();?>" href="<?php the_permalink();?>">
                    <img
                    alt="<?php esc_attr($post->post_title);?>"
                    class="display-block border-radius-3 padding-bottom-20 <?php echo esc_attr($image_effect);?>"
                    style="width:100%"
                    src="<?php echo esc_url(KTT_scaled_image_url(get_post_thumbnail_id($post->ID), 'large'));?>">
                    </a>
                  <?php } ?>

                  <a
                  title="<?php the_title();?>"
                  href="<?php the_permalink();?>"
                  class="classic-link display-block site-palette-yin-2-color padding-bottom-5 site-typeface-title typo-size-xlarge post-title">
                    <?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
                  </a>

                  <?php //if ($post->post_subtitle) {?>
                  <h2 class="typo-weight-300 site-palette-yin-3-color padding-top-5 padding-bottom-0 site-typeface-headline typo-size-base ">
                    <?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
                  </h2>
                  <?php //} ?>

                  <div class="typo-size-xsmall"><?php the_excerpt();?></div>


                  <div data-flex class="item-meta post-item-meta classic-link-inside typo-size-xsmall padding-bottom-20">


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
                          <?php echo esc_html__('By', 'narratium');?>
                          <?php foreach($authors as $author) {?>
                            <strong class="by-user"><a href="<?php echo get_author_posts_url($author->ID);?>"><?php echo esc_html($author->display_name);?></a></strong>
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
                      <span class="meta  ornament-line-before-amper">
                        <?php KTT_display_post_read_time();?>
                      </span>
                      <?php } ?>

                      <span class="meta  ornament-line-before-amper">
                      <a class="classic-link site-palette-special-1-color font-weight-700" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php esc_html_e('Continue reading', 'narratium');?></a>
                      </span>

                  </div>


                </div>
  				    <?php endwhile; ?>
        </div>
      <?php endif; ?>




      <?php
      /**
      * Obtain the links of previous and next
      */
      $pagination_links = KTT_get_next_previous_links();
      ?>
      <div style="clear:both"></div>
      <div <?php if (
        isset($template->options['displays'])
        && isset($template->options['displays']['page_navigation_extra'])
        && $template->options['displays']['page_navigation_extra']
      )  {?>data-show<?php } else {?> data-hide <?php } ?> data-show-sm data-show-xs>
      <hr style="margin-top:-1px;" class="site-palette-yang-4-border-color margin-both-0">
      <p class="<?php echo KTT_get_content_width_classname();?> nextprev-buttons site-typeface-title-1  typo-size-small text-align-center  padding-top-20 padding-left-40 padding-right-40 margin-auto" data-layout="row">


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
      </div>

</div>



<?php
global $wp_scripts;
$salvattore_url = '';
if (isset($wp_scripts->registered['salvattore.min'])) $salvattore_url = $wp_scripts->registered['salvattore.min']->src;
if ($salvattore_url) {
?>
<script>
jQuery.getScript( "<?php echo esc_url($salvattore_url);?>", function( data, textStatus, jqxhr ) {
	jQuery('#posts-list > .column').addClass("site-palette-yang-4-border-color");
});
</script>
<?php } ?>

<?php
get_footer();
