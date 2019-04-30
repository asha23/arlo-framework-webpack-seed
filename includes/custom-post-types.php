<?php

function work_post_type() {

    $labels = array(
        'name'                  => _x( 'Work', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'text_domain' ),
        'name_admin_bar'        => __( 'Work', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Work', 'text_domain' ),
        'add_new_item'          => __( 'Add New Work', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Work', 'text_domain' ),
        'description'           => __( 'Work Custom Post', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions', 'thumbnail'),
        'taxonomies'            => array( ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-images-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'rewrite' => array(
            "with_front" => true
        ),
    );
    register_post_type( 'our-work', $args );
}
add_action( 'init', 'work_post_type', 0 );

// Example taxonomy

function work_category_taxonomy() {
	$labels = array(
		'name'              => _x( 'Work', 'taxonomy general name' ),
		'singular_name'     => _x( 'Work', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Work' ),
		'all_items'         => __( 'All Work' ),
		'parent_item'       => __( 'Parent Work' ),
		'parent_item_colon' => __( 'Parent Work:' ),
		'edit_item'         => __( 'Edit Work' ),
		'update_item'       => __( 'Update Work' ),
		'add_new_item'      => __( 'Add New Work' ),
		'new_item_name'     => __( 'New Work' ),
		'menu_name'         => __( 'Work Categories' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public'        => true,
		'has_archive'   => true,
	);

    register_taxonomy( 'work-categories', 'our-work', $args );
    
    $labels = array(
		'name'              => _x( 'Artists', 'taxonomy general name' ),
		'singular_name'     => _x( 'Artist', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Artists' ),
		'all_items'         => __( 'All Artists' ),
		'parent_item'       => __( 'Parent Artist' ),
		'parent_item_colon' => __( 'Parent Artist:' ),
		'edit_item'         => __( 'Edit Artist' ),
		'update_item'       => __( 'Update Artist' ),
		'add_new_item'      => __( 'Add New Artist' ),
		'new_item_name'     => __( 'New Artist' ),
		'menu_name'         => __( 'Artists' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public'        => true,
		'has_archive'   => true,
	);

    register_taxonomy( 'artist', 'our-work', $args );
    
    $labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Genres' ),
		'all_items'         => __( 'All Genres' ),
		'parent_item'       => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item'         => __( 'Edit Genre' ),
		'update_item'       => __( 'Update Genre' ),
		'add_new_item'      => __( 'Add New Genre' ),
		'new_item_name'     => __( 'New Genre' ),
		'menu_name'         => __( 'Genres' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public'        => true,
		'has_archive'   => true,
	);

	register_taxonomy( 'genre', 'our-work', $args );
}
add_action( 'init', 'work_category_taxonomy', 0 );





// function client_post_type() {

//     $labels = array(
//         'name'                  => _x( 'Clients', 'Post Type General Name', 'text_domain' ),
//         'singular_name'         => _x( 'Client', 'Post Type Singular Name', 'text_domain' ),
//         'name_admin_bar'        => __( 'Client', 'text_domain' ),
//         'parent_item_colon'     => __( 'Parent Client:', 'text_domain' ),
//         'all_items'             => __( 'All Clients', 'text_domain' ),
//         'add_new_item'          => __( 'Add New Client', 'text_domain' ),
//         'add_new'               => __( 'Add New', 'text_domain' ),
//         'new_item'              => __( 'New Client', 'text_domain' ),
//         'edit_item'             => __( 'Edit Client', 'text_domain' ),
//         'update_item'           => __( 'Update Client', 'text_domain' ),
//         'view_item'             => __( 'View Client', 'text_domain' ),
//         'search_items'          => __( 'Search Clients', 'text_domain' ),
//         'not_found'             => __( 'Not found', 'text_domain' ),
//         'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
//         'items_list'            => __( 'Clients list', 'text_domain' ),
//         'items_list_navigation' => __( 'Clients list navigation', 'text_domain' ),
//         'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
//     );
//     $args = array(
//         'label'                 => __( 'Clients', 'text_domain' ),
//         'description'           => __( 'Client Custom Post', 'text_domain' ),
//         'labels'                => $labels,
//         'supports'              => array( 'title', 'editor', 'revisions', 'thumbnail'),
//         'taxonomies'            => array( ),
//         'hierarchical'          => true,
//         'public'                => true,
//         'show_ui'               => true,
//         'show_in_menu'          => true,
//         'menu_position'         => 20,
//         'menu_icon'             => 'dashicons-images-alt',
//         'show_in_admin_bar'     => true,
//         'show_in_nav_menus'     => true,
//         'can_export'            => true,
//         'has_archive'           => true,
//         'exclude_from_search'   => false,
//         'publicly_queryable'    => true,
//         'capability_type'       => 'page',
//         'rewrite' => array(
//             "with_front" => true
//         ),
//     );
//     register_post_type( 'clients', $args );
// }
// add_action( 'init', 'client_post_type', 0 );

function staff_post_type() {

    $labels = array(
        'name'                  => _x( 'Staff', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'text_domain' ),
        'name_admin_bar'        => __( 'Staff', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Staff:', 'text_domain' ),
        'all_items'             => __( 'All Staff', 'text_domain' ),
        'add_new_item'          => __( 'Add New Staff', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Staff', 'text_domain' ),
        'edit_item'             => __( 'Edit Staff', 'text_domain' ),
        'update_item'           => __( 'Update Staff', 'text_domain' ),
        'view_item'             => __( 'View Staff', 'text_domain' ),
        'search_items'          => __( 'Search Staff', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'items_list'            => __( 'Staff list', 'text_domain' ),
        'items_list_navigation' => __( 'Staff list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Staff', 'text_domain' ),
        'description'           => __( 'Staff Custom Post', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions', 'thumbnail'),
        'taxonomies'            => array( ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-admin-users',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'rewrite' => array(
            "with_front" => true
        ),
    );
    register_post_type( 'staff', $args );
}
add_action( 'init', 'staff_post_type', 0 );




function office_post_type() {

    $labels = array(
        'name'                  => _x( 'Offices', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Office', 'Post Type Singular Name', 'text_domain' ),
        'name_admin_bar'        => __( 'Office', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Office:', 'text_domain' ),
        'all_items'             => __( 'All Offices', 'text_domain' ),
        'add_new_item'          => __( 'Add New Office', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Office', 'text_domain' ),
        'edit_item'             => __( 'Edit Office', 'text_domain' ),
        'update_item'           => __( 'Update Office', 'text_domain' ),
        'view_item'             => __( 'View Office', 'text_domain' ),
        'search_items'          => __( 'Search Office', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'items_list'            => __( 'Offices list', 'text_domain' ),
        'items_list_navigation' => __( 'Offices list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Offices', 'text_domain' ),
        'description'           => __( 'Office Custom Post', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions', 'thumbnail'),
        'taxonomies'            => array( ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-admin-site',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'rewrite' => array(
            "with_front" => true
        ),
    );
    register_post_type( 'office', $args );
}
add_action( 'init', 'office_post_type', 0 );


