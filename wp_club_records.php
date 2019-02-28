<?php

/**
 * @package wp_club_records
 */

 /*
 Plugin Name: WP Club Records Plugin
 Plugin URI: http://runabitfaster.com
 Description: A Wordpress Plugin to manage athletic and running club records.
 Version: 1.0.0
 Author: Clark Lawson
 Author URI: http://runabitfaster.com
 License: GPLv2 or later
 Test Domain: runabitfaster
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2019 Clark Lawson

*/

# If Absolute Path not defined then exit
# This stops anything other than a website using plugin
if ( ! defined( 'ABSPATH' )) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    die;
}

# Check that wordpress initialised or exit
if ( ! function_exists( 'add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    die;
}

/*
 * The code that runs during plugin activation
*/
function activate_wp_club_records() {
  require_once plugin_dir_path( __FILE__ )  . 'includes/base/activate.php';
  activate::WPClubRecordsActivate();

}
register_activation_hook( __FILE__, 'activate_wp_club_records');

/*
 * The code that runs during plugin deactivation
*/
function deactivate_wp_club_records() {
  require_once plugin_dir_path( __FILE__ )  . 'includes/base/deactivate.php';
  deactivate::WPClubRecordsDeactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_wp_club_records');

/*
 * Initialise all the core classes of the plugin
*/
//if ( !class_exists ( 'init::init' )) {
  require_once plugin_dir_path( __FILE__ )  . 'includes/base/base_controller.php';

  require_once plugin_dir_path( __FILE__ )  . 'includes/init.php';
  init::register_services();  
//}