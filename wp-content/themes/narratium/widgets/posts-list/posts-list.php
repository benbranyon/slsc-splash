<?php

/**
* Adds Featured Post widget
*/
class KTT_posts_list_widget extends KTT_widget_creator {

	/**
	* Register widget with WordPress
	*/
	function __construct() {
		parent::__construct(
			'ktt_posts_list_widget', // Base ID
			wp_get_theme()->get('Name') . ' - ' . esc_html__( 'Posts list', 'narratium' ), // Name
			array( 'description' => esc_html__( 'Display a list of posts.', 'narratium' ), ) // Args
		);
    add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
	}



  public function form_head($instance) {
    ?>
    <p><small>
      <?php _e('This widget display a list of posts.', 'narratium');?>
    </small>
    </p><hr>
    <?php
  }




  public function get_widget_fields() {

    return array(
      array(
  			'label' => __('Number of posts', 'narratium'),
        'description' => __('Insert the number of posts to be displayed.', 'narratium'),
  			'id' => 'posts_per_page',
  			'default' => 4,
  			'type' => 'number',
  		),

      array(
  			'label' => __('Filter by category', 'narratium'),
        'description' => __('Display only posts associated with the selected category.', 'narratium'),
  			'id' => 'category',
  			'default' => '',
  			'type' => 'select',
        'choices' => array_merge(array('' => __('All', 'narratium') ) , wp_list_pluck(get_categories(), 'name', 'slug'))
  		),

      array(
  			'label' => __('Order by', 'narratium'),
        'description' => __('Sort retrieved posts by parameter.', 'narratium'),
  			'id' => 'orderby',
  			'default' => 'date',
  			'type' => 'select',
        'choices' => array(
          'title' => __('Order by title', 'narratium'),
          'date' => __('Order by date', 'narratium'),
          'rand' => __('Random order', 'narratium'),
          'comment_count' => __('Order by number of comments', 'narratium'),
          'menu_order' => __('Order by Page Order', 'narratium')
        )
  		),

      array(
  			'label' => __('Order direction', 'narratium'),
        'description' => __('Designates the ascending or descending order of the posts', 'narratium'),
  			'id' => 'order',
  			'default' => 'DESC',
  			'type' => 'select',
        'choices' => array(
          'ASC' => __('Ascending order from lowest to highest', 'narratium'),
          'DESC' => __('Descending order from highest to lowest', 'narratium'),
        )
  		),


      array(
  			'label' => '',
        'description' => '<hr>' . __('In the following section you can select what meta information you want to display.', 'narratium'),
  			'id' => '',
  			'default' => '',
  			'type' => 'separator',
  		),


      array(
  			'label' => __('Display Image', 'narratium'),
        'description' => __('Check to display the featured image of the posts.', 'narratium'),
  			'id' => 'display_post_image',
  			'default' => false,
  			'type' => 'checkbox'
  		),

      array(
  			'label' => __('Display post author', 'narratium'),
        'description' => __('Check to display the post author.', 'narratium'),
  			'id' => 'display_post_author',
  			'default' => false,
  			'type' => 'checkbox'
  		),

      array(
  			'label' => __('Display post date', 'narratium'),
        'description' => __('Check to display the post date.', 'narratium'),
  			'id' => 'display_post_date',
  			'default' => false,
  			'type' => 'checkbox'
  		),

      array(
  			'label' => __('Display post comments count', 'narratium'),
        'description' => __('Check to display the comment count of the posts.', 'narratium'),
  			'id' => 'display_post_comment_count',
  			'default' => false,
  			'type' => 'checkbox'
  		),

      array(
  			'label' => '',
        'description' => '<hr>' . __('Advanced options', 'narratium'),
  			'id' => '',
  			'default' => '',
  			'type' => 'separator',
  		),

      array(
  			'label' => __('Offset', 'narratium'),
        'description' => __('Number of post to displace or pass over.', 'narratium'),
  			'id' => 'offset',
  			'default' => 0,
  			'type' => 'number'
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
    	'posts_per_page'   => isset($instance['posts_per_page']) ? $instance['posts_per_page'] : 4,
    	'offset'           => isset($instance['offset']) ? $instance['offset'] : 0,
    	'category_name'    => isset($instance['category']) ? $instance['category'] : '',
    	'orderby'          => isset($instance['orderby']) ? $instance['orderby'] : 'date', // date / rand / comment count
      'order'            => isset($instance['order']) ? $instance['order'] : 'DESC', // date / rand / comment count
      'include'          => isset($instance['include']) ? $instance['include'] : '',
    	'post_type'        => 'post',
			'ignore_sticky_posts' => true,
    	'post_status'      => 'publish',
    );

    /**
    * Make the query to get the posts
    */
    $posts = get_posts( $args );

    /**
    * We fetch the last element of the array
    */
    $last_post = end($posts);

    /**
    * Let's itinerate for every post of the array
    */
    if ($posts) foreach ($posts as $post) {

      ?>
        <div data-layout="row" >

          <?php if (isset($instance['display_post_image']) && $instance['display_post_image']) { ?>
          <div data-flex="30" class="padding-right-20">
            <?php
            $thumb = get_post_thumbnail_id($post->ID);
            ?>
              <a
							class="display-block height-100 position-relative classic-link button-behaviour margin-bottom-10 display-block site-palette-special-1-color"
							title="<?php echo get_the_title($post->ID);?>"
							href="<?php echo esc_url(get_permalink($post->ID));?>">
                <div
                class="height-100 position-relative background-position-center-center display-block border-radius-4 margin-bottom-20 site-palette-yang-3-background-color overflow-hidden"
                style="min-height:50px;background-image:url('<?php echo KTT_scaled_image_url(get_post_thumbnail_id($post->ID), 'large');?>');background-size:cover;background-repeat:no-repeat;background-position:center;"></div>
              </a>

          </div>
          <?php } ?>


          <div data-flex >
            <a
            href="<?php echo esc_url(get_permalink($post->ID));?>"
            title="<?php echo esc_attr(get_the_title($post->ID));?>"
            class="classic-link display-block text-size-small font-weight-700"><?php echo get_the_title($post->ID);?></a>

            <div data-flex class=" item-meta site-palette-yin-4-color post-item-meta classic-link-inside text-size-2xsmall padding-top-5">

                <?php if (isset($instance['display_post_author']) && $instance['display_post_author']) { ?>
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
                <span class="meta ornament-line-before-amper">
                    <?php echo esc_html__('By', 'narratium');?>
                    <?php foreach($authors as $author) {?>
                      <strong class="by-user"><a href="<?php echo get_author_posts_url($author->ID);?>"><?php echo esc_html($author->display_name);?></a></strong>
                    <?php } ?>
                </span>
                <?php } ?>
                <?php } ?>

                <?php if (isset($instance['display_post_date']) && $instance['display_post_date']) { ?>
                <span class="meta ornament-line-before-amper">

                      <?php echo get_the_date(get_option("date_format"), $post->ID);?>

                </span>
                <?php } ?>

                <?php if (isset($instance['display_post_comment_count']) && $instance['display_post_comment_count']) { ?>
                <span class="meta ornament-line-before-amper">
                  <span class="disqus-comment-count"> <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'narratium'), number_format_i18n( get_comments_number() ) );?></span>
                </span>
                <?php } ?>

            </div>


          </div>
        </div>

        <?php
        /**
        * This little trick adds a spacing between posts until the last post
        * is reached
        */
        if ($last_post != $post) {?>
          <div class="margin-bottom-20"></div>
        <?php } ?>

      <?php
    }




  }


} // class Featuredpost_Widget





// register Featured Post widget
function KTT_register_ktt_posts_list_widget() {
	register_widget( 'KTT_posts_list_widget' );
}
add_action( 'widgets_init', 'KTT_register_ktt_posts_list_widget' );
