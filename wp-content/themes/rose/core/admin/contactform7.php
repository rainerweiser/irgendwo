<?php
/**
 *
 * @category Helper
 * @package Wiloke Framework
 * @author Wiloke Team
 * @version 1.0
 */

if ( !defined('ABSPATH') )
{
    exit;
}
if(!class_exists('rose_contactform7')) {
    class rose_contactform7
    {
        public function __construct()
        {
            add_action('wpcf7_admin_footer', array($this, 'wiloke_contactfom7_helper'));
            add_action('admin_enqueue_scripts', array($this, 'wiloke_enqueue_scripts'));
            add_action( 'wp_ajax_rose_contactform7_demo', array($this, 'rose_contactform7_demo' ));
            add_action( 'wp_ajax_nopriv_rose_contactform7_demo', array($this, 'rose_contactform7_demo' ));
        }

        public function wiloke_enqueue_scripts()
        {
            wp_enqueue_style('wiloke_contactform7', PI_ENQUEUE_CORE . 'admin/assets/css/contactform7.css', array(), null);
            wp_enqueue_script('wiloke_contactform7', PI_ENQUEUE_CORE . 'admin/assets/js/contactform7.js', array('jquery'), null, true);
        }

        public function wiloke_contactfom7_helper()
        {
            ?>
            <div id="wilokecontactform7" class="contactform7">
                <div class="postbox-container">
                    <div class="postbox">
                        <h2 class="hndle"><?php esc_html_e('Contact form 7 Option', 'rose'); ?></h2>
                        <div class="inside">
                            <p><?php esc_html_e('Click Import button make this contact form look like demo.', 'rose'); ?></p>
                            <button id="wiloke-import-contactform7" class="button button-primary"><?php esc_html__('Import', 'rose'); ?><?php esc_html_e('Import', 'rose'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        public function rose_contactform7_demo() { 
            ob_start(); ?>
            <div class="contact-form"> 
                <div class="row">
                    <p class="mb-25 col-sm-6">[text* your-name] </p>

                    <p class="mb-25 col-sm-6">[email* your-email]</p>

                    <p class="mb-25 col-sm-6">[text your-subject]</p>

                    <p class="mb-25 col-sm-6">[tel tel-134]</p>

                    <p class="mb-30 col-sm-12">[textarea your-message]</p>

                    <p class="col-sm-12 text-center">[submit "Send"]</p>
                </div>
            </div>
            <?php $output = ob_get_clean();

            echo $output;
            wp_die();
        }
    }

    new rose_contactform7;
}   
