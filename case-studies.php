<?php
/**
 * Plugin Name:     Case Studies by Pivotal
 * Plugin URI:      https://github.com/pvtl/wp-case-studies.git
 * Description:     Adds a case studies custom post type, taxonomy and fields
 * Author:          Pivotal Agency
 * Author URI:      http://pivotal.agency
 * Text Domain:     case-studies
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Case_Studies
 */

/**
 * Setup the custom post type, tax and add fields
 */
include(dirname(__FILE__). '/post-types/case-study.php');
include(dirname(__FILE__). '/taxonomies/case-study-category.php');
include(dirname(__FILE__). '/custom-fields/case-study.php');

/**
 * Show admin error if ACF is not installed
 */
if (!function_exists('the_field')) {
    if (!function_exists('acf_not_installed_admin_notice__error')) {
        function acf_not_installed_admin_notice__error()
        {
            $class = 'notice notice-error';
            $message = __('Please install Advanced Custom Fields Pro for your plugins to work correctly.', 'case-studies-text-domain');
            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        }

        add_action('admin_notices', 'acf_not_installed_admin_notice__error');
    }
}

/**
 * Front-end templates
 */
function case_studies_templates($template)
{
    if (is_archive('case-study') && $template !== locate_template(array("archive-case-study.php"))) {
        return plugin_dir_path(__FILE__) .'resources/views/archive.php';
    }
    if (is_singular('case-study') && $template !== locate_template(array("single-case-study.php"))) {
        return plugin_dir_path(__FILE__) .'resources/views/single.php';
    }

    return $template;
}

add_filter('template_include', 'case_studies_templates');

/**
 * On Install - copy over the assets
 */
function case_studies_activate() {
    $to_copy = array(
        array(
            'from' => 'js/',
            'to' => 'js/plugins/',
            'name' => 'case-studies.js',
        ),
        array(
            'from' => 'scss/',
            'to' => 'scss/plugins/',
            'name' => '_case-studies.scss',
        ),
    );
    $theme_asset_dir = get_template_directory() . '/src/assets/';
    $plugin_asset_dir = plugin_dir_path(__FILE__) . 'resources/assets/';
    // Only continue if the PVTL theme directory exists
    if (file_exists($theme_asset_dir)) {
        // For each file to copy across
        foreach ($to_copy as $file) {
            // Ignore if the file already exists
            if (file_exists($theme_asset_dir . $file['to'] . $file['name'])) {
                continue;
            }

            // Ensure the directory exists
            mkdir($theme_asset_dir . $file['to'], 0755, true);

            // Copy that file
            if(
                !@copy(
                    $plugin_asset_dir . $file['from'] . $file['name'],
                    $theme_asset_dir . $file['to'] . $file['name']
                )
            ) {
                print_r(error_get_last());
                die();
            }
        }
    }
}

register_activation_hook(__FILE__, 'case_studies_activate');
