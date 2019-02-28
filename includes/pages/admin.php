<?php 
/**
 * @package  wp_club_records
 */

require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/base/base_controller.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/settings_api.php';

/**
* 
*/
class Admin extends BaseController
{

	public $settings;
	public $pages = array();
	public $subpages = array();

	public function __construct() {
		$this->settings = new SettingsApi();

		$this->pages = array(
			array(
				'page_title' => 'Club Records',
				'menu_title' => 'Records',
				'capability' => 'manage_options',
				'menu_slug'  => 'club_records',
				'callback'   => function() { echo '<h1>Club Records Plugin</h1>'; },
				'icon_url'   => 'dashicons-star-empty',
				'position'   => '110'
			)

		);

		$this->subpages = array (
			array(
				'parent_slug' => 'club_records',
				'page_title' => 'Custom Post Types',
				'menu_title' =>  'CPT',
				'capability' =>  'manage_options',
				'menu_slug'  =>  'club_records_cbt',
				'callback'   =>  function() { echo '<h1>CPT Manager</h1>'; }
			),
			array(
				'parent_slug' => 'club_records',
				'page_title' => 'Custom Post Types1',
				'menu_title' =>  'CPT1',
				'capability' =>  'manage_options',
				'menu_slug'  =>  'club_records_cbt1',
				'callback'   =>  function() { echo '<h1>CPT Manager1</h1>'; }
			)
		  );

	}

	public function register() {
		$this->settings->addPages( $this->pages)->withSubPage ( 'Dashboard' )->addSubPages( $this->subpages)->register();
	}
}


