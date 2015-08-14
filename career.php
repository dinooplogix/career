<?php
/*
  Plugin Name: career
  Plugin URI:
  Description: Plugin used develop career page for add job, search job, and apply job etc.
  Author: Dinoop
  Author URI: http://www.neolinktechnologies.com/
  Terms and Conditions:
  Version: 1.3.0
 */


define('CR_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CR_PLUGIN_URL', plugin_dir_url(__FILE__));

register_activation_hook(__FILE__, 'cr_on_active');

function cr_on_active() {
    add_role( 'candidate', 'Candidate', array( 'read' => true, 'level_0' => true ) );
}

require_once CR_PLUGIN_PATH . 'inc/cf-functions.php';
require_once CR_PLUGIN_PATH . 'inc/functions.php';

require_once CR_PLUGIN_PATH . 'inc/career-controller.php';
require_once CR_PLUGIN_PATH . 'inc/career-view.php';

require_once CR_PLUGIN_PATH . 'inc/actions.php';
require_once CR_PLUGIN_PATH . 'inc/page-redirect.php';
require_once CR_PLUGIN_PATH . 'members/members.php';

