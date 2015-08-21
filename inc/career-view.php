<?php

class CR_View extends CR_Controller {

    private $html_display_path;

    function __construct() {

        $this->current_user_id = get_current_user_id();

        $this->site_url = site_url() . '/';
        $this->html_display_path = CR_PLUGIN_PATH . 'display/';
        $this->account_page_url = $this->site_url . "account/";
        $this->career_page_url = $this->site_url . "careers/";
        $this->application_submitted = $this->career_page_url . "application-submitted/";
    }

    function display_table($col = null) {

        if (is_null($col)) {
            $col = $this->get_all_careers();
        }

        if (empty($col)) {
            echo 'Sorry no jobs were found !!!<br />';
            return false;
        }

        require $this->html_display_path . 'table-career.php';
    }

    function display_form($form_action, $form_nonce_field) {
        $cr_location = $cr_position = $cr_category = '';
        if (isset($_POST[$form_nonce_field]) && wp_verify_nonce($_POST[$form_nonce_field], $form_action)) {
            extract($_POST);
        }
        require $this->html_display_path . 'form-search.php';
    }

    function display_job_details($postid) {
        $post = get_post($postid);
        require $this->html_display_path . 'page-job-details.php';
    }

    function display_career_page() {

        cf_display_front_messages();

        $form_action = 'job_search';
        $form_nonce_field = 'job_search_nonce_field';

        $this->display_form($form_action, $form_nonce_field);

        if (isset($_POST[$form_nonce_field]) && wp_verify_nonce($_POST[$form_nonce_field], $form_action)) {

            if ($_POST['cr_location'] == '' && $_POST['cr_position'] == '' && $_POST['cr_category'] == '') {
                $this->display_table();
            } else {

                $col = $this->search_value();

                $this->display_table($col);
            }
        } else {
            $this->display_table();
        }
    }

    function display_application_form() {

        $application_formid = get_query_var('application_formid');

        if (!$this->current_user_id) {
            ob_end_clean();
            wp_safe_redirect($this->account_page_url);
            exit;
        }

        $user = get_user_by('id', $this->current_user_id);

        $form_action = 'apply_job';
        $form_nonce_field = 'apply_job_nonce_field';

        if (isset($_POST[$form_nonce_field]) && wp_verify_nonce($_POST[$form_nonce_field], $form_action)) {

            // save application form data
            $this->save_application_form();

            ob_end_clean();
            wp_safe_redirect($this->application_submitted);
            exit;
        } else {
            require $this->html_display_path . 'form-application.php';
        }
    }

    function display_search_select_box($item, $cr_location) {
        ?>
        <select name="<?php echo $item; ?>">
            <option value=""> - </option>
            <?php
            $locations = $this->get_search_select_items($item);
            foreach ($locations as $value) {
                $select = ($cr_location == $value) ? 'selected' : '';
                echo '<option value="' . $value . '" ' . $select . '>' . $value . '</option>';
            }
            ?>
        </select>
        <?php
    }

    function display_logout_button() {
        if ($this->current_user_id) {
            ?><p style="text-align: right"><a href="<?php echo wp_logout_url(); ?>">Logout</a></p><?php
        }
    }

    function get_thanks_message() {

        ob_start();
        ?>

        <p>Thank you for Applying!</p>

        <p>Thank you for applying with the Battery Systems Family of Companies.</p>

        <p>We have, at this time, decided to pursue other candidates that we believe to be a closer fit for this position.  We invite you to apply again should you see a job posting for which you are more closely qualified.  We wish you every success in your job search.</p>

        <p>Best Regards, <br/>Human Resources (EOE)</p>
        
        <p><a href="<?php echo $this->career_page_url; ?>">Go back to opportunities</a></p>

        <?php
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

}
