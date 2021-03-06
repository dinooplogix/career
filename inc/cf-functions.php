<?php
function cf_get_customposts_by_terms($display_count, $post_type, $terms) {
    $page = get_query_var('paged') ? get_query_var('paged') : 1;
    $offset = ( $page - 1 ) * $display_count;

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $display_count,
        'page' => $page,
        'offset' => $offset,
        'order'     => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'question_category',
                'field' => 'slug',
                'terms' => $terms
            ),
        ),
    );
    


    $the_query = new WP_Query($args);
    return $the_query;
}


function cf_display_front_messages($type = null, $message = null, $echothis = null) {
    if ($echothis != null) {
        //Rapid message display
        ?>
        <div class="alert bg-<?php echo $type; ?>">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo $message; ?>
        </div>
        <?php
        return;
    }
    //$type can be success, warning, danger, info, primary
    if ($type == null && $message == null) {
        // Show last saved message
        $message = get_option('cr_message');
        $type = get_option('cr_message_type');
        if ($message !== '') {
            ?>
            <div class="alert bg-<?php echo $type; ?>">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo $message; ?>
            </div>
            <?php
        }
        //Erase message after show it
        update_option('cr_message', '');
        update_option('cr_message_type', '');
    } else {
        //You have new message, save it...
        update_option('cr_message_type', $type);
        update_option('cr_message', $message);
    }
}

function cf_create_page_and_insert_shortcode($page_title, $shortcode = NULL) {

    $page = get_page_by_title($page_title);

    if ($shortcode == NULL) {
        $shortcode = $page_title;
    }

    if ($page == NULL) {
        $postarr = array(
            'post_content' => '[' . $shortcode . ']',
            'post_title' => $page_title,
            'post_status' => 'publish',
            'post_type' => 'page'
        );
        wp_insert_post($postarr);
        return true;
    }

    if (isset($page->post_status) && $page->post_status == 'trash') {
        $update_post = array(
            'ID' => $page->ID,
            'post_status' => 'publish',
        );
        wp_update_post($update_post);
        return true;
    }
}
