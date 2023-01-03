<?php
/**
 * Register Team menu in admin area.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Add Teams Menu to Admin
---------------------------------------------------------------------------------- */
function thinkup_register_teampost() {
	$labels = array(
		'name'               => _x( 'Team', 'post type general name', 'consulting' ),
		'singular_name'      => _x( 'Team', 'post type singular name', 'consulting' ),
		'add_new'            => _x( 'Add New', 'team', 'consulting' ),
		'add_new_item'       => __( 'Add New Team', 'consulting' ),
		'edit_item'          => __( 'Edit Team', 'consulting' ),
		'new_item'           => __( 'New Team', 'consulting' ),
		'view_item'          => __( 'View Team', 'consulting' ),
		'search_items'       => __( 'Search Teams', 'consulting' ),
		'not_found'          =>  __( 'No teams found', 'consulting' ),
		'not_found_in_trash' => __( 'No teams found in Trash', 'consulting' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Teams', 'consulting' ),
	);
	  
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'menu_icon'          => 'dashicons-groups'
	);

	/* Register Team menu */
	register_post_type( 'team', $args );


	/* Fixes redirect to 404 error template */
	flush_rewrite_rules();
	  
	/* Initialise New Taxonomy Labels */
	$labels = array(
		'name'              => _x( 'Tags', 'taxonomy general name', 'consulting' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'consulting' ),
		'search_items'      => __( 'Search Types', 'consulting' ),
		'all_items'         => __( 'All Tags', 'consulting' ),
		'parent_item'       => __( 'Parent Tag', 'consulting' ),
		'parent_item_colon' => __( 'Parent Tag:', 'consulting' ),
		'edit_item'         => __( 'Edit Tags', 'consulting' ),
		'update_item'       => __( 'Update Tag', 'consulting' ),
		'add_new_item'      => __( 'Add New Tag', 'consulting' ),
		'new_item_name'     => __( 'New Tag Name', 'consulting' ),
	);

	/*  Register custom taxonomy for Team tags */
	register_taxonomy( 'team_tag', array( 'team' ), array(
		'hierarchical' => true,
		'labels'       => $labels,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'tag-team' ),
	));
	  
}
add_action('init', 'thinkup_register_teampost');
	

/* ----------------------------------------------------------------------------------
	Custom Team Messages
---------------------------------------------------------------------------------- */
function thinkup_register_teammessages( $messages ) {
global $post, $post_ID;

	$messages[ 'team' ] = array(
		0 => '',
		1 => sprintf( 'Team updated. <a href="%s">View team</a>', esc_url( get_permalink( $post_ID ) ) ),
		2 => 'Custom field updated.',
		3 => 'Custom field deleted.',
		4 => 'Team updated.',
		5 => isset($_GET[ 'revision' ]) ? sprintf( 'Team restored to revision from %s', wp_post_revision_title( (int) 

$_GET[ 'revision' ], false ) ) : false,
		6 => sprintf( 'Team published. <a href="%s">View team</a>', esc_url( get_permalink( $post_ID ) ) ),
		7 => 'Team saved.',
		8 => sprintf( 'Team submitted. <a target="_blank" href="%s">Preview team</a>', esc_url( add_query_arg( 'preview', 

'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( 'Team scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview team</a>',
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( 'Team draft updated. <a target="_blank" href="%s">Preview team</a>', esc_url( add_query_arg( 'preview', 

'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'thinkup_register_teammessages' );