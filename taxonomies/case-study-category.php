<?php

/**
 * Registers the `case_study_category` taxonomy,
 * for use with 'case-study'.
 */
function case_study_category_init()
{
    register_taxonomy('case-study-category', array('case-study'), array(
        'hierarchical'      => false,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => true,
        'capabilities'      => array(
            'manage_terms'  => 'edit_posts',
            'edit_terms'    => 'edit_posts',
            'delete_terms'  => 'edit_posts',
            'assign_terms'  => 'edit_posts',
       ),
        'labels'            => array(
            'name'                       => __('Categories', 'case-studies'),
            'singular_name'              => _x('Categories', 'taxonomy general name', 'case-studies'),
            'search_items'               => __('Search Categories', 'case-studies'),
            'popular_items'              => __('Popular Categories', 'case-studies'),
            'all_items'                  => __('All Categories', 'case-studies'),
            'parent_item'                => __('Parent Categories', 'case-studies'),
            'parent_item_colon'          => __('Parent Categories:', 'case-studies'),
            'edit_item'                  => __('Edit Categories', 'case-studies'),
            'update_item'                => __('Update Categories', 'case-studies'),
            'view_item'                  => __('View Categories', 'case-studies'),
            'add_new_item'               => __('New Categories', 'case-studies'),
            'new_item_name'              => __('New Categories', 'case-studies'),
            'separate_items_with_commas' => __('Separate Categories with commas', 'case-studies'),
            'add_or_remove_items'        => __('Add or remove Categories', 'case-studies'),
            'choose_from_most_used'      => __('Choose from the most used Categories', 'case-studies'),
            'not_found'                  => __('No Categories found.', 'case-studies'),
            'no_terms'                   => __('No Categories', 'case-studies'),
            'menu_name'                  => __('Categories', 'case-studies'),
            'items_list_navigation'      => __('Categories list navigation', 'case-studies'),
            'items_list'                 => __('Categories list', 'case-studies'),
            'most_used'                  => _x('Most Used', 'case-study-category', 'case-studies'),
            'back_to_items'              => __('&larr; Back to Categories', 'case-studies'),
       ),
        'show_in_rest'      => true,
        'rest_base'         => 'case-study-category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    ));
}
add_action('init', 'case_study_category_init');

/**
 * Sets the post updated messages for the `case_study_category` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `case_study_category` taxonomy.
 */
function case_study_category_updated_messages($messages)
{

    $messages['case-study-category'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Categories added.', 'case-studies'),
        2 => __('Categories deleted.', 'case-studies'),
        3 => __('Categories updated.', 'case-studies'),
        4 => __('Categories not added.', 'case-studies'),
        5 => __('Categories not updated.', 'case-studies'),
        6 => __('Categories deleted.', 'case-studies'),
    );

    return $messages;
}
add_filter('term_updated_messages', 'case_study_category_updated_messages');
