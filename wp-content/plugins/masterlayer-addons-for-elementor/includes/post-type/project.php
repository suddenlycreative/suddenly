<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Register project post type
function register_project_post_type() {
    $project_slug = 'project';

    $labels = array(
        'name'               => esc_html__( 'Projects', 'masterlayer' ),
        'singular_name'      => esc_html__( 'Project Item', 'masterlayer' ),
        'add_new'            => esc_html__( 'Add New', 'masterlayer' ),
        'add_new_item'       => esc_html__( 'Add New Item', 'masterlayer' ),
        'new_item'           => esc_html__( 'New Item', 'masterlayer' ),
        'edit_item'          => esc_html__( 'Edit Item', 'masterlayer' ),
        'view_item'          => esc_html__( 'View Item', 'masterlayer' ),
        'all_items'          => esc_html__( 'All Items', 'masterlayer' ),
        'search_items'       => esc_html__( 'Search Items', 'masterlayer' ),
        'parent_item_colon'  => esc_html__( 'Parent Items:', 'masterlayer' ),
        'not_found'          => esc_html__( 'No items found.', 'masterlayer' ),
        'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'masterlayer' )
    );

    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $project_slug ),
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
        'public'        => true
    );

    register_post_type( 'project', $args );
}

add_action('init', 'register_project_post_type');

// Project update messages.
function project_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['project'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => esc_html__( 'Project updated.', 'masterlayer' ),
        2  => esc_html__( 'Custom field updated.', 'masterlayer' ),
        3  => esc_html__( 'Custom field deleted.', 'masterlayer' ),
        4  => esc_html__( 'Project updated.', 'masterlayer' ),
        5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Project restored to revision from %s', 'masterlayer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => esc_html__( 'Project published.', 'masterlayer' ),
        7  => esc_html__( 'Project saved.', 'masterlayer' ),
        8  => esc_html__( 'Project submitted.', 'masterlayer' ),
        9  => sprintf(
            esc_html__( 'Project scheduled for: <strong>%1$s</strong>.', 'masterlayer' ),
            date_i18n( esc_html__( 'M j, Y @ G:i', 'masterlayer' ), strtotime( $post->post_date ) )
        ),
        10 => esc_html__( 'Project draft updated.', 'masterlayer' )
    );
    return $messages;
}

add_filter( 'post_updated_messages', 'project_updated_messages' );

// Register project taxonomy
function register_project_taxonomy() {
    $cat_slug = 'project_category';

    $labels = array(
        'name'                       => esc_html__( 'Project Categories', 'masterlayer' ),
        'singular_name'              => esc_html__( 'Category', 'masterlayer' ),
        'search_items'               => esc_html__( 'Search Categories', 'masterlayer' ),
        'menu_name'                  => esc_html__( 'Categories', 'masterlayer' ),
        'all_items'                  => esc_html__( 'All Categories', 'masterlayer' ),
        'parent_item'                => esc_html__( 'Parent Category', 'masterlayer' ),
        'parent_item_colon'          => esc_html__( 'Parent Category:', 'masterlayer' ),
        'new_item_name'              => esc_html__( 'New Category Name', 'masterlayer' ),
        'add_new_item'               => esc_html__( 'Add New Category', 'masterlayer' ),
        'edit_item'                  => esc_html__( 'Edit Category', 'masterlayer' ),
        'update_item'                => esc_html__( 'Update Category', 'masterlayer' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'masterlayer' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'masterlayer' ),
        'not_found'                  => esc_html__( 'No Category found.', 'masterlayer' ),
        'menu_name'                  => esc_html__( 'Categories', 'masterlayer' )
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug'=>$cat_slug ),
        'hierarchical'  => true,
    );
    register_taxonomy( 'project_category', 'project', $args );
}

add_action( 'init', 'register_project_taxonomy' );