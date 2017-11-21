<?php

use Permmerce\PluginBoilerNew\PluginBoilerNewPlugin;
use Permmerce\PluginBoilerNew\FileManager;

/**
 * premmerce-palinchak-first-pluginBoilerNew plugin
 *
 *
 * @link              http://premmerce.com
 * @since             1.0.0
 * @package           Permmerce\PluginBoilerNew
 *
 * @wordpress-plugin
 * Plugin Name:       premmerce-palinchak-first-pluginBoilerNew
 * Plugin URI:        http://premmerce.com
 * Description:       tra-ta-ta
 * Version:           1.0
 * Author:            plinchak1
 * Author URI:        http://premmerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       premmerce-palinchak-first-plugin-BoilerNew
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

call_user_func(function () {

    require_once plugin_dir_path(__FILE__) . 'autoload.php';

    $main = new PluginBoilerNewPlugin(new FileManager(__FILE__));

    register_activation_hook(__FILE__, [$main, 'activate']);

    register_deactivation_hook(__FILE__, [$main, 'deactivate']);

    register_uninstall_hook(__FILE__, [PluginBoilerNewPlugin::class, 'uninstall']);

    $main->run();
});