<?php



function KTT_fix_img_caption_shortcode($out, $pairs, $atts, $shortcode) {
    $out['class'] = 'site-typeface-body typo-size-xsmall';
    return $out;
}
add_filter('shortcode_atts_caption', 'KTT_fix_img_caption_shortcode', 5, 4);

 ?>
