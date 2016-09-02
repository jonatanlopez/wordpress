<?php

/**
 * Created by PhpStorm.
 * User: jolopez
 * Date: 01/09/2016
 * Time: 4:46 PM
 */
class wg_agencias extends WP_Widget
{
    protected $defaults;

    function __construct()
    {

        $this->defaults = array(
            'title' => 'Widget Title',
            'service_url' => 'http://interconsumo/interconsumo.mov.businesslogic/srvMOVInterConsumo.asmx?op=getAgenciasInterBanco'
        );

        $widget_options = array(
            'classname' => 'wg_agencias',
            'description' => 'Widget para mostrar las agencias de Interbanco'
        );

        $control_options = array(
            'id_base' => 'wg_agencias',
        );


        parent::__construct('wg_agencias', 'Widget para mostrar las agencias de Interbanco', $widget_options, $control_options);

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     *
     *
     */
    function form($instance)
    {
        /**Merge with defaults**/
        $instance = wp_parse_args((array)$instance, $this->defaults);


        //HTML ADMIN VIEW if( current_user_can('editor') || current_user_can('administrator') )
        ?>

        <div>
            <label for="<?php echo $this->get_field_id('title'); ?>">Titulo</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($instance['title']); ?>"/>
        </div>

        <?php

        if ( current_user_can('administrator')) {
            ?>
            <div>
                <span>editable to admininistrator only</span>
                <label for="<?php echo $this->get_field_id('service_url'); ?>">Service Url</label>
                <input class="widefat" id="<?php echo $this->get_field_id('service_url'); ?>"
                       name="<?php echo $this->get_field_name('service_url'); ?>" type="text"
                       value="<?php echo esc_attr($instance['service_url']); ?>"/>
            </div>
            <?php
        } else {
            ?>
            <div>
                <span>editable to admininistrator only</span>
                <label for="<?php echo $this->get_field_id('service_url'); ?>">Service Url</label>
                <span class="widefat"><?php echo esc_attr($instance['service_url']); ?></span>
            </div>

            <?php
        }
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     *
     *
     * @return	array Updated safe values to be saved.
     */
    function update($newinstance, $oldinstance)
    {
        return $newinstance;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget($args, $instance)
    {
        extract($args);

        /** Merge with defaults */
        $instance = wp_parse_args((array)$instance, $this->defaults);

        echo $args['before_widget'];

//        if (!empty($instance['title'])) {
//            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];
//        }


        //Aqui podemos invocar el servicio con los parametros del widget y/o informacion contextual, como por ejemplo las categorias
        $service_result =  consultar_agencias_service($instance['service_url']);
        //$service_result = 0;

        //write_log($service_result);


        //HTML Widget View
        /*
         * main class
         * specific class
         */
        ?>

        <!--Definir el box-->

        <div class="interbanco_widget_box interbanco_wg_base">

            <div class="clip_circle_mod icon_mod icn_tipo_cambio"></div><!-- icono del módulo-->

            <div id="interbanco_widget_header">
                <span class="txt_titulo"><?php echo $instance['title'] ?></span>
            </div>

            <div class="interbanco_widget_body">

                <?php
                foreach($service_result as $value){
                    echo "<div>".$value->nom."</div>";
                    echo "<div>".$value->dir."</div>";
                    echo "<div>".$value->hor."</div>";
                    echo "<hr/>";
                }
                ?>
            </div>


        </div>
        <!-- fin box-->
        <?php


        echo $args['after_widget'];
    }


}


add_action('widgets_init', 'interbanco_load_wg_agencias');
/**
 * Widget Registration.
 *
 * Register Agencias widget.
 *
 */
function interbanco_load_wg_agencias()
{
    register_widget('wg_agencias');
}