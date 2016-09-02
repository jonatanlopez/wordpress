<?php
/**
 * Plugin Name: Interbanco Widget Pack
 * Plugin URI: https://github.com/jonatanlopez
 * Description: Adds InterBanco specific widgets to web site
 * Author: Jonatan Lopez
 * Author URI: https://twitter.com/jolopez_
 * Version: 1.0
 * License: GPLv2 or later
 *
 * @package Interbanco Widget Pack
 * @version 1.0
 *
 * Plugin prefix: 'interbanco_widgets_'
 */



// Define plugin version constant
define( 'INTERBANCO_WIDGET_PACK_VERSION', '1.0' );



/**
 * Enqueue CSS and JS files
 *
 * @since 0.1
 */
function interbanco_widgets_add_scripts_styles() {
    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    $css_url = plugins_url( "css/interbanco-widget-pack$min.css", __FILE__ );
    wp_register_style( 'interbanco_widget-pack', $css_url, '', INTERBANCO_WIDGET_PACK_VERSION );
    wp_enqueue_style( 'interbanco_widget-pack' );

    wp_enqueue_script( 'jquery' );

    $js_url = plugins_url( "js/interbanco-widget-pack$min.js", __FILE__ );
    wp_register_script( 'interbanco_widget-pack', $js_url, array( 'jquery' ), INTERBANCO_WIDGET_PACK_VERSION );
    wp_enqueue_script( 'interbanco_widget-pack' );
}
add_action( 'wp_enqueue_scripts', 'interbanco_widgets_add_scripts_styles' );



/**
 * Servicios generales
 *
 * @since	Interbanco Widget Pack 0.1
 */
include( plugin_dir_path( __FILE__ ) . 'includes/interbanco_services.php' );


/**
 * Tipo de Cambio Widget
 *
 * @since	Interbanco Widget Pack 0.1
 */
include( plugin_dir_path( __FILE__ ) . 'widgets/wg_tipo_cambio.php' );


/**
 * Agencias Widget
 *
 * @since	Interbanco Widget Pack 0.1
 */
include( plugin_dir_path( __FILE__ ) . 'widgets/wg_agencias.php' );

