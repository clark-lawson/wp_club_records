<?php

/**
 * @package runabitfaster
 */

 /*
 Plugin Name: runabitfaster Plugin
 Plugin URI: http://runabitfaster.com
 Description: This is my first attempt on writing a custom plugin for wordpress.
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

# Check if the class exists, then initialise
if ( !class_exists( 'runabitfaster' )) {

  # Create PHP Class
  class runabitfaster {

    public $plugin;

    function __construct() {
      $this->plugin = plugin_basename( __FILE__ );
    }

    function register () {

      # Enqueue Scripts;
      add_action( 'admin_enqueue_scripts', array ($this, 'enqueue')); # Replace wp/admin to make available in front/back

      # Add Admin Menu Button;
      add_action( 'admin_menu' , array ( $this, 'add_admin_pages'));

      # Add Filter to Add Settings options on plugin;
      add_filter ( "plugin_action_links_$this->plugin", array ( $this, 'settings_link') );

    }

    public function settings_link ($links) {
      // add customer settings link
      $settings_link = '<a href="admin.php?page=club_records">Settings</a>';
      array_push ( $links, $settings_link );
      return $links;
    }

    public function add_admin_pages() {
      add_menu_page( 'Club Records', 'Records', 'manage_options', 'club_records', array ( $this, 'admin_index'), 'dashicons-star-empty', 110);
    }

    public function admin_index() {
      require_once plugin_dir_path( __FILE__) . 'includes/templates/admin.php';
    }

    protected function custom_post_type() {
      register_post_type('club_records', ['public' => true, 'label' => 'Records']);
    }

    function enqueue() {
      wp_enqueue_style('club_records_style', plugins_url( '/assets/style.css', __FILE__) );
      // use wp_enqueue_script() for .js files
    }

    function activate() {
      require_once plugin_dir_path( __FILE__) . 'includes/activate.php';
      runabitfasterActivate::activate();
    }

  }

  # Initialising the Class
  $runabitfaster = new runabitfaster();
  $runabitfaster->register(); # Trigger Register Method within this variable;

  # Activation: Run within this file, calling the function within the class
  register_activation_hook( __FILE__, array( $runabitfaster, 'activate' ) );

  # Decativation
  require_once plugin_dir_path( __FILE__) . 'includes/deactivate.php';
  register_activation_hook( __FILE__, array( 'runabitfasterDeactivate', 'deactivate' ) );

}