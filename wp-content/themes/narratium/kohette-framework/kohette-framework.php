<?php
/*
Name: Kohette WDT Framework
URI: https://github.com/Kohette/Kohette-WordPress-Dev-Tools/
Description: Load the theme configuration and custom functions & features.
Author: Rafael Martín
Author URI: http://kohette.com/
Version: 1.7.1
*/



/**
* We define the global one that will have an array with all the general options of the site related to the themes
* @package Kohette Framework
*/
global $KTT_theme_options;

/**
* this global contain the info of all theme features registered
*/
global $KTT_plugins;


/**
* Class that manages the Framework.
*
* This class initializes all the processes required to implement kohette in the theme.
*
* @package Kohette Framework
*
* @param array $theme_config Array containing the initial variables for the framework such as textdomain, etc.
*/
class kohette_framework {

    private $theme_config;

    /**
    * Class constructor
    */
    public function __construct($theme_config = '') {

            $this->set_fw_constants();
            $this->set_theme_config($theme_config);
            $this->load_framework_functions(); // load custom functions

            $this->set_theme_options_global();
          	$this->load_framework_modules(); // load framework handy classes
            $this->load_framework_hooks(); // load custom functions
            $this->create_theme_options_page();
            $this->load_plugins();
            $this->create_plugins_manager_page();

    }

    /**
    * Class contructor
    */
    public function kohette_framework($theme_config) {
            self::__construct();
    }

    /**
    * This function is responsible for saving a global array of general options related to the theme.
    *
    * @global array $KTT_theme_options Array which contains the initial class information.
    * @global object $wpdb.
    */
    private function set_theme_options_global() {

          /**
          * We invoke the variable wpdb
          */
          global $wpdb, $KTT_theme_options;

          /**
          * In result we are going to form the Final array
          */
          $result = new stdClass();;

          /**
          * We execute a query that will delete all the saved theme options
          */
          $options = $wpdb->get_results( "SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE '" . KTT_var_name() . "%%'" );

          /**
          * If we have not found options, we leave here
          */
          if (!$options) return;

          /**
          * We route for each result and we add it to the result
          */
          foreach ($options as $key => $value) if ($key) $result->{KTT_remove_prefix($value->option_name)} = maybe_unserialize($value->option_value);

          /**
          * We keep in the global
          */
          $KTT_theme_options = $result;

    }




    /**
    * set the default constants of the framework
    */
    private function set_fw_constants() {

        /**
        * this defines the path of the resources of the framework
        */
        define("KTT_FW_RESOURCES", get_parent_theme_file_path('kohette-framework/resources/'));

    }




    /**
    * set the basic configuration of the theme
    */
    private function set_theme_config($theme_config = '') {

        /**
        * We add the default theme config
        */
        $theme_config = wp_parse_args($theme_config, $this->load_theme_data_constants());

        /**
        * Before creating the framework instance with the configuration array we apply a filter to add information to the configuration that could be added by other functions. This is useful for each theme to add its own configuration of the framework.
        */
        $theme_config = apply_filters( 'KTT_theme_config', $theme_config );

        /**
        * If we do not have constants we leave here
        */
        if (!$theme_config) return;


        $this->theme_config = $theme_config;


        /**
        * We create the defined constants for the theme
        */
        if (isset($theme_config['constants'])) {
        foreach($theme_config['constants'] as $item => $value) {

            $this->$item = $theme_config['constants'][$item];
            define("THEME_" . strtoupper($item) , $this->$item);

        }
        }

    }



    /**
    * load framework custom functions
    */
    private function load_framework_functions() {
		include('functions/basic-functions.php');
    }



    /**
    * load framework handy classes
    */
    private function load_framework_modules() {

    	foreach (glob( get_parent_theme_file_path("kohette-framework/modules/*"), GLOB_ONLYDIR) as $filename) {
        	include('modules/' . basename($filename) . '/' . basename($filename) . '.php') ;
		  };

    }


    /**
    * load framework hooks to improve WordPress
    */
    private function load_framework_hooks() {

        foreach (glob(get_parent_theme_file_path("kohette-framework/hooks/*"), GLOB_ONLYDIR) as $filename) {
            include('hooks/' . basename($filename) . '/' . basename($filename) . '.php') ;
        };

    }


    /**
    * create the theme options admin page/menu
    */
    public function create_theme_options_page() {

        $args = array();
        $args['id']             = 'theme-options';
        $args['page_title']     = 'Theme Options';
        $args['menu_title']     = 'Theme options';
        $args['page']           = ''; //array( &$this, 'default_theme_options_page');

        $new_admin_page = new KTT_admin_menu($args);

    }

    function default_theme_options_page() {
        global $submenu;

    }


    public function create_plugins_manager_page() {

      $args = array();
      $args['id'] = KTT_var_name('plugins-manager');
      $args['page_title'] = 'Theme features';
      $args['page_description'] = esc_html__('Manage the theme features to be enabled in your site.', 'narratium');
      $args['menu_title'] = 'Theme Features';
      $args['menu_order'] = 3;
      $args['page'] = 'KTT_render_plugins_manager';
      $args['parent'] = 'options-general.php';

      $new_admin_submenu = new KTT_admin_submenu($args);

      function KTT_render_plugins_manager(){

          global $KTT_plugins;
          $alert_message = '';

          $table = new PluginsManagerTable();

          $option = 'per_page';
          $args = array(
                 'label' => 'Features',
                 'default' => 10,
                 'option' => 'features_per_page'
                 );
          add_screen_option( $option, $args );

          /**
          * Enable or disable
          */
          if (
            isset($_REQUEST['action'])
            && ($_REQUEST['action'] == 'enable' || $_REQUEST['action'] == 'disable')
            && isset($_REQUEST['feature'])) {

              $KTT_plugins[$_REQUEST['feature']]['Status'] = ($_REQUEST['action'] == 'disable') ? 'Disabled' : 'Enabled';
              update_option(KTT_theme_var_name('registered_theme_features'), $KTT_plugins);
              $alert_message = sprintf(__('The feature has been edited successfully.', 'narratium'));
          }

          $table->example_data = $KTT_plugins;

          if ($alert_message) {?>
          <div class="updated">
              <p>
                  <?php echo wp_kses( $alert_message, wp_kses_allowed_html('post'));?>
              </p>
          </div>
          <?php } ?>

          <div class="wrap">
            <h2><?php _e('Theme Features', 'narratium')?></h2>
            <?php _e('Manage some of the special features of the theme.','narratium');?>
            <?php
            $table->prepare_items();
            ?>
              <form method="post">
              <input type="hidden" name="page" value="ttest_list_table">
              <?php $table->display();?>
              </form>
          </div>
          <?php
      }






    }



    /**
    * Start trigger
    */
    function start_kohette_framework() {

        global $pagenow;
        if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

            set_default_options();

        }
    }



    /**
    * include the plugin file in the theme
    */
    private function run_activate_plugin( $plugin_source ) {
	    include($plugin_source);
	  }



    /**
    * load the list of plugins
    */
    function load_plugins($plugins = array()) {

      	require_once(ABSPATH . 'wp-admin/includes/plugin.php');

        /**
        * Before finally loading the array of plugins, we apply a filter to check if other functions of the theme want to add files to include. This is useful for each theme to add its files (post_types, scripts, etc)
        */
        $plugins = apply_filters( 'KTT_theme_plugins', $plugins);

        /**
        * If there are no plugins we leave here
        */
        if (!$plugins) return;

        /**
        * Obtain our registered theme features
        */
        $features_saved = KTT_get_theme_option('registered_theme_features');
        if (!$features_saved) $featured_saved = array();

        /**
        * Iterate for every source plugin and create an object with the information
        */
      	foreach ($plugins as $plugin => $plugin_config) {

        		//$plugin_data = get_plugin_data($plugin_config['source']);

            $default_headers = array(
              'ID' => 'ID',
              'Name' => 'Feature Name',
              'URI' => 'Feature URI',
              'Category' => 'Category',
              'Version' => 'Version',
              'Description' => 'Description',
              'Display' => 'Display', // Visible, Hidden
              'UpdateMode' => 'Update Mode',
              'Status' => 'Status', // Enabled, Disabled
            );

            $plugin_data = get_file_data( $plugin_config['source'], $default_headers, 'theme-plugin' );

            /**
            * Add the path to the array
            */
            $plugin_data['Path'] = $plugin_config['source'];

            /**
            * We add a filter to edit the configuraiton of the feature
            */
            $plugin_data = apply_filters( 'KTT_theme_plugin_data', $plugin_data);

            /**
            * We add the plugin to the globals
            */
            global $KTT_plugins;
            if ($plugin_data['ID']) $KTT_plugins[$plugin_data['ID']] = $plugin_data;


            if (isset($features_saved[$plugin_data['ID']])) $plugin_data = $features_saved[$plugin_data['ID']];

            /**
            * If not is marked as disabled then load it
            */
            if (strtolower($plugin_data['Status']) != 'disabled') $this->run_activate_plugin($plugin_config['source']);


      	}

        $KTT_plugins = wp_parse_args( $features_saved, $KTT_plugins );


    }



    /**
    * load theme data through style.css
    */
    function load_theme_data_constants() {

        /**
        * We will return this array with the theme information
        */
        $result = array();

        /**
        * We get the theme data
        */
        $theme_data = wp_get_theme();

        /**
        * Create the array data
        */
        $result['constants']['textdomain'] = $theme_data->get("TextDomain");
        $result['constants']['prefix'] = $result['constants']['textdomain'] . '_';

        /**
        * this define a constant for every folder of the theme directory
        * if the folder is named "the libs" the constant with the path will  defined as THEME_THE_LIBS_PATH
        */
        foreach (glob(get_stylesheet_directory() . "/*", GLOB_ONLYDIR) as $f) {

            $name = basename($f);
            $name = str_replace(' ', '_', $name);
            $name = str_replace('-', '_', $name);

            $result['constants'][strtoupper($name) . '_PATH'] = $f;

        };

        /**
        * We return the Array
        */
        return $result;


    }




}
