<?php

class CR_Controller {

    function __construct() {
        
    }

    function search_value() {
        global $wpdb;

        $cr_meta = array('cr_location', 'cr_position', 'cr_category');

        $box = array();

        foreach ($_POST as $key => $value) {

            $trimmed_value = trim($_POST[$key]);

            if (isset($_POST[$key]) && $trimmed_value != '' && in_array($key, $cr_meta)) {
                $box[] = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT post_id FROM {$wpdb->postmeta} WHERE meta_key=%s AND meta_value=%s", $key, $trimmed_value));
            }
        }

        if (count($box) == 3) {
            $col = array_intersect($box[0], $box[1], $box[2]);
        } elseif (count($box) == 2) {
            $col = array_intersect($box[0], $box[1]);
        } else {
            $col = (isset($box[0])) ? $box[0] : array();
        }

        return $col;
    }

    function get_all_careers() {
        global $wpdb;
        $col = $wpdb->get_col("SELECT DISTINCT ID FROM $wpdb->posts WHERE post_type='career' AND post_status = 'publish'");
        return $col;
    }

    function get_job_permalink($postid) {
        $post = get_post($postid);
        $slug = $post->post_name;
        return site_url() . '/careers/jobs/' . $slug;
    }

    function get_user_submitted_forms($user_id) {
        global $wpdb;
        $result = $wpdb->get_col($wpdb->prepare("SELECT meta_key FROM $wpdb->usermeta WHERE user_id = %d AND meta_key LIKE %s", $user_id, '%cr_application_form_%'));
        return $result;
    }

    function get_search_select_items($item) {
        global $wpdb;
        $result = $wpdb->get_col($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $item));
        $result = array_unique($result);
        return $result;
    }

    function save_application_form() {

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $file_size = 5 * 1000 * 1000; // 5MB

        if ($_FILES['resume']['name'] != '') {
            if (!$this->validate_file_type($_FILES['resume']['type']) || !$this->validate_file_type($_FILES['cover_letter']['type'])) {
                cf_display_front_messages('warning', 'The uploaded file type is not allowed ');
                return false;
            }

            if ($_FILES['resume']['size'] > $file_size || $_FILES['cover_letter']['size'] > $file_size) {
                cf_display_front_messages('warning', 'Maximum size of the file should not be exceed from 5MB');
                return false;
            }
        }

        $attachment_id = media_handle_upload('resume', 0);
        $_POST['resume'] = $attachment_id;

        $attachment_id = media_handle_upload('cover_letter', 0);
        $_POST['cover_letter'] = $attachment_id;

        update_user_meta($this->current_user_id, 'cr_application_form_' . $application_formid, $_POST);
        
    }

    function validate_file_type($file_type) {

        $office = array(
            'doc' => 'application/msword',
            'docx' => 'application/octet-stream',
            'odx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        return in_array($file_type, $office);
    }

    function get_question_answers($user_id) {

        $options = get_user_meta($user_id, 'cr_question_categories', true);
        $option_filtered = array();
        foreach ($options as $key => $value) {
            if (strpos($key, 'question_') != false) {
                $qustion_id = str_replace('question_', '', $key);
                $post = get_post($qustion_id);
                $option_filtered[]['question'] = $post->post_content;
                $option_filtered[]['answer'] = ($value) ? 'yes' : 'no';
            }
        }

        return $option_filtered;
    }

    function get_refined_question_answers($application) {

        $option_filtered = array();

        foreach ($application as $key => $value) {

            if (strpos($key, 'question_') !== false) {
                $qustion_id = str_replace('question_', '', $key);
                $post = get_post($qustion_id);
                $option_filtered[$key]['question'] = $post->post_content;
                $option_filtered[$key]['answer'] = ($value) ? 'yes' : 'no';
            }
        }
        return $option_filtered;
    }

    

}
