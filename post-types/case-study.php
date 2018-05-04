<?php

/**
 * Registers the `case_study` post type.
 */
function case_study_init() {
	register_post_type( 'case-study', array(
		'labels'                => array(
			'name'                  => __( 'Case Studies', 'case-studies' ),
			'singular_name'         => __( 'Case Studies', 'case-studies' ),
			'all_items'             => __( 'All Case Studies', 'case-studies' ),
			'archives'              => __( 'Case Studies Archives', 'case-studies' ),
			'attributes'            => __( 'Case Studies Attributes', 'case-studies' ),
			'insert_into_item'      => __( 'Insert into Case Studies', 'case-studies' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Case Studies', 'case-studies' ),
			'featured_image'        => _x( 'Featured Image', 'case-study', 'case-studies' ),
			'set_featured_image'    => _x( 'Set featured image', 'case-study', 'case-studies' ),
			'remove_featured_image' => _x( 'Remove featured image', 'case-study', 'case-studies' ),
			'use_featured_image'    => _x( 'Use as featured image', 'case-study', 'case-studies' ),
			'filter_items_list'     => __( 'Filter Case Studies list', 'case-studies' ),
			'items_list_navigation' => __( 'Case Studies list navigation', 'case-studies' ),
			'items_list'            => __( 'Case Studies list', 'case-studies' ),
			'new_item'              => __( 'New Case Studies', 'case-studies' ),
			'add_new'               => __( 'Add New', 'case-studies' ),
			'add_new_item'          => __( 'Add New Case Studies', 'case-studies' ),
			'edit_item'             => __( 'Edit Case Studies', 'case-studies' ),
			'view_item'             => __( 'View Case Studies', 'case-studies' ),
			'view_items'            => __( 'View Case Studies', 'case-studies' ),
			'search_items'          => __( 'Search Case Studies', 'case-studies' ),
			'not_found'             => __( 'No Case Studies found', 'case-studies' ),
			'not_found_in_trash'    => __( 'No Case Studies found in trash', 'case-studies' ),
			'parent_item_colon'     => __( 'Parent Case Studies:', 'case-studies' ),
			'menu_name'             => __( 'Case Studies', 'case-studies' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'case-study',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'case_study_init' );

/**
 * Sets the post updated messages for the `case_study` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `case_study` post type.
 */
function case_study_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['case-study'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Case Studies updated. <a target="_blank" href="%s">View Case Studies</a>', 'case-studies' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'case-studies' ),
		3  => __( 'Custom field deleted.', 'case-studies' ),
		4  => __( 'Case Studies updated.', 'case-studies' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Case Studies restored to revision from %s', 'case-studies' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Case Studies published. <a href="%s">View Case Studies</a>', 'case-studies' ), esc_url( $permalink ) ),
		7  => __( 'Case Studies saved.', 'case-studies' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Case Studies submitted. <a target="_blank" href="%s">Preview Case Studies</a>', 'case-studies' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Case Studies scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Case Studies</a>', 'case-studies' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Case Studies draft updated. <a target="_blank" href="%s">Preview Case Studies</a>', 'case-studies' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'case_study_updated_messages' );
