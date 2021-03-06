<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://twitter.com/jolopez_
 * @since      1.0.0
 *
 * @package    Interbanco
 * @subpackage Interbanco/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Interbanco
 * @subpackage Interbanco/admin
 * @author     Jonatan Lopez <jonatan.fernando@gmail.com>
 */
class Interbanco_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Interbanco_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Interbanco_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/interbanco-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Interbanco_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Interbanco_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/interbanco-admin.js', array('jquery'), $this->version, false);

    }


    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_options_page('InterBanco Web Settings', 'WIB Interbanco', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')


        /*
        The page title: Here ‘WP Cleanup and Base Options Functions Setup’.
        The menu title: Here ‘WP Cleanup’ as you might want to keep it small to span on just one line.
        Capabilities: Who will be able to access this menu item (Admin, Editor, etc..).
        The menu slug: Here as for mostly everything we will reference in this plugin we will use the plugin short name (we will access it with $this->plugin_name).
        The callback function: If you look closely here, we are calling our 3rd function display_plugin_setup_page(). This is where our options will be displayed.

        */
        );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links($links)
    {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page()
    {
        include_once('partials/interbanco-admin-display.php');
    }


    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

    /*
     * validate and sanitize those options
     */
    public function validate($input) {
        // All checkboxes inputs
        $valid = array();

        //General



        $valid['title'] = (isset($input['title']) && !empty($input['title'])) ? sanitize_text_field($input['title']) : '';

        //Apariencia
        $valid['classname'] = (isset($input['classname']) && !empty($input['classname'])) ? sanitize_text_field($input['classname']) : '';

        //Datos

        if (empty($input['url']))
        {
            add_settings_error(
                'url',                     // Setting title
                'data_service_url_texterror',            // Error ID
                'Please enter a valid url value',     // Error message
                'error'                         // Type of message
            );
        }
        else{
            $valid['url'] = esc_url($input['url']);
        }



        return $valid;
    }

}
