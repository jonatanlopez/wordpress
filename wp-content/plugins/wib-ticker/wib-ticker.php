<?php
/*
Plugin Name: Web InterBanco Ticker
Plugin URI: https://www.interbanco.com.gt/webinterbancoticker
Description: A simple, exchange rate ticker widget.
Author: Jonatan Lopez
Author URI: https://github.com/jonatanlopez

Version: 1.0.0

Text Domain: wib-ticker
Domain Path: /languages

License: GNU General Public License v2.0 (or later)
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

//add_action('plugins_loaded', 'wib_ticker_load');


class WIB_Ticker extends WP_Widget
{

    protected $defaults;


    function __construct()
    {

        $this->defaults = array(
            'title' => 'Sample Title',
            'url' => 'http://intranetap/services/ticker/rates.json'
        );

        $widget_options = array(
            'classname' => 'wib_ticker_widget',
            'description' => 'Widget para mostrar el tipo de cambio de Interbanco'
        );

        $control_options = array(
            'id_base' => 'wib_ticker',
        );


        parent::__construct('wib_ticker', 'Ticker Exchange Rate Widget', $widget_options, $control_options);


    }


    function form($instance)
    {
        /**Merge with defaults**/
        $instance = wp_parse_args((array)$instance, $this->defaults);
        ?>

        <div>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($instance['title']); ?>"/>
        </div>

        <div>
            <label for="<?php echo $this->get_field_id('url'); ?>">Url</label>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>"
                   name="<?php echo $this->get_field_name('url'); ?>" type="text"
                   value="<?php echo esc_attr($instance['url']); ?>"/>
        </div>

        <?php
    }


    function update($newinstance, $oldinstance)
    {


//        foreach ($newinstance as $key => $value) {
//
//        }

        return $newinstance;
    }

    /**
     * Widget Output.
     *
     * Outputs the actual widget on the front-end based on the widget options the user selected.
     *
     */

    function widget($args, $instance)
    {
        extract($args);

        /** Merge with defaults */
        $instance = wp_parse_args((array)$instance, $this->defaults);

        echo $args['before_widget'];

        if (!empty($instace['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];


        }
        $output = '';

        $output = $instance['url'];

        ?>

        <!-- ticker tipo de cambio -->
        <div id="ticker_box" class="ticker_box">
            <div class="clip_circle_mod icon_mod icn_ticker"></div><!-- icono del módulo-->
            <div class="barra_ticker">
                <span class="tick_bold">CAMBIO &gt; </span>
                <span>USD compra 7.56 - venta 7.87</span><span class="tick_verde"> +0.02% </span><span> &#8226; </span>
                <span>EUR compra 8.56 - venta 9.98</span><span class="tick_rojo"> -0.3% </span>
            </div><!-- fin barra ticker -->

        </div> <!-- FIN ST BOX-->
        <!-- fin ticker tipo de cambio -->


    <?php



        //if ($output) {
        //    printf('<a href="%s">Link</a>', $output);
        //}

        echo $args['after_widget'];


        //parent::widget($args, $instance); // TODO: Change the autogenerated stub
    }



}


add_action( 'widgets_init', 'wib_load_widget' );
/**
 * Widget Registration.
 *
 * Register Simple Social Icons widget.
 *
 */
function wib_load_widget() {

    register_widget( 'WIB_Ticker' );

}