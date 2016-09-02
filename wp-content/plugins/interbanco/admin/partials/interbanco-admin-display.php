<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://twitter.com/jolopez_
 * @since      1.0.0
 *
 * @package    Interbanco
 * @subpackage Interbanco/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="wrap">

    <span class="dashicons dashicons-admin-tools"></span>

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <p>Opciones para especificas para la administracion de la pagina Web de InterBanco</p>


    <form method="post" name="wib_interbanco_options" action="options.php">



        <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Cleanup
        $title = $options['title'];
        $classname = $options['classname'];
        $url = $options['url'];
        ?>



        <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        ?>


        <h2>General</h2>

        <table class="form-table">


            <tr>
                <th scope="row">
                    <label for="<?php echo $this->plugin_name; ?>-title">Titulo</label>
                </th>

                <td>
                    <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-title"
                           name="<?php echo $this->plugin_name; ?>[title]" value="<?php echo $title ?>">
                    <br>
                    <span class="description"><?php esc_attr_e('Titulo de la opcion', $this->plugin_name); ?></span>
                </td>
            </tr>


        </table>

        <hr/>
        <h2>Apariencia</h2>
        <table class="form-table">


            <tr>
                <th scope="row">
                    <label for="<?php echo $this->plugin_name; ?>-classname">Clase CSS</label>
                </th>

                <td>

                    <select name="<?php echo $this->plugin_name; ?>[classname]" id="<?php echo $this->plugin_name; ?>-classname">
                        <option value="" <?php selected($classname, "" ); ?>>Please select a body background color</option>
                        <option value="blue" <?php selected( $classname, "blue" ); ?>>Blue</option>
                        <option value="red" <?php selected( $classname, "red" ); ?>>Red</option>
                        <option value="yellow" <?php selected( $classname, "yellow" ); ?>>Yellow</option>
                        <option value="green" <?php selected( $classname, "green" ); ?>>Green</option>
                    </select>

                    <br>
                    <span class="description"><?php esc_attr_e('CSS Clase', $this->plugin_name); ?></span>
                </td>
            </tr>


        </table>

        <hr/>
        <h2>Datos</h2>
        <table class="form-table">

            <tr>
                <th scope="row">
                    <label for="<?php echo $this->plugin_name; ?>-title">Url</label>
                </th>

                <td>
                    <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-url"
                           name="<?php echo $this->plugin_name; ?>[url]"  value="<?php echo $url ?>">
                    <br>
                    <span class="description"><?php esc_attr_e('Url del origen de datos', $this->plugin_name); ?></span>
                </td>
            </tr>

        </table>


        <?php submit_button('Save all changes', 'primary', 'submit', TRUE) ?>


    </form>

</div>