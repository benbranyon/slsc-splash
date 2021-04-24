<?php




function KTT_widget_featured_post_content($post) {

  ?>
  <a
  data-layout="column"
  href="<?php echo get_permalink($post->ID);?>"
  class=" width-100 position-relative overflow-hidden font-white-color text-align-center padding-both-30"
  style="background-color:rgba(0,0,0,0.5);"
  data-layout-align="end center"
  data-flex>



        <div class="text-size-base font-weight-700 site-typeface-base">
          <?php echo get_the_title($post->ID);?>
        </div>

        <?php
          /**
          * We get the list of authores
          */
          if (function_exists("get_coauthors")) $authors = get_coauthors($post->ID);
          else if (function_exists("KTT_get_post_author_and_coauthors")) $authors = KTT_get_post_author_and_coauthors($post->ID);
          else $authors = array(KTT_get_user($post->post_author));

          /**
          * We plan for each of them
          */
          if ($authors) {
        ?>
        <hr class="min-width-100px site-palette-yang-1-brder-color opacity-02">
        <div class="display-block meta text-size-xsmall ornament-line-before-amper opacity-08">
            <?php echo esc_html__('By', 'narratium');?>
            <?php foreach($authors as $author) {?>
              <strong class="by-user"><?php echo esc_html($author->display_name);?></strong>
            <?php } ?>
        </div>
        <?php } ?>


  </a>
  <?php

}



/**
* Adds Featured Post widget
*/
class KTT_featured_post_widget extends KTT_widget_creator {

	/**
	* Register widget with WordPress
	*/
	function __construct() {
		parent::__construct(
			'ktt_featured_post_widget', // Base ID
			wp_get_theme()->get('Name') . ' - ' . esc_html__( 'Featured post', 'narratium' ), // Name
			array( 'description' => esc_html__( 'Display a featured post in the widget area', 'narratium' ), ) // Args
		);
    add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
	}



  public function form_head($instance) {
    ?>
    <p><small>
      <?php _e('Insert the ID of the post to be highlighted in the widget. If you does not insert a post ID you can also active the filter options to select a post dynamically.', 'narratium');?>
    </small>
    </p><hr>
    <?php
  }




  public function get_widget_fields() {

    return array(
      array(
  			'label' => __('Post ID', 'narratium'),
        'description' => __('Insert the ID of the post to be highlighted.', 'narratium'),
  			'id' => 'include',
  			'default' => '',
  			'type' => 'number',
  		),


      array(
  			'label' => '',
        'description' => '<hr>',
  			'id' => '',
  			'default' => '',
  			'type' => 'separator',
  		),

      array(
  			'label' => __('Photo height', 'narratium'),
        'description' => __('Defines a default height for the image height size.', 'narratium'),
  			'id' => 'photo_height',
  			'default' => 'min-height-400px',
  			'type' => 'select',
        'choices' => array(
          'min-height-100px' => __('100px min', 'narratium'),
          'min-height-200px' => __('200px min', 'narratium'),
          'min-height-300px' => __('300px min', 'narratium'),
          'min-height-400px' => __('400px min', 'narratium'),
          'min-height-500px' => __('500px min', 'narratium'),
          'min-height-600px' => __('600px min', 'narratium'),
          'min-height-700px' => __('700px min', 'narratium'),
        )
  		),


      array(
  			'label' => '',
        'description' => '<hr>',
  			'id' => '',
  			'default' => '',
  			'type' => 'separator',
  		),

      array(
  			'label' => __('Filter by category', 'narratium'),
  			'id' => 'category',
  			'default' => '',
  			'type' => 'select',
        'choices' => array_merge(array('' => __('Select category', 'narratium') ) , wp_list_pluck(get_categories(), 'name', 'slug'))
  		),

      array(
  			'label' => __('Order criteria', 'narratium'),
  			'id' => 'orderby',
  			'default' => 'date',
  			'type' => 'select',
        'choices' => array(
          'date' => __('Latest', 'narratium'),
          'rand' => __('Random', 'narratium'),
          'comment_count' => __('Most commented', 'narratium'),
        )
  		),

  	);
  }


  /**
  * This is the display of the widgent in the page
  */
  public function widget_return( $instance ) {


    /**
    * Posts Args
    */
    $args = array(
    	'posts_per_page'   => 1,
    	'offset'           => 0,
    	'category_name'    => isset($instance['category']) ? $instance['category'] : '',
    	'orderby'          => isset($instance['orderby']) ? $instance['orderby'] : 'date', // date / rand / comment count
    	'include'          => isset($instance['include']) ? $instance['include'] : '',
    	'post_type'        => 'post',
    	'post_status'      => 'publish',
    );

    /**
    * Make the query to get the posts
    */
    $posts_array = get_posts( $args );

    /**
    * We get just the first
    */
    $post = KTT_get_post(reset($posts_array));

    /**
    * We are going to form the array of arguments that we will pass to the function that is really responsible for showing the div
    */
    $cover_args = array(
          "card_id" => 'id-' . $this->id,
          "wrap_classes" => "border-radius-5 box-shadow-small site-palette-yang-1-background-color overflow-hidden",
          "card_classes" => "link-white-color site-palette-yang-1-color",

          /**
          * We get the image data header
          */
          "card_background_attachment" => get_post_thumbnail_id($post->ID),

          /**
          * We call the function that is responsible for creating the content of the site header, we only pass the name of the project because this parameter acts as a callback
          */
          "card_content" => array( "KTT_widget_featured_post_content", $post),

          /**
          * We align it as we want.
          */
          "card_align" => "end center",

          "card_video" => false,
    );

    /**
    * We add the class that defines the photo height
    */
    $photo_height = "min-height-400px";
    if (isset($instance['photo_height'])) $photo_height = $instance['photo_height'];
    $cover_args['card_classes'] .= ' ' . $photo_height;

    /**
    * We execute the function that is really responsible for showing the header
    */
    KTT_display_image_card($cover_args);


  }


} // class Featuredpost_Widget





// register Featured Post widget
function KTT_register_ktt_featured_post_widget() {
	register_widget( 'KTT_featured_post_widget' );
}
add_action( 'widgets_init', 'KTT_register_ktt_featured_post_widget' );
