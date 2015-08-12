<?php

define('MB_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MB_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once MB_PLUGIN_PATH . 'class-manager.php';
require_once MB_PLUGIN_PATH . 'page-redirect.php';

add_action('wp_enqueue_scripts', 'mb_load_scripts');

function mb_load_scripts() {
    //wp_enqueue_style('cr-style', CR_PLUGIN_URL . 'css/style.css');
    wp_enqueue_script('cr-script-validate-form', MB_PLUGIN_URL . 'js/validate-form.js', array('jquery'), '1.0.0', true);
    
}