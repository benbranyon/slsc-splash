<?php
/**
 * Settings creator module.
 *
 * Classes to add custom options in the admin settings pages
 * https://core.trac.wordpress.org/browser/tags/4.7/src/wp-includes/class-wp-customize-control.php#L15
 */



function KTT_register_wp_customize_control_extended($wp_customizer) {
    /**
    * We will use this class to connect with our custom controls
    */
    class KTT_Customize_Control_Extended extends WP_Customize_Control {

          public $option_id;
          public $option_name;
          public $option_label;
          public $option_description;
          public $option_type;
          public $option_priority;
          public $option_type_vars;
          public $option_section;
          public $option_default;


          public function print_parent_render() {
              parent::render_content();
          }

          /**
          * This function is responsible for showing the html of the control if we do not find a personalized control we pass to the base class
          */
          public function render_content() {


              ?>
                 <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                 <span class="description customize-control-description"><?php echo wp_kses($this->description, wp_kses_allowed_html('post')); ?></span>
              <?php


              /**
              * We include the script path where you will find the options of the custom option
              */
              do_action('KTT_settings_option_field', $this, $this->value($this->id));

              ?>
              <hr style="margin-top:19px">
              <?php


          }
    }
}
add_action( 'customize_register', 'KTT_register_wp_customize_control_extended', 1 );



/**
* Panels
*/
class KTT_new_customize_panel {

    private $panel_id;
    private $panel_title;
    private $panel_description;
    private $panel_priority;
    private $panel_capability;
    private $panel_theme_supports;

    /**
    * Constructor
    */
    function __construct($args) {

        if (isset($args['panel_id']))                 $this->panel_id                 = $args['panel_id'];
        if (isset($args['panel_title']))              $this->panel_title              = $args['panel_title'];
        if (isset($args['panel_description']))        $this->panel_description        = $args['panel_description'];
        if (isset($args['panel_priority']))           $this->panel_priority           = $args['panel_priority'];
        if (isset($args['panel_capability']))         $this->panel_capability         = $args['panel_capability'];
        if (isset($args['panel_theme_supports']))     $this->panel_theme_supports     = $args['panel_theme_supports'];

        add_action( 'customize_register', array( &$this , 'add_customize_panel' ), 1 );


    }

    public function KTT_new_panel($args) {$self.__construct($args);}


    function add_customize_panel($wp_customize) {
        $wp_customize->add_panel( $this->panel_id, array(
            'priority'       => $this->panel_priority,
            'capability'     => $this->panel_capability,
            'theme_supports' => $this->panel_theme_supports,
            'title'          => $this->panel_title,
            'description'    => $this->panel_description,
        ) );
    }

}




/**
* Panels
*/
class KTT_new_customize_section {

    private $section_id;
    private $section_title;
    private $section_description;
    private $section_priority;
    private $section_capability;
    private $section_theme_supports;
    private $section_panel;

    /**
    * Constructor
    */
    function __construct($args) {

        if (isset($args['section_id']))                 $this->section_id                 = $args['section_id'];
        if (isset($args['section_title']))              $this->section_title              = $args['section_title'];
        if (isset($args['section_description']))        $this->section_description        = $args['section_description'];
        if (isset($args['section_priority']))           $this->section_priority           = $args['section_priority'];
        if (isset($args['section_capability']))         $this->section_capability         = $args['section_capability'];
        if (isset($args['section_theme_supports']))     $this->section_theme_supports     = $args['section_theme_supports'];
        if (isset($args['section_panel']))              $this->section_panel              = $args['section_panel'];

        /**
        * register all
        */
        add_action( 'customize_register', array( &$this , 'add_customize_section' ), 1 );

    }

    public function KTT_new_section($args) {$self.__construct($args);}

    function add_customize_section($wp_customize) {
        $wp_customize->add_section( $this->section_id, array(
            'priority'        => $this->section_priority,
            'capability'      => $this->section_capability,
            'theme_supports'  => $this->section_theme_supports,
            'title'           => $this->section_title,
            'description'     => $this->section_description,
            'panel'           => $this->section_panel,
        ) );
    }





}







// add options to admin pages
class KTT_new_customize_setting {

        public $option_id;
        public $option_name;
        public $option_label;
        public $option_description;
        public $option_type;
        public $option_priority;
        public $option_type_vars;
        public $option_section;
        public $option_default;
        public $option_settings;
        public $input_attrs;

        /**
        * Constructor
        */
        function __construct($args) {

            if (isset($args['option_id']))              $this->option_id            = $args['option_id'];
            if (isset($args['option_name']))            $this->option_name          = $args['option_name'];
            if (isset($args['option_label']))           $this->option_label         = $args['option_label'];
            if (isset($args['option_description']))     $this->option_description   = $args['option_description'];
            if (isset($args['option_type']))            $this->option_type          = $args['option_type'];
            if (isset($args['option_priority']))        $this->option_priority      = $args['option_priority'];
            if (isset($args['option_type_vars']))       $this->option_type_vars     = $args['option_type_vars'];
            if (isset($args['option_section']))         $this->option_section       = $args['option_section'];
            if (isset($args['option_default']))         $this->option_default       = $args['option_default'];
            if (isset($args['option_settings']))        $this->option_settings      = $args['option_settings'];
            if (isset($args['input_attrs']))            $this->input_attrs          = $args['input_attrs'];

            /**
            * Before calling the customize register we correct the attributes of the class if necessary
            */
            $this->fix_attributes();

            /**
            * We register the default value of the option, this is useful to start the theme with the correct options
            */
            add_filter('KTT_starter_content_data', array(&$this, 'register_setting_default_value'), 5, 1);

            /**
            * the register
            */
            add_action( 'customize_register', array( &$this , 'add_customize_control' ), 5 );


        }

        public function KTT_new_setting( $args ) {$self.__construct($args);}



        /**
        * This function is responsible for registering the defaults
        */
        function register_setting_default_value($defaults) {

            /**
            * We register the default value of this option in the starter-content array
            */
            $defaults['options'][$this->option_id] = $this->option_default;

            /**
            * We return the modified array
            */
            return $defaults;

        }

        function KTT_common_add_setting_sanitize_callback($value) {
          return $value;
        }

        /**
        * This function is responsible for adding the option on the customize page if necessary
        */
        function add_customize_control($wp_customize) {

              /**
              * If you have not defined some settings we put the control id
              */
              if (!$this->option_settings) $this->option_settings = $this->option_id;

              /**
              * If the settings is not an array we transform it into one to make it easier to manage
              */
              if (!is_array($this->option_settings)) {
                  $cucu = $this->option_settings;
                  $this->option_settings = array();
                  $this->option_settings[$cucu] = $cucu;
              }

              /**
              * We walk through each setting and register it
              */
              foreach ($this->option_settings as $setting_key => $setting_value) {

                  $wp_customize->add_setting(
                    $setting_value,

                    array(
                          'default' => (is_array($this->option_default) ? (isset($this->option_default[$setting_key]) ? $this->option_default[$setting_key] : '') : $this->option_default),
                          'type' => 'option',
                          'sanitize_callback' => array(&$this, 'KTT_common_add_setting_sanitize_callback'),
                    )
                  );

              }


              $wp_customize->add_control( new KTT_Customize_Control_Extended(
                $wp_customize,
                $this->option_id,
                array(
                  'option_id' => $this->option_id,
                  'label' => $this->option_name, //Yes, its correct
                  'description' => $this->option_description,
                  'section' => $this->option_section,
                  'type' => $this->option_type,
                  'option_type' => $this->option_type,
                  'settings' => $this->option_settings,
                  'priority' => $this->option_priority,
                  'option_type_vars' => $this->option_type_vars,
                  ) )
              );




        }



        /**
        *^This function is responsible for fixing the attributes of the class if it is necessary, some contoladores as the "font" needs certain modifications
        */
        public function fix_attributes() {


            /**
            * If the option has a typevars with an array then we will form this rare thing
            */
            if ($this->option_type == 'checkboxes') {
            if ($this->option_type_vars && is_array($this->option_type_vars)){

              $this->option_settings['option_id']     = $this->option_id;
              foreach ($this->option_type_vars as $id => $value) if (!is_array($value)) $this->option_settings[$id] = $this->option_id . '[' . $id . ']';

            }
            }




            if ($this->option_type == 'font') {

                $this->option_settings['option_id']           = $this->option_id;
                $this->option_settings['font_family']         = $this->option_id . '[font_family]';
                $this->option_settings['font_size']           = $this->option_id . '[font_size]';
                $this->option_settings['font_size_unit']      = $this->option_id . '[size_unit]';
                $this->option_settings['font_weight']         = $this->option_id . '[font_weight]';
                $this->option_settings['line_height']         = $this->option_id . '[line_height]';
                $this->option_settings['selector']            = $this->option_id . '[selector]';
                $this->option_settings['load_all_weights']    = $this->option_id . '[load_all_weights]';

                // Fix special
                $this->option_default['selector'] = $this->option_type_vars['selector'];

                // if is a font field the save process is different
                add_filter( 'KTT_theme_css_options', function($options){
                    $options[] = $this->option_id;
                    return $options;
                });

            }




            /**
            * For a CSS option we also have to make a small fix
            */
            if ($this->option_type == 'css_select') {

                $this->option_settings['option_id']       = $this->option_id;
                $this->option_settings['selector']        = $this->option_type_vars['selector'];
                $this->option_settings['property']        = $this->option_type_vars['property'];
                $this->option_settings['value']           = $this->option_id . '[value]';

                $this->option_default['selector'] = $this->option_type_vars['selector'];
                $this->option_default['property'] = $this->option_type_vars['property'];

                add_filter( 'KTT_theme_css_options', function($options){
                    $options[] = $this->option_id;
                    return $options;
                });

            }

        }
}
