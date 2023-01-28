<?php

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	function sc_custom_taxonomies() {

	register_taxonomy( 'update_type',
		array('post'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => false,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Update Type', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Update Type', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Update Types', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Update Types', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Update Type', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Update Type:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Update Type', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Update Type', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Update Type', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Update Type', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'update_types','with_front' => false),
		)
	);
		register_taxonomy( 'profile_type',
		array('staff_profile'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Profile Type', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Profile Type', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Profile Type', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Profile Type', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Profile Type', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Profile Type:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Profile Type', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Profile Type', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Profile Type', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'profile_type','with_front' => false),
		)
	);
	register_taxonomy( 'resource_type',
		array('resources'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Resource Type', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Resource Type', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Resource Types', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Resource Types', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Resource Type', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Resource Type:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Resource Type', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Resource Type', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Resource Type', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Resource Type', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'resource_type','with_front' => false),
		)
	);
	register_taxonomy( 'issuetype',
		array('issues'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Issue Type', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Issue Type', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Issue Types', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Issue Types', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Issue Type', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Issue Type:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Issue Type', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Issue Type', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Issue Type', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Issue Type', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			//'rewrite' => array( 'slug' => 'issue_type','with_front' => false),
		)
	);
	register_taxonomy( 'state',
		array('resources'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'State', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'State', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search States', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All States', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent State', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent State:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit State', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update State', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New State', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New State', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'states','with_front' => false),
		)
	);
	register_taxonomy( 'state_year',
		array('state_profile'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Year', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Year', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Year', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Years', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Year', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Year:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Year', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Year', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Year', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Year', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);

}
		// adding the function to the Wordpress init
	add_action( 'init', 'sc_custom_taxonomies');
?>
