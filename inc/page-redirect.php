<?php

$virtual_page = array(
    'jobs-single' => 'Job Details',
);

add_shortcode('cr-career', 'cr_testcode_execute');

function cr_testcode_execute() {
    ob_start();

    $crObj = new CR_View();
    $crObj->career_page_control();

    $contents = ob_get_contents();
    ob_end_clean();
    
    return $contents;
}

function cr_rewrite_rules() {
    add_rewrite_rule('^careers/jobs/([^/]*)?$', 'index.php?pagename=cr-page-manager&screen=jobs-single&jobslug=$matches[1]', 'top');
    add_rewrite_rule('^careers/apply/([\d]+)?$', 'index.php?pagename=cr-page-manager&screen=apply&application_formid=$matches[1]', 'top');
}

add_action('init', 'cr_rewrite_rules');

function cr_required_pages() {
    ob_start();
    cf_create_page_and_insert_shortcode('cr-page-manager');
}

add_action('init', 'cr_required_pages');

function remove_cr_page_manager($string) {

    global $virtual_page;

    if (is_admin()) {
        return $string;
    }
    if ($string == 'cr-page-manager') {

        $slug = (isset($_SERVER['REDIRECT_URL'])) ? basename($_SERVER['REDIRECT_URL']) : '';

        if (array_key_exists($slug, $virtual_page)) {
            $string = $virtual_page[$slug];
        } else {
            $string = '';
        }
    }
    return $string;
}

add_filter('the_title', 'remove_cr_page_manager');

function cr_page_manager_display() {

    $screen = get_query_var('screen');
    $crObj = new CR_View();

    // example.com/jobs/[jobname]
    if ($screen == 'jobs-single') {
        $jobslug = get_query_var('jobslug');
        $postid = cr_get_id_by_slug($jobslug);

        $crObj->display_job_details($postid);
    }

    //example.com/careers/apply/2
    if ($screen == 'apply') {
        $crObj->display_application_form();
    }
}

add_shortcode('cr-page-manager', 'cr_page_manager_display');

function cr_query_vars($qvars) {
    $qvars[] = 'screen';
    $qvars[] = 'jobslug';
    $qvars[] = 'application_formid';
    return $qvars;
}

add_filter('query_vars', 'cr_query_vars');

