<?php
/**
 * @package   Schrapel\CMB2Loader
 * @author    Toby Schrapel <toby@tobyschrapel.com>
 * @license   MIT
 * @link      https://tobyschrapel.com/
 * @copyright 2017 Toby Schrapel
 *
 * @wordpress-plugin
 * Plugin Name:        CMB2: Loader
 * Plugin URI:         https://www.github.com/schrapel/cmb2-loader
 * Description:        Autoload your CMB2 metaboxes and fields using JSON, YAML or PHP files
 * Version:            0.0.1
 * Author:             Toby Schrapel
 * Author URI:         https://tobyschrapel.com/
 * Text Domain:        cmb2-loader
 * Domain Path:        /languages
 * License:            MIT
 * License URI:        http://opensource.org/licenses/MIT
 * GitHub Plugin URI:  schrapel/cmb2-loader
 * GitHub Branch:      master
 */


namespace Schrapel\CMB2Loader;

use Schrapel\CMB2Loader\Loader;

if (!defined('ABSPATH')) {
    die;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

add_action('cmb2_admin_init', function () {
    $loader = new Loader();
    $loader->load();
});
