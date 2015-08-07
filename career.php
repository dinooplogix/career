<?php
/*
  Plugin Name: career
  Plugin URI:
  Description: Generate career form
  Author: Supporter
  Author URI: http://www.neolinktechnologies.com/
  Terms and Conditions:
  Version: 1.2
 */


define('CR_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CR_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once CR_PLUGIN_PATH . 'inc/functions.php';
require_once CR_PLUGIN_PATH . 'inc/actions.php';

register_activation_hook(__FILE__, 'cr_on_active');

function cr_on_active() {
    
}

add_action('wp_enqueue_scripts', 'cr_load_scripts');

function cr_load_scripts() {
    wp_enqueue_style('cr-style', CR_PLUGIN_URL . 'css/style.css');
    wp_enqueue_script('cr-script-bootstrap', CR_PLUGIN_URL . 'js/script.js', array('jquery'), '1.0.0');
}

add_action('wp_footer', 'cr_print_footer');
function cr_print_head() {
    ?>
    <script>
        jQuery(function ($) {


        });
    </script>
    <?php
}
