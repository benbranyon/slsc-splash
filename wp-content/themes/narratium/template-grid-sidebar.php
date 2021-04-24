<?php
/*
Template Name: Dynamic Sidebar & Photo Grid
Template Post Type: category, post_tag, user, frontpage, archive, search
Template Styles: template-grid
*/
if(isset($config_mode) && $config_mode){

      // add option to admin panel

      $options   = array();
      $options['images_placeholder']['option_name']           	= esc_html__('Image Placeholders', 'narratium');
      $options['images_placeholder']['option_description']     	= esc_html__("Select a placeholder source to display images in posts without featured image.", 'narratium');
      $options['images_placeholder']['option_priority'] 				= 1;
      $options['images_placeholder']['option_type']            	= 'select';
      $options['images_placeholder']['option_type_vars']				= array(
                                                                  '' => esc_html__('Disabled', 'narratium'),
                                                                  'unsplash' => esc_html__('Use Unsplash source API', 'narratium'),
                                                                  'unsplash_with_post_tags' => esc_html__('Use Unsplash source API with post tags filter', 'narratium'),
                                                                );
      $options['images_placeholder']['option_default']					= '';



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





      // add option to display / hide meta

      $options['displays']['option_name']           	= esc_html__('Display / Hide Elements', 'narratium');
    	$options['displays']['option_description']     	= esc_html__("Check the elements to display in this template.", 'narratium');
    	$options['displays']['option_priority'] 				= 1;
    	$options['displays']['option_type']            	= 'checkboxes';
    	$options['displays']['option_type_vars']				= array(
    																										'post_author' => esc_html__('Post author', 'narratium'),
    																										'post_comments_count' => esc_html__('Post comments count', 'narratium'),
    																									);
    	$options['displays']['option_default']					= array(
    																										'post_author' => 1,
    																										'post_comments_count' => 1,
    																									);
    	/**
    	* If we have the active read time option in the theme we add it as an option in the array
    	*/
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





      /**
      * We return the list of options
      */
      return $options;


}



/**
* This small function helps us to round
* https://stackoverflow.com/a/4133893
*/
if (!function_exists("KTT_round_up_to_any")) {
function KTT_round_up_to_any($n,$x=3) {
    return round(($n+$x/2)/$x)*$x;
}
}


/**
* Start the template
*/
global $wp_query;
get_header();
global $template;

?>


<?php echo KTT_display_sideheader();?>

<div data-flex id="site-body" class="template-grid-default site-palette-yin-1-background-color site-palette-yang-4-color">
	<div class="site-body-content-wrap min-height-100vh " data-flex data-layout="row" data-layout-wrap data-layout-align="center center">

      <?php if (!$wp_query->posts) {?>
          <div data-flex >
            <div class="typo-size-upper-big icon-emo-unhappy"></div>
            <div class="typo-size-medium padding-top-20 typo-weight-300"><?php esc_html_e('Sorry, no results found.', 'narratium');?></div>
          </div>
      <?php } ?>


  		<?php

      /**
      * We calculate the number of posts that we need to double in size so that the mosaic does not have spaces
      */
      $posts_to_double = 0;
      $posts_to_double = KTT_round_up_to_any(count($wp_query->posts)) - count($wp_query->posts);
      if ($posts_to_double > 2) $posts_to_double = 0;

      $count = 0;
  		if ($wp_query->posts) {

        foreach($wp_query->posts as $post) {
          $count += 1;


  				/**
  				* We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
  				*/
  				$args = array(
    						"card_id" => "card-post-" . $post->ID,
                "wrap_classes" => "site-palette-yin-1-background-color position-relative basic-sideheader overflow-hidden ",
    						"card_classes" => "height-40vw width-100 min-height-500px max-height-800px link-white-color card-post site-palette-yang-1-color",

    						/**
    						* We get the image data header
    						*/
    						"card_background_attachment" => get_post_thumbnail_id( $post->ID ),

    						/**
    						* We call the function that is responsible for creating the content of the site header, we only pass the name of the project because this parameter acts as a callback
    						*/
    						"card_content" => array("KTT_single_post_card_content", $post->ID, $template),

    						/**
    						* We align it as we want.
    						*/
    						"card_align" => "end stretch",
  				);



          /**
          * If we do not have a thumbnail and in the template we have defined using the appp of unspplash we are going to it
          */
          if (
            !$args["card_background_attachment"]
            && isset($template->options['images_placeholder'])
            && $template->options['images_placeholder']
          ) {

              $sizes = array(
                '300x500',
                '300x600',
                '320x620',
                '340x620',
                '350x620',
                '360x620',
                '320x640',
                '320x680',
                '320x670',
                '455x555',
                '466x666',
                '477x777',
                '488x888',
                '499x799',
                '456x856');

              $size = $sizes[array_rand($sizes,1)];

              $tags = wp_get_post_tags($post->ID);
              if ($tags && $template->options['images_placeholder'] == "unsplash_with_post_tags") {
                $tags = wp_list_pluck($tags, 'name');
              } else {
                $tags = array('nature', 'women', 'portrait', 'photography', 'landscapes', 'animals', 'travel', 'love', 'health','friends', 'office', 'business', 'cats', 'girl', 'dogs', 'hills');
              }
              $tag = $tags[array_rand($tags,1)];
              $args["card_image_medium"] = "https://source.unsplash.com/random/" . $size . "/?" . $tag ;
              $args["card_image_large"] = "https://source.unsplash.com/random/" . $size . "/?" . $tag;
              $args["card_background_attachment"] = 1;

          }



          /**
          * We add the overlay option Here
          */
          $overlay_class = "";
          if (!isset($template->options['post_items_overlay'])) $overlay_class = "backdrop-dark-gradient-light";
          else $overlay_class = $template->options['post_items_overlay'];
          $args["card_classes"] .= " " . $overlay_class;


          /**
          * We add overlay cssgram effects!
          */
          $overlay_effect_class = "";
          if (isset($template->options['post_items_image_effect'])) $overlay_effect_class = $template->options['post_items_image_effect'];
          $args["wrap_classes"] .= " " . $overlay_effect_class;




  				/**
  				* We execute the function that is really responsible for showing the header
  				*/
  				?><div
          data-layout="row"
          data-layout-xs="column"
          data-layout-sm="column"
          data-layout-align="end stretch"
          id="<?php echo esc_attr($post->ID);?>"
            <?php post_class(esc_attr(" button-behaviour md-whiteframe-10dp post-item"));?>



            <?php if ($posts_to_double && $count < 2) {
              $posts_to_double -= 1;
              ?>
              data-flex="66"
              data-flex-md="100"
              data-flex-sm="100"
              data-flex-xs="100"
            <?php } else if ($count > 2 && $posts_to_double && count($wp_query->posts) < 6 ) {
              $posts_to_double -= 1;
              ?>
              data-flex="66"
              data-flex-md="100"
              data-flex-sm="100"
              data-flex-xs="100"
            <?php } else if ($count > 5 && $posts_to_double && count($wp_query->posts) >= 6 ) {
              $posts_to_double -= 1;
              ?>
              data-flex="66"
              data-flex-md="100"
              data-flex-sm="100"
              data-flex-xs="100"
            <?php } else { ?>
              data-flex="33"
              data-flex-md="50"
              data-flex-sm="100"
              data-flex-xs="100"
            <?php } ?>


            ><?php
  				KTT_display_image_card($args);
  				?></div><?php


  		}
      }
  		?>




	</div>



  <?php
  /**
  * Obtain the links of previous and next
  */
  $pagination_links = KTT_get_next_previous_links();
  ?>

  <div
  data-hide
  data-show-xs
  class="site-palette-yin-1-background-color ">

  <hr class="opacity-01 margin-both-0 padding-both-0">

  <div
  class="nextprev-buttons backdrop-dark-flat-90 post-item-meta link-white-color text-align-center"
  data-layout="row">

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
  </div>


</div>



<?php
get_footer();
