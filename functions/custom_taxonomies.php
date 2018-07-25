<?php
/**
 * Register custom taxonomies
 *
 * @since FTC 1.0
 * @return void
 */


function custom_taxonomy() {

	/*Simply duplicate the below block, replacing '[NAME]'
	with the name of the taxonomy you want to make.
	Then uncomment register_taxonomy call. */

	$labels = array(
		'name'              => _x( '[NAME]', 'taxonomy general name' ),
		'singular_name'     => _x( '[NAME]', 'taxonomy singular name' ),
		'search_items'      => __( 'Search [NAME]s' ),
		'all_items'         => __( 'All [NAME]s' ),
		'parent_item'       => __( 'Parent [NAME]' ),
		'parent_item_colon' => __( 'Parent [NAME]:' ),
		'edit_item'         => __( 'Edit [NAME]' ),
		'update_item'       => __( 'Update [NAME]' ),
		'add_new_item'      => __( 'Add New [NAME]' ),
		'new_item_name'     => __( 'New [NAME] Name' ),
		'menu_name'         => __( '[NAME]s' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	//register_taxonomy('[NAME]', $args);

}
