<?php

class CR_Controller {

    function __construct() {
        
    }

    function search_value() {
        global $wpdb;

        $cr_meta = array('cr_location', 'cr_position', 'cr_category');

        foreach ($_POST as $key => $value) {

            $trimmed_value = trim($_POST[$key]);

            if (isset($_POST[$key]) && $trimmed_value != '' && in_array($key, $cr_meta)) {
                $box[] = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT post_id FROM {$wpdb->postmeta} WHERE meta_key='%s' AND meta_value='%s'", $key, $trimmed_value));
            }
        }

        if (count($box) == 3) {
            $col = array_intersect($box[0], $box[1], $box[3]);
        } elseif (count($box) == 2) {
            $col = array_intersect($box[0], $box[1]);
        } else {
            $col = $box[0];
        }


        return $col;
    }

    function get_all_careers() {
        global $wpdb;
        $col = $wpdb->get_col("SELECT DISTINCT ID FROM $wpdb->posts WHERE post_type='career' AND post_status = 'publish'");
        return $col;
    }

}