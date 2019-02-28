<?php
/**
 * @package  wp_club_records
 */

## Run the Base Controller PHP;
//require_once $this->plugin_path . 'includes/base/base_controller.php';

class SettingsLinks extends BaseController
{
	public function register() 
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}
	public function settings_link( $links ) 
	{
		$settings_link = '<a href="admin.php?page=club_records">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}