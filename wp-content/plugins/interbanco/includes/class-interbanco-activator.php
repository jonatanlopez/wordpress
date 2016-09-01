<?php

/**
 * Fired during plugin activation
 *
 * @link       https://twitter.com/jolopez_
 * @since      1.0.0
 *
 * @package    Interbanco
 * @subpackage Interbanco/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Interbanco
 * @subpackage Interbanco/includes
 * @author     Jonatan Lopez <jonatan.fernando@gmail.com>
 */
class Interbanco_Activator
{


    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {

        //definir opciones

        $option_name = 'ib-settings';

        $data = array(
            'title' => 'Sample Title',
            'class' => 'sample-class',
            'start_date' => '',
            'end_date' => '',
            'service_endpoint' => 'https://intranetap/forms'
        );

        //write_log('Activate!');

        //write_log($data);


        //register_setting('ib_list_options',$option_name,array($this, $data, );

        add_action('admin_menu','ib_plugin_create_menu');


    }


    public static function ib_plugin_create_menu(){

        add_menu_page('My cool plugin settings', 'cool settings','administrator',__FILE__,'my_cool_plugin_settings_page',plugins_url('/images/icon.png'),__FILE__);
    }





    public static function validate($data, $input)
    {

        $valid = array();

        $valid['service_endpoint'] = sanitize_text_field($input['service_endpoint']);

        $valid['title'] = sanitize_text_field($input['title']);

        if (strlen($valid['service_endpoint']) == 0) {
            add_settings_error(
                'service_endpoint',       //Setting Title
                'service_endpoint_texterror', //Error Id
                'Please enter a valid Url',  //Error Message
                'error'   //Type of message
            );

            //Set it to the default value

            $valid['service_endpoint'] = $data['service_endpoint'];

        }

        if (strlen($valid['title']) == 0) {

            add_settings_error(
                'title',       //Setting Title
                'title_texterror', //Error Id
                'Please enter a valid Title',  //Error Message
                'error'   //Type of message
            );

            $valid['title'] = $data['title'];

        }

        return $valid;


    }


}