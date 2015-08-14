<?php

class CR_View extends CR_Controller {

    private $html_display_path;

    function __construct() {
        $this->html_display_path = CR_PLUGIN_PATH . 'display/';
        $this->redirect_after_register = site_url() . "/account";
        $this->career_page_url = site_url() . "/careers";
    }

    function display_table($col = null) {

        if (is_null($col)) {
            $col = $this->get_all_careers();
        }

        if (empty($col)) {
            echo 'Sorry no jobs were found !!!<br />';
            return false;
        }
        ?>
        <table id="career" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Job Title</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($col as $key => $post_id): ?>
                    <tr>
                        <td><?php echo $post_id; ?></td>
                        <td><a href="<?php echo $this->get_job_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></td>
                        <td><?php echo get_post_meta($post_id, 'cr_location', true); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script>
            jQuery(function ($) {
                $('#career').DataTable();
            });
        </script>
        <?php
    }

    function display_form($form_action, $form_nonce_field) {
        $cr_location = $cr_position = $cr_category = '';
        if (isset($_POST[$form_nonce_field]) && wp_verify_nonce($_POST[$form_nonce_field], $form_action)) {
            extract($_POST);
        }
        ?>
        <form action="" method="post" class="search_form">
            <p>Location: <input type="text" name="cr_location" value="<?php echo $cr_location; ?>"></p>
            <p>Position: <input type="text" name="cr_position" value="<?php echo $cr_position; ?>"></p>
            <p>Category: <input type="text" name="cr_category" value="<?php echo $cr_category; ?>"></p>
            <?php wp_nonce_field($form_action, $form_nonce_field); ?>
            <input type="submit" value="submit">
        </form>
        <?php
    }

    function display_job_details($postid) {
        $post = get_post($postid);
        ?>
        <h2><?php echo $post->post_title; ?></h2>
        <p><?php echo $post->post_content; ?></p>
        <p><a href="<?php echo site_url() . '/careers/apply/' . $postid; ?>">Apply</a></p>
        <?php
    }

    function career_page_control() {
        cf_display_front_messages();

        $form_action = 'job_search';
        $form_nonce_field = 'job_search_nonce_field';

        $this->display_form($form_action, $form_nonce_field);

        if (isset($_POST[$form_nonce_field]) && wp_verify_nonce($_POST[$form_nonce_field], $form_action)) {
            $col = $this->search_value();
            $this->display_table($col);
        } else {
            $this->display_table();
        }
    }

    function display_application_form() {
        
        $application_formid = get_query_var('application_formid');

        if (!is_user_logged_in()) {
            ob_end_clean();
            wp_safe_redirect($this->redirect_after_register);
            exit;
        }

        $user_id = get_current_user_id();
        $user = get_user_by('id', $user_id);
        
        $form_action = 'apply_job';
        $form_nonce_field = 'apply_job_nonce_field';
        
        if (isset($_POST[$form_nonce_field]) && wp_verify_nonce($_POST[$form_nonce_field], $form_action)) {
            // save application form data
            update_user_meta($user_id, 'cr_application_form_' . $application_formid, $_POST);
            cf_display_front_messages("success", "Application successfully submitted");
            ob_end_clean();
            wp_safe_redirect($this->career_page_url);
            exit;
        } else {
            require $this->html_display_path . 'form-application.php';
        }
        
    }

}
