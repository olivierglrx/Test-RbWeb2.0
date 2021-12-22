<?php


// 1 // REGISTER PUBLICATION CUSTOM POST TYPE
function cptui_register_my_cpts_publication() {

	/**
	 * Post Type: Publications.
	 */

	$labels = [
		"name" => __( "Publications", "custom-post-type-ui" ),
		"singular_name" => __( "Publication", "custom-post-type-ui" ),
		"menu_name" => __( "Publications", "custom-post-type-ui" ),
		"all_items" => __( "Publications list", "custom-post-type-ui" ),
		"add_new" => __( "Add new publication", "custom-post-type-ui" ),
		"add_new_item" => __( "New Publication", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Publication", "custom-post-type-ui" ),
		"new_item" => __( "New Publication", "custom-post-type-ui" ),
		"view_item" => __( "View Publication", "custom-post-type-ui" ),
		"view_items" => __( "View Publications", "custom-post-type-ui" ),
		"search_items" => __( "Search Publications", "custom-post-type-ui" ),
		"not_found" => __( "No Publications found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Publications found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Publication:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Publication", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Publication", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Publication", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Publication", "custom-post-type-ui" ),
		"archives" => __( "Publication archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Publication", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Publication", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Publications list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Publications list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Publications list", "custom-post-type-ui" ),
		"attributes" => __( "Publications attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Publication", "custom-post-type-ui" ),
		"item_published" => __( "Publication published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Publication published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Publication reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Publication scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Publication updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Publication:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "publication", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "Scientific publications",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
    // 'capabilities' => array(
  //   'create_posts' => 'do_not_allow', // Removes support for the "Add New" function ( use 'do_not_allow' instead of false for multisite set ups )
  // ),
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "publications", "with_front" => false ],
		"query_var" => true,
		// "menu_position" => 10,
		"menu_icon" => "dashicons-welcome-learn-more",
		"supports" => [  "thumbnail" ],
   		 "menu_position" => 4
	];

	register_post_type( "publication", $args );
}
add_action( 'init', 'cptui_register_my_cpts_publication' );
