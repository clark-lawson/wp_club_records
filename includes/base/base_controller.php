<?php 
/**
 * @package  wp_club_records
 */

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;
	public $managers = array ();

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/wp_club_records.php';

		$this->managers = array (
			'Road_Records' => 'Activate Road Records',
		    'Track_Records' => 'Activate Track Records',
			'Field_Records' => 'Activate Fields Records'
		);

	}
}