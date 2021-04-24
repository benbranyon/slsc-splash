<?php
/**
* We capture the filter of the color templates and we take care of adding the default templates for this theme
*/
function KTT_default_theme_color_schemes($schemes) {

    $schemes['base_light'] = array(
      'id' => 'base_light',
      'name' => 'Base Light',
      'description' => 'White and simple colors',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#27262B',
            'site_palette_yin_2' => '#474748',
            'site_palette_yin_3' => '#6C606F',
            'site_palette_yin_4' => '#99939F',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#4A3Ddd',
            'site_palette_special_2' => '#ab5d6a',
          ),

          'yang' => array(
            'site_palette_yang_1' => '#F6F9FC',
            'site_palette_yang_2' => '#F0F3F5',
            'site_palette_yang_3' => '#e2e8e9',
            'site_palette_yang_4' => '#d2d8d9',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#efe8e9',
            'site_palette_special_2' => '#dfd8d9',
          )

      )
    );

    /**
    * Templates
    */
    $schemes['sand'] = array(
      'id' => 'sand',
      'name' => 'Sand',
      'description' => 'Light theme with browns ',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#4F3939',
            'site_palette_yin_2' => '#694C4C',
            'site_palette_yin_3' => '#916D6E',
            'site_palette_yin_4' => '#b18D8E',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#ab5d6a',
            'site_palette_special_2' => '#4A3Ddd',
          ),

          'yang' => array(
            'site_palette_yang_1' => '#FCFAF5',
            'site_palette_yang_2' => '#F8F4E9',
            'site_palette_yang_3' => '#F6F0E1',
            'site_palette_yang_4' => '#F3EAD6',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#dfd8d9',
            'site_palette_special_2' => '#efe8e9',
          )

      )
    );


    /**
    *  Default Inverse template
    */
    $schemes['light_blue'] = array(
      'id' => 'light_blue',
      'name' => 'Light Blue',
      'description' => 'Blue tones',
      'colors' => array(

          'yin' => array(

            'site_palette_yin_1' => '#242457',
            'site_palette_yin_2' => '#444477',
            'site_palette_yin_3' => '#666699',
            'site_palette_yin_4' => '#7356B6',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#1D1D5C',
            'site_palette_special_2' => '#24B47E',
          ),


          'yang' => array(
            'site_palette_yang_1' => '#E4ECF3',
            'site_palette_yang_2' => '#E4ECF1',
            'site_palette_yang_3' => '#CCDDEE',
            'site_palette_yang_4' => '#73A0CA',

          ),

          'yang_special' => array(
            'site_palette_special_1' => '#3ECF8E',
            'site_palette_special_2' => '#FFC300',
          ),




      )
    );




    /**
    * blue night
    */
    $schemes['blue_night'] = array(
      'id' => 'blue_night',
      'name' => 'Blue Night',
      'description' => 'Dark scheme with blue tones',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#d1d3eC',
            'site_palette_yin_2' => '#D8DFE8',
            'site_palette_yin_3' => '#81839C',
            'site_palette_yin_4' => '#61637C',

          ),

          'yin_special' => array(
            'site_palette_special_1' => '#B66DC2',
            'site_palette_special_2' => '#FFC300',
          ),

          'yang' => array(

            'site_palette_yang_1' => '#27314D',
            'site_palette_yang_2' => '#474D70',
            'site_palette_yang_3' => '#3A3D54',
            'site_palette_yang_4' => '#7A7Da4',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#1D1D5C',
            'site_palette_special_2' => '#24B47E',
          ),


      )
    );



    /**
    *  Violet Scheme
    */
    $schemes['violet'] = array(
      'id' => 'violet',
      'name' => 'Violet',
      'description' => 'Light purple tones',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#2B343C',
            'site_palette_yin_2' => '#282F36',
            'site_palette_yin_3' => '#888F96',
            'site_palette_yin_4' => '#95A5A6',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#1D1D5C',
            'site_palette_special_2' => '#24B47E',
          ),


          'yang' => array(
            'site_palette_yang_1' => '#F9FBFF',
            'site_palette_yang_2' => '#EFF1F6',
            'site_palette_yang_3' => '#EAECF1',
            'site_palette_yang_4' => '#cFd1d5',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#cEdFfE',
            'site_palette_special_2' => '#FFC300',
          ),

      )
    );



    /**
    * blue night
    */
    $schemes['radar'] = array(
      'id' => 'radar',
      'name' => 'Radar',
      'description' => 'Dark tones',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#ffffff',
            'site_palette_yin_2' => '#fafafa',
            'site_palette_yin_3' => '#F0F0F0',
            'site_palette_yin_4' => '#D8D8D8',

          ),

          'yin_special' => array(
            'site_palette_special_1' => '#3DD184',
            'site_palette_special_2' => '#9B7234',
          ),

          'yang' => array(

            'site_palette_yang_1' => '#262626',
            'site_palette_yang_2' => '#303030',
            'site_palette_yang_3' => '#404040',
            'site_palette_yang_4' => '#4a4a4a',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#1D1D5C',
            'site_palette_special_2' => '#24B47E',
          ),


      )
    );



    /**
    * Finally, we return the modified array
    */
    return $schemes;


}
add_filter('KTT_THEME_color_schemes', 'KTT_default_theme_color_schemes', 1, 1);
