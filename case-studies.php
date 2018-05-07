<?php
// phpcs:disable PSR1.Files.SideEffects
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

namespace App\Plugins;

class PvtlCaseStudies
{
    // The name of the plugin (for cosmetic purposes)
    protected $pluginName = 'Case Studies';

    // The post type's slug eg. case-study
    protected $postType = 'case-study';

    // The assets (css/js) to be copied from the plugin to the theme
    protected $frontendAssets = array(
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

    public function __construct()
    {
        // Setup the custom post type, tax and add fields
        include(dirname(__FILE__). '/post-types/' . $this->postType . '.php');
        include(dirname(__FILE__). '/taxonomies/' . $this->postType . '-category.php');
        include(dirname(__FILE__). '/custom-fields/' . $this->postType . '.php');

        // Call the actions/hooks
        add_action('admin_notices', array($this, 'acfNotInstalledAdminError'));
        add_filter('template_include', array($this, 'fronendTemplates'));
        register_activation_hook(__FILE__, array($this, 'onActivate'));
    }

    /**
     * Display Error in Admin when is not installed
     *
     * @return void
     */
    public function acfNotInstalledAdminError()
    {
        if (!function_exists('the_field')) {
            $class = 'notice notice-error';
            $message = 'Please install <a target="_blank"
                href="https://github.com/wp-premium/advanced-custom-fields-pro">
                Advanced Custom Fields Pro</a> for the ' . $this->pluginName . ' plugin to
                work correctly.';

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
        }
    }

    /**
     * Display front-end templates
     *
     * @param str $template
     * @return void
     */
    public function fronendTemplates($template)
    {
        // When an archive - try the theme version otherwise use the default plugin version
        if (is_archive($this->postType)
            && $template !== locate_template(array('archive-' . $this->postType . '.php'))) {
            return plugin_dir_path(__FILE__) .'resources/views/archive.php';
        }

        // When a single - try the theme version otherwise use the default plugin version
        if (is_singular($this->postType)
            && $template !== locate_template(array('single-' . $this->postType . '.php'))) {
            return plugin_dir_path(__FILE__) .'resources/views/single.php';
        }

        return $template;
    }

    /**
     * On Plugin Activate, copy over front-end assets
     *
     * @return void
     */
    public function onActivate()
    {
        $themeAssetDir = get_template_directory() . '/src/assets/';
        $pluginAssetDir = plugin_dir_path(__FILE__) . 'resources/assets/';

        // Only continue if the PVTL theme directory exists
        if (file_exists($themeAssetDir)) {
            // For each file to copy across
            foreach ((array)$this->frontendAssets as $file) {
                // Ignore if the file already exists
                if (file_exists($themeAssetDir . $file['to'] . $file['name'])) {
                    continue;
                }

                // Ensure the directory exists
                mkdir($themeAssetDir . $file['to'], 0755, true);

                // Copy that file
                if (!@copy(
                    $pluginAssetDir . $file['from'] . $file['name'],
                    $themeAssetDir . $file['to'] . $file['name']
                )) {
                    // Print any errors to the admin panel
                    print_r(error_get_last());
                    die();
                }
            }
        }
    }
}

if (!defined('ABSPATH')) {
    exit;  // Exit if accessed directly
}

$pvtlCaseStudies = new PvtlCaseStudies();
