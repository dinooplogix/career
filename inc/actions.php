<?php


register_activation_hook(__FILE__, 'cr_on_active');

function cr_on_active() {
    
}



add_action('wp_enqueue_scripts', 'cr_load_scripts');

function cr_load_scripts() {
    wp_enqueue_style('cr-style', CR_PLUGIN_URL . 'css/style.css');
    wp_enqueue_style('cr-style-datatables', '//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css');
    wp_enqueue_script('cr-script-datatables', '//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css', array('jquery'), '1.0.0');
    
}
/**
 * 
 * 
add_action('wp_footer', 'cr_print_footer');
function cr_print_footer() {
    ?>
    <script>
        jQuery(function ($) {


        });
    </script>
    <?php
}

 */


add_action('init', 'cpu_add_career_post_type', 0);

function cpu_add_career_post_type() {

    $labels = array(
        'name' => _x('Careers', 'Post Type General Name', 'cr_domain'),
        'singular_name' => _x('Career', 'Post Type Singular Name', 'cr_domain'),
        'menu_name' => __('Careers', 'cr_domain'),
        'parent_item_colon' => __('Parent Career', 'cr_domain'),
        'all_items' => __('All Careers', 'cr_domain'),
        'view_item' => __('View Career', 'cr_domain'),
        'add_new_item' => __('Add New Career', 'cr_domain'),
        'add_new' => __('Add New', 'cr_domain'),
        'edit_item' => __('Edit Career', 'cr_domain'),
        'update_item' => __('Update Career', 'cr_domain'),
        'search_items' => __('Search Career', 'cr_domain'),
        'not_found' => __('Not Found', 'cr_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'cr_domain'),
    );

    $args = array(
        'label' => __('careers', 'cr_domain'),
        'description' => __('Career in Noodle Factory', 'cr_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('genres'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );

    register_post_type('career', $args);
}

/**
 * 
 * Define a category for career
 */
add_action('init', 'cpu_career_taxonomy');

function cpu_career_taxonomy() {

    $labels = array(
        'name' => _x('Career Categories', 'taxonomy general name'),
        'singular_name' => _x('Career Category', 'taxonomy singular name'),
        'search_items' => __('Search Category'),
        'all_items' => __('All Categories'),
        'parent_item' => __('Parent Category'),
        'parent_item_colon' => __('Parent Category:'),
        'edit_item' => __('Edit Category'),
        'update_item' => __('Update Category'),
        'add_new_item' => __('Add New Category'),
        'new_item_name' => __('New Category Name'),
        'menu_name' => __('Career Categories'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'career-category'),
    );

    register_taxonomy('career_category', array('careers'), $args);
}

// Career metabox --------------------------------------------------------------
function cr_career_add_meta_box() {
    $screens = array('career');
    foreach ($screens as $screen) {
        add_meta_box(
                'cr_career_sectionid', __('Career Details', 'cr_career_textdomain'), 'cr_career_meta_box_callback', $screen
        );
    }
}

add_action('add_meta_boxes', 'cr_career_add_meta_box');

function cr_career_meta_box_callback($post) {
    wp_nonce_field('cr_career_meta_box', 'cr_career_meta_box_nonce');
    ?>
    <table>
        <tr>
            <td><label for="cr_location">Location</label></td>
            <td><input type="text" id="cr_location" name="cr_location" 
                       value="<?php echo esc_attr(get_post_meta($post->ID, 'cr_location', true)); ?>"></td>
        </tr>
        <tr>
            <td><label for="cr_position">Position</label></td>
            <td><input type="text" id="cr_position" name="cr_position" 
                       value="<?php echo esc_attr(get_post_meta($post->ID, 'cr_position', true)); ?>"></td>
        </tr>
        <tr>
            <td><label for="cr_category">Job Category</label></td>
            <td><input type="text" id="cr_category" name="cr_category" 
                       value="<?php echo esc_attr(get_post_meta($post->ID, 'cr_category', true)); ?>"></td>

        </tr>
    </table>
    <?php
}

function cr_career_save_meta_box_data($post_id) {
    if (!isset($_POST['cr_career_meta_box_nonce']) || !wp_verify_nonce($_POST['cr_career_meta_box_nonce'], 'cr_career_meta_box')) {
        return;
    }

    $cr_meta = array('cr_location', 'cr_position', 'cr_category');
    foreach ($_POST as $key => $value) {
        if (in_array($key, $cr_meta)) {
            update_post_meta($post_id, $key, $value);
        }
    }
}

add_action('save_post', 'cr_career_save_meta_box_data');



add_shortcode('cr-career', 'cr_testcode_execute');

function cr_testcode_execute() {
    $crObj = new CR_View();
    $crObj->page_init_action();
}

/*
SELECT
A.`meta_value` AS 'cr_location',
B.`meta_value` AS 'cr_position',
C.`meta_value` AS 'cr_category'
				
FROM
`wp_postmeta` A,
`wp_postmeta` B,
`wp_postmeta` C,
				
WHERE
A.`post_id` = B.`post_id` AND
A.`post_id` = C.`post_id` AND

				
A.`meta_key` = 'cr_location' AND
B.`meta_key` = 'cr_position' AND
C.`meta_key` = 'cr_category' AND
 
A.`meta_value` = 'california' AND
B.`meta_value` = 'california' AND
C.`meta_value` = 'california' 
*/
