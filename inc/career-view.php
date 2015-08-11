<?php

class CR_View extends CR_Controller {

    function __construct() {
        
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
                        <td><?php echo get_the_title($post_id); ?></td>
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
        <form action="" method="post" >
            <label>Location: <input type="text" name="cr_location" value="<?php echo $cr_location; ?>"></label>
            <label>Position: <input type="text" name="cr_position" value="<?php echo $cr_position; ?>"></label>
            <label>Category: <input type="text" name="cr_category" value="<?php echo $cr_category; ?>"></label>
            <?php wp_nonce_field($form_action, $form_nonce_field); ?>
            <input type="submit" value="submit">
        </form>
        <?php
    }

    function page_init_action() {

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

}
