<?php


function cr_get_id_by_slug($page_slug) {
    global $wpdb;
    $page = get_page_by_path($page_slug);
    $id = $wpdb->get_var("SELECT ID FROM wp_posts WHERE post_name = '{$page_slug}'");
    if ($page) {
        return $page->ID;
    } else {
        return $id;
    }
}


