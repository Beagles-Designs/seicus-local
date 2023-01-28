<?php
/* Bones Custom Post Type Example
This page walks you through creating
a custom post type and taxonomies. You
can edit this one or copy the following code
to create another one.

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'sc_flush_rewrite_rules' );

// Flush your rewrite rules
function sc_flush_rewrite_rules() {
	flush_rewrite_rules();
}

function sc_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News & Updates';
    $submenu['edit.php'][5][0] = 'News & Updates';
    $submenu['edit.php'][10][0] = 'Add New';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
function sc_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News & Updates';
    $labels->singular_name = 'News & Updates';
    $labels->add_new = 'Add News & Updates';
    $labels->add_new_item = 'Add News & Updates';
    $labels->edit_item = 'Edit News & Updates';
    $labels->new_item = 'News & Updates';
    $labels->view_item = 'View News & Updates';
    $labels->search_items = 'Search News & Updates';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News & Updates';
    $labels->menu_name = 'News & Updates';
    $labels->name_admin_bar = 'News & Updates';
}

add_action( 'admin_menu', 'sc_change_post_label' );
add_action( 'init', 'sc_change_post_object' );



// let's create the function for the custom type
function sc_custom_post_types() {
	// creating (registering) the staff profiles
	register_post_type( 'staff_profile', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Staff Profile', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Staff Profile', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Staff Profiles', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New Staff Profile', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Staff Profile', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Staff Profile', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Staff Profile', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Staff Profile', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Staff Profiles', 'bonestheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Staff Profile', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'staff-profile', 'with_front' => true), /* you can specify its url slug */
			'has_archive' => 'staff-profiles', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions')
		) /* end of options */
	); /* end of register post type */


	// creating (registering) resources
	register_post_type( 'resources', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Resources', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Resource', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Resources', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Resource', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Resource', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Resource', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Resource', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Resource', 'bonestheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Resources for resource section', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7, /* this is what order you want it to appear in on the left hand side menu */
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'resources', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor','thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type `*/
	//	register_taxonomy_for_object_type( 'category', 'resources' );
	/* this adds your post tags to your custom post type */
	//	register_taxonomy_for_object_type( 'post_tag', 'resources' );

	// creating (registering) resources
	register_post_type( 'state_profile', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'State Profile', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'State Profile', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All State Profiles', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New State Profile', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit State Profile', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New State Profile', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View State Profile', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search State Profile', 'bonestheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'State Profile for map section', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7, /* this is what order you want it to appear in on the left hand side menu */
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'state_profile', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor','thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */


	// creating (registering) issues post type
	register_post_type( 'issue', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
				'name' => __( 'Issues', 'bonestheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Issue', 'bonestheme' ), /* This is the individual type */
				'all_items' => __( 'All Issues', 'bonestheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Issue', 'bonestheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Issue', 'bonestheme' ), /* Edit Display Title */
				'new_item' => __( 'New Issue', 'bonestheme' ), /* New Display Title */
				'view_item' => __( 'View Issue', 'bonestheme' ), /* View Display Title */
				'search_items' => __( 'Search Issues', 'bonestheme' ), /* Search Custom Type Title */
				'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, 
			'rewrite'	=> array( 'slug' => 'issue', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor','thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type `*/
	register_taxonomy_for_object_type( 'year', 'state_profile' );

	// creating (registering) slides
	register_post_type( 'slide', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
				'name' => __( 'Homepage Hero', 'bonestheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Homepage Hero', 'bonestheme' ), /* This is the individual type */
				'all_items' => __( 'All Homepage Heros', 'bonestheme' ), /* the all items menu item */
				'add_new' => __( 'Add New Homepage Hero', 'bonestheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Homepage Hero', 'bonestheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Homepage Hero', 'bonestheme' ), /* Edit Display Title */
				'new_item' => __( 'New Homepage Hero', 'bonestheme' ), /* New Display Title */
				'view_item' => __( 'View Homepage Hero', 'bonestheme' ), /* View Display Title */
				'search_items' => __( 'Search Homepage Hero', 'bonestheme' ), /* Search Custom Type Title */
				'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Homepage Hero Area', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' =>5, /* this is what order you want it to appear in on the left hand side menu */
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'slides', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */




}

	// adding the function to the Wordpress init
	add_action( 'init', 'sc_custom_post_types');

?>
