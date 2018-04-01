<?php
/**
 * Define custom [NAME]s
 *
 * @since jwe 1.0
 * @return void
 */

function custom_post_type() {

	$labels = array(
	   'name'               => _x( 'New [NAME]', '[NAME] general name', 'your-plugin-textdomain' ),
	   'singular_name'      => _x( 'Recipe', '[NAME] singular name', 'your-plugin-textdomain' ),
	   'menu_name'          => _x( 'New [NAME]', 'admin menu', 'your-plugin-textdomain' ),
	   'name_admin_bar'     => _x( 'New [NAME]', 'add new on admin bar', 'your-plugin-textdomain' ),
	   'add_new'            => _x( 'Add New', '[NAME]', 'your-plugin-textdomain' ),
	   'add_new_item'       => __( 'Add New [NAME]', 'your-plugin-textdomain' ),
	   'new_item'           => __( 'New [NAME]', 'your-plugin-textdomain' ),
	   'edit_item'          => __( 'Edit [NAME]', 'your-plugin-textdomain' ),
	   'view_item'          => __( 'View New [NAME]', 'your-plugin-textdomain' ),
	   'all_items'          => __( 'All New [NAME]', 'your-plugin-textdomain' ),
	   'search_items'       => __( 'Search New [NAME]', 'your-plugin-textdomain' ),
	   'parent_item_colon'  => __( 'Parent [NAME]:', 'your-plugin-textdomain' ),
	   'not_found'          => __( 'No [NAME] found.', 'your-plugin-textdomain' ),
	   'not_found_in_trash' => __( 'No New [NAME] found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
	   'labels'             => $labels,
	   'public'             => true,
	   'publicly_queryable' => true,
	   'show_ui'            => true,
	   'show_in_menu'       => true,
	   'query_var'          => true,
	   'capability_type'    => 'post',
	   'menu_icon' => 'dashicons-book',
	   'rewrite'            => array( 'slug' => '[NAME]' ),
	   'map_meta_cap'       => true,
	   'has_archive'        => false,
	   'hierarchical'       => true,
	   'menu_position'      => null,
	   'with_front'			=> false
	);

	//register_post_type('[NAME]', $args);

}
