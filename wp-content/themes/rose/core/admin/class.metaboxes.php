<?php

/**
 * WO_Metaboxes
 * Custom Metabox
 *
 * We want to say thank you so much to WebDevStudios
 *
 * This category extended from their plugin
 *
 * @category Meta box
 * @package Wiloke Framework
 * @author Wiloke Team
 * @version 1.0
 */

if ( !defined('ABSPATH') )
{
    die();
}

class WO_Metaboxes
{
    public function __construct()
    {
        add_action( 'init', array($this, 'includes') );
//        add_filter( 'cmb_override_meta_value', array($this, 'wiloke_change_name_field'), 10, 4 );
        add_filter( 'cmb_meta_boxes', array($this, 'render') );
    }

    public function wiloke_change_name_field($type, $object_id, $args, $object_type)
    {

    }

    /**
     * Register and render meta boxes
     */
    public function render($aMetaBoxes)
    {
        return $aMetaBoxes;
    }

    /**
     * Include external lib here
     */
    public function includes()
    {
        global $wiloke;
        if ( !class_exists('cmb_Meta_Box') ) {
            include PI_FILE_CORE . 'admin/custom-metaboxes/init.php';
        }
    }
}

new WO_Metaboxes();