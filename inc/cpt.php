<?php
/**
 * custom post types
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//presentation custom post type

// Register Custom Post Type presentation
// Post Type Key: presentation

function create_presentation_cpt() {

  $labels = array(
    'name' => __( 'Presentations', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Presentation', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Presentation', 'textdomain' ),
    'name_admin_bar' => __( 'Presentation', 'textdomain' ),
    'archives' => __( 'Presentation Archives', 'textdomain' ),
    'attributes' => __( 'Presentation Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Presentation:', 'textdomain' ),
    'all_items' => __( 'All Presentations', 'textdomain' ),
    'add_new_item' => __( 'Add New Presentation', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Presentation', 'textdomain' ),
    'edit_item' => __( 'Edit Presentation', 'textdomain' ),
    'update_item' => __( 'Update Presentation', 'textdomain' ),
    'view_item' => __( 'View Presentation', 'textdomain' ),
    'view_items' => __( 'View Presentations', 'textdomain' ),
    'search_items' => __( 'Search Presentations', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into presentation', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this presentation', 'textdomain' ),
    'items_list' => __( 'Presentation list', 'textdomain' ),
    'items_list_navigation' => __( 'Presentation list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Presentation list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'presentation', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail','excerpt'),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'presentation', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_presentation_cpt', 0 );


//presenter custom post type

// Register Custom Post Type presenter
// Post Type Key: presenter

function create_presenter_cpt() {

  $labels = array(
    'name' => __( 'Presenters', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Presenter', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Presenter', 'textdomain' ),
    'name_admin_bar' => __( 'Presenter', 'textdomain' ),
    'archives' => __( 'Presenter Archives', 'textdomain' ),
    'attributes' => __( 'Presenter Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Presenter:', 'textdomain' ),
    'all_items' => __( 'All Presenters', 'textdomain' ),
    'add_new_item' => __( 'Add New Presenter', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Presenter', 'textdomain' ),
    'edit_item' => __( 'Edit Presenter', 'textdomain' ),
    'update_item' => __( 'Update Presenter', 'textdomain' ),
    'view_item' => __( 'View Presenter', 'textdomain' ),
    'view_items' => __( 'View Presenters', 'textdomain' ),
    'search_items' => __( 'Search Presenters', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into presenter', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this presenter', 'textdomain' ),
    'items_list' => __( 'Presenter list', 'textdomain' ),
    'items_list_navigation' => __( 'Presenter list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Presenter list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'presenter', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail','excerpt'),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'presenter', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_presenter_cpt', 0 );


