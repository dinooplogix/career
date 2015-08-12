<?php

$virtual_page = array(
    'forget-password' => 'Forget Password',
    'reset-password' => 'Reset Password',
    'register' => 'Register',
    'account' => 'My Account',
    'dedicated-servers' => 'Dedicated Servers',
);

add_action('init', 'mb_rewrite_rules');

function mb_rewrite_rules() {
    // add_rewrite_rule('^forget-password/([^/]*)/?$', 'index.php?pagename=mb-page-manager&tax_slug=$matches[1]&screen=assessment_single', 'top');
    add_rewrite_rule('^forget-password/?$', 'index.php?pagename=mb-page-manager&screen=forget-password', 'top');
    add_rewrite_rule('^reset-password/?$', 'index.php?pagename=mb-page-manager&screen=reset-password', 'top');
    add_rewrite_rule('^register/?$', 'index.php?pagename=mb-page-manager&screen=register-form', 'top');
    add_rewrite_rule('^account/?$', 'index.php?pagename=mb-page-manager&screen=profile-page', 'top');
    
    //show bare metals in dedicated page
    add_rewrite_rule('^hosting/dedicated-servers/?$', 'index.php?pagename=shop&product_cat=bare-metal-servers', 'top');
}

add_action('init', 'mb_required_pages');

function mb_required_pages() {
    ob_start();
    cf_create_page_and_insert_shortcode('mb-page-manager');
}

add_filter('the_title', 'remove_mb_page_manager');

function remove_mb_page_manager($string) {
    
    global $virtual_page;

    if (is_admin()) {
        return $string;
    }

    if ($string == 'mb-page-manager') {

        $slug = (isset($_SERVER['REDIRECT_URL'])) ? basename($_SERVER['REDIRECT_URL']) : '';
        
        if (array_key_exists($slug, $virtual_page)) {
            $string = $virtual_page[$slug];
        } else {
            $string = '';
        }
    }
    

    return $string;
}

add_shortcode('mb-page-manager', 'mb_page_manager_display');

function mb_page_manager_display() {

    $mbObj = new MB_Manager();

    $screen = get_query_var('screen');

    // example.com/forget-password
    if ($screen == 'forget-password') {
        $mbObj->display_username_enquery();
    }

    // example.com/reset-password
    if ($screen == 'reset-password') {
        $mbObj->display_password_reset_form();
    }

    // example.com/register
    if ($screen == 'register-form') {
        if (is_user_logged_in()) {
            ob_end_clean();
            wp_safe_redirect(site_url() . "/account");
            exit;
        }
        $mbObj->display_register_page();
    }

    // example.com/account
    if ($screen == 'profile-page') {
        $user_id = get_current_user_id();

        if ($user_id == 0) {
            ob_end_clean();
            wp_safe_redirect(site_url() . "/register");
            exit;
        } else {
            $mbObj->display_account_page($user_id);
        }
    }
}

add_filter('query_vars', 'mb_query_vars');

function mb_query_vars($qvars) {
    $qvars[] = 'screen';
    return $qvars;
}

function mb_wp_title($title, $sep) {
    global $virtual_page;
    
    $slug = (isset($_SERVER['REDIRECT_URL'])) ? basename($_SERVER['REDIRECT_URL']) : '';
    
    if (array_key_exists($slug, $virtual_page)) {
        $string = $virtual_page[$slug];
        $title = $string . ' ' . $sep . ' ' . get_option('blogname');
    }
    
    return $title;
}

add_filter('wp_title', 'mb_wp_title', 10, 2);
