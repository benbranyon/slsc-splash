<?php
/**
* We edit the comment form to adapt it to the style of the site
*/


/**
* This function uses the filter comment_form_fields to modify the fields
* of the comment form and adapt it to our style
*/
function KTT_custom_comments_field_comment_textarea($fields) {

      /**
      * Name fields
      */
      $fields['author'] = '<span class="display-block">' . $fields['author'] . '</span>';

      /**
      * email fields
      */
      $fields['email'] = '<span class="display-block">' . $fields['email'] . '</span>';

      /**
      * URL field
      */
      $fields['url'] = '<span class="display-block">' . $fields['url'] . '</span>';

      /**
      * Comment textarea
      */
      $fields['comment'] = '<p class="comment-form-comment"><textarea class="site-palette-yin-2-color site-palette-yang-1-background-color border-radius-3 display-block width-100 padding-both-20" placeholder="' . esc_html__('Leave your comment here...', 'narratium') . '" id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>';

      /**
      * We return the list of fields
      */
      return $fields;

}
add_filter('comment_form_fields', 'KTT_custom_comments_field_comment_textarea');





// define the comment_form_submit_button callback
function filter_comment_form_submit_button( $submit_button, $args ) {

      /**
      * We edit the submit button
      */
      $submit_button = '<span class="float-right display-block"><md-button class="md-warn"> ' . esc_html__('Cancel', 'narratium') . '</md-button> ';
      $submit_button .= '<md-button name="' . $args['name_submit'] . '" type="submit" id="' . $args['id_submit'] . '"  class="site-palette-yin-1-background-color site-palette-yang-2-color icon-paper-plane md-raised md-primary ' . esc_attr($args['class_submit']) . '"> ' . esc_attr($args['label_submit']) . '</md-button> </span>';
      $submit_button .= '<p class="overflow-auto padding-bottom-10 clear-both">'; // it's weird, but ¿WordPress? close an imaginary p o.O.

      /**
      * We return the edited button
      */
      return $submit_button;

};

// add the filter
add_filter( 'comment_form_submit_button', 'filter_comment_form_submit_button', 10, 2 );













/**
* Modify the avatar class of the get_Avatar function to add
*  the classes that we want
*/
function KTT_add_class_to_avatar($class) {
    $class = str_replace("class='avatar", "class='avatar border-radius-100", $class);
    return $class;
}
add_filter('get_avatar','KTT_add_class_to_avatar');

 ?>
