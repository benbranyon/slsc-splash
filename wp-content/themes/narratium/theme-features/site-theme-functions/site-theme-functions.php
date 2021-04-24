<?php
/**
* In this file we will store all the exclusive functions of the theme
version: 1.0.2
*/


/**
* This function will return the content width in the current page
*/
function KTT_get_current_content_width() {return 800;}

/**
* This function return the classname of the current content width
*/
function KTT_get_content_width_classname() {return 'max-width-800px';}

/**
* Get the frontpage template
*/
function KTT_get_frontpage_posts_template() {

      /**
      * We get the id from the template
      */
      $template_id = get_option(KTT_theme_var_name('frontpage_posts_template'));

      /**
      * We get the template
      */
      $template = KTT_get_theme_template($template_id);

      /**
      * We return the template
      */
      return $template;

}



/**
* This function is responsible for obtaining the links of next and previous of a page
*/
function KTT_get_next_previous_links() {


    /**
    * We form the result array
    */
    $result = array(
      'previous' => array(
        'title' => '',
        'url' => '',
        'label' => esc_html__('Previous', 'narratium'),
      ),
      'next' => array(
        'title' => '',
        'url' => '',
        'label' => esc_html__('Next', 'narratium'),
      ),
    );


    /**
    * If we are on a single page we have to obtain the links of following and previous post
    */
    if (is_single()) {

          /**
          * Default
          */
          $result['previous']['label']  = esc_html__('Next', 'narratium');
          $result['next']['label']  = esc_html__('Previous', 'narratium');

          $next = get_previous_post();
          $prev = get_next_post();

          /**
          * We form the array with the data of the link previous
          */
          if ($next) {
            $result['previous']['title']  = $next->post_title;
            $result['previous']['url']    = get_permalink($next);
            $result['previous']['label']  = esc_html__('Next', 'narratium');
          }

          /**
          * We form the array with the data of the link next
          */
          if ($prev) {
            $result['next']['title']  = $prev->post_title;
            $result['next']['url']    = get_permalink($prev);
            $result['next']['label']  = esc_html__('Previous', 'narratium');
          }


    /**
    * By default we try to obtain the next and previous links of the query that we are using
    */
    } else {

          /**
          * Default
          */
          $result['previous']['label']  = esc_html__('Next page', 'narratium');
          $result['next']['label']  = esc_html__('Previous page', 'narratium');

          $next = get_previous_posts_link();
          $prev = get_next_posts_link();

          /**
          * We form the array with the data of the link previous
          */
          if ($prev) {
            $result['previous']['title']  = esc_html__('Next page', 'narratium');
            $result['previous']['url']    = get_next_posts_page_link();
            $result['previous']['label']  = esc_html__('Next page', 'narratium');
          }

          /**
          * We form the array with the data of the link next
          */
          if ($next) {
            $result['next']['title']  = esc_html__('Previous page', 'narratium');
            $result['next']['url']    = get_previous_posts_page_link();
            $result['next']['label']  = esc_html__('Previous page', 'narratium');
          }

    }


    /**
    * We return the array as a result of the function
    */
    return $result;

}




/**
* This function obtains the id delo logo of the site
*/
function KTT_get_site_logo_id() {
  return get_theme_mod( 'custom_logo' );
}

/**
* This function is responsible for obtaining the URL of the logo in the size that we will pass
*/
function KTT_get_site_logo_url($size = 'medium') {

  /**
  * First of all we get the logo id
  */
  $logo_id = KTT_get_site_logo_id();

  /**
  * If there is no id we leave here
  */
  if (!$logo_id) return;

  /**
  * We return the url to the size that we have requested
  */
  return KTT_scaled_image_url($logo_id, $size);

}

/**
* this function is responsible for obtaining the logo of the site if it has it
*/
function KTT_get_site_logo_attachment() {

      /**
      * First of all we try to obtain the id of the attachment of the image that acts as logo on our site
      */
      $logo_id = get_theme_mod( 'custom_logo' );

      /**
      * If we do not have a logo, we leave here
      */
      if (!$logo_id) return;

      /**
      * We get the attachment
      */
      $result = KTT_get_post($logo_id);

      /**
      * We return the result
      */
      return $result;

}





function KTT_get_archive_template() {


    /**
    * If we have not obtained a template id then we will check if the theme has a default one defined for the categories that do not have it
    */
    $template_id = '';
    if (!$template_id) $template_id = get_option(KTT_theme_var_name('archive_template'));

    /**
    * If at this point we continue without template id we are going to obtain the complete list and we are left with the first
    */
    if (!$template_id) {

        /**
        * list of templates
        */
        $templates = KTT_get_theme_templates_by_type('archive');

        /**
        * We are left alone with the first value
        */
        $t = reset($templates);
        $template_id = $t->id;

    }

    /**
    * We get the template_id object
    */
    $template = KTT_get_theme_template($template_id);

    /**
    * Let's devote the template
    */
    return $template;

}



function KTT_get_search_template() {


    /**
    * If we have not obtained a template id then we will check if the theme has a default one defined for the categories that do not have it
    */
    $template_id = '';
    if (!$template_id) $template_id = get_option(KTT_theme_var_name('search_template'));

    /**
    * If at this point we continue without template id we are going to obtain the complete list and we are left with the first
    */
    if (!$template_id) {

        /**
        * list of templates
        */
        $templates = KTT_get_theme_templates_by_type('search');

        /**
        * We are left alone with the first value
        */
        $t = reset($templates);
        $template_id = $t->id;

    }

    /**
    * We get the template_id object
    */
    $template = KTT_get_theme_template($template_id);

    /**
    * Let's devote the template
    */
    return $template;

}



/**
* This function is in charge of obtaining the posts that we are showing in the current page and we obtain an image of one of the random posts
*/
function KTT_get_featured_image_from_current_posts() {

      /**
      * If we have arrived here it means that the category does not have a defined image, therefore we will obtain the last 10-15 posts belonging to the category and extract the highlighted image from one of its posts to use it as an image of the category
      */
      global $wp_query;

      // RANDOM!
      $posts = '';
      if ($wp_query->posts) {
        $posts = $wp_query->posts;
        shuffle($posts);
      }

      /**
      * We go through each post and extract the first featured image that we find
      */
      if ($posts) foreach ($posts as $post) {
          $attach_id = get_post_thumbnail_id($post->ID);
          if ($attach_id) return $attach_id;
      }

      return false;

}




/**
* This function is responsible for returning the attachment id of the image that we have put as a header image of the site
*/
function KTT_get_header_image_attachment_id() {
    $header = get_custom_header();
    if ($header && isset($header->attachment_id)) return $header->attachment_id;
}



/**
* This function is responsible for showing an image div is a very useful function used by elements that must show an image...
**/
function KTT_display_image_card($args = '') {

      /**
      * We define an array with the default values that the args parameter of the function has
      */
      $defaults = array(

          /**
          * Wrap classes
          */
          "wrap_classes" => "site-palette-yin-1-background-color position-relative basic-sideheader overflow-hidden ",

          /**
          * This defines the id that we can give to the element
          */
          "card_id" => "card-" . rand(100, 9999),

          /**
          * We can also define a string with particular classes that we want to give our card...
          */
          "card_classes" => "",

          /**
          * Define the content that will be put inside the element
          */
          "card_content" => "",

          /**
          * If we want the card to link to a url, we can indicate it here
          */
          "card_href" => "",

          /**
          * We show video if you have it?
          */
          "card_video" => false,

          /**
          * Custom styles
          */
          "card_style" => "",

          /**
          * The alignment of the content
          */
          "card_align" => "space-between stretch",

          /**
          * The background attachment must be the id of the image that we will use as a background for the div.
          */
          "card_background_attachment" => 0,

          /**
          * Instead of an attachment we can also directly indicate the image we want to upload
          */
          "card_image_medium" => "",
          "card_image_large" => "",

      );

      /**
      * To parse arguments!
      */
      $args = wp_parse_args( $args, $defaults);




      /**
      * We are going to define what type of element we should apply, if a href has not been indicated we will use a div, otherwise we must convert the card into a link
      */
      $elem_type = 'div';
      if ($args['card_href']) $elem_type = 'a';


      /**
      * Before going to form the html we apply a filter on the parameters of the function this allows us to edit them from third functions
      */
      $args = apply_filters("KTT_theme_display_image_card_args", $args);


      /**
      * If an attachment has been indicated, we will extract the image in different sizes
      */
      if ($args['card_background_attachment']) {

          /**
          * We take a reduced version of the image, this is the image that we are going to load first
          */
          if (!$args['card_image_medium']) $args['card_image_medium'] = KTT_scaled_image_url($args['card_background_attachment'], 'medium');

          /**
          * We take the real version of the image, Generally this image has more weight so we will try to load it dynamically in the background and while we will show the medium version of the image
          */
          if (!$args['card_image_large']) $args['card_image_large'] = KTT_scaled_image_url($args['card_background_attachment'], 'large');

          /**
          * If we have an attachment defined then we will add the class "ktt-backgroundy" to the list of classes. This class makes the background load properly
          */
          $args['card_classes'] .= " ktt-backgroundy";

      }

      ?>




        <div
        id="<?php echo esc_attr($args['card_id']);?>"
        data-flex
        data-flex-xs="none"
        data-flex-sm="none"
        data-background-thumb="<?php echo esc_url($args['card_image_medium']);?>"
        data-background-large="<?php echo esc_url($args['card_image_large']);?>"
        class="<?php echo esc_attr($args['wrap_classes']);?>"
        >

            <?php
            /**
            * Display featured video
            */
            if ($args["card_video"] && is_header_video_active() && get_header_video_url()) { ?>
                <?php the_custom_header_markup();?>
            <?php }?>


            <<?php echo esc_attr($elem_type);?>
            <?php if ($args['card_href']) {?>href="<?php echo esc_url($args['card_href']);?>"<?php } ?>
            style="position:relative;z-index:10;<?php echo esc_html($args['card_style']);?>"
            data-layout-align="<?php echo esc_html($args['card_align']);?>"
            data-layout="column"
            class="card-content site-palette-yang-1-color <?php echo esc_attr($args['card_classes']);?> <?php echo esc_html($args['card_id']);?>-content"
            >

                <?php if ($args["card_content"]) {
                    if (is_array($args["card_content"])) {

                      if (count($args["card_content"]) > 2) echo call_user_func($args["card_content"][0], $args["card_content"][1], $args["card_content"][2]);
                      else call_user_func($args["card_content"][0], $args["card_content"][1]);

                    } else {
                      echo call_user_func($args["card_content"]);
                    }
                }?>

            </<?php echo esc_attr($elem_type);?>>

        </div>


        <script>
        jQuery( document ).ready(function() {
            jQuery( "#<?php echo esc_js($args['card_id']);?>" ).ktt_backgroundy();
        });
        </script>

  <?php
}
