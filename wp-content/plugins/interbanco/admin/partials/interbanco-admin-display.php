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


<div>
    <form name="ib_settings">

        <div>
            <label for="ib_settings[title]">Titulo</label>

            <input type="text" id="ib_settings[title]"/>
        </div>

        <div>
            <label for="ib_settings[class]">Clase</label>
            <input type="text" id="ib_settings[class]"/>
        </div>

        <div>
            <label for="ib_settings[start_date]">Start Date</label>
            <input type="date" id="ib_settings[start_date]"/>
        </div>

        <div>
            <label for="ib_settings[end_date]]">End Date</label>
            <input type="date" id="ib_settings[end_date]"/>
        </div>


        <div>
            <label for="ib_settings[service_endpoint]]">Service End Point</label>
            <input type="text" id="ib_settings[service_endpoint]"/>
        </div>


        <div>
            <button type="submit">Guardar</button>
        </div>


    </form>

</div>