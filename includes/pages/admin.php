<?php 
/**
 * @package  wp_club_records
 */

require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/base/base_controller.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/settings_api.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/callbacks/admin_callbacks.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/callbacks/manager_callbacks.php';
/**
* 
*/
class Admin extends BaseController
{

	public $settings;

	public $pages = array();
	public $subpages = array();

	public $callbacks;
	public $callbacks_mngr;
	

	public function register() {

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();
		$this->setPages();
		$this->setSubPages();
		$this->setSettings();
		$this->setSections();
		$this->setFields();
		$this->settings->addPages( $this->pages)->withSubPage ( 'Dashboard' )->addSubPages( $this->subpages)->register();
	}

	public function setPages() {

		$this->pages = array(
			array(
				'page_title' => 'Club Records',
				'menu_title' => 'Records',
				'capability' => 'manage_options',
				'menu_slug'  => 'wp_club_records_plugin',
				'callback'   => array ($this->callbacks, 'adminDashboard'),
				'icon_url'   => 'dashicons-star-empty',
				'position'   => '110'
			)

		);		

	}

	public function setSubPages() {

		$this->subpages = array (
			array(
				'parent_slug' => 'wp_club_records_plugin',
				'page_title' =>  'Custom Post Types',
				'menu_title' =>  'CPT',
				'capability' =>  'manage_options',
				'menu_slug'  =>  'club_records_cbt',
				'callback'   =>  function() { echo '<h1>CPT Manager</h1>'; }
			),
			array(
				'parent_slug' => 'wp_club_records_plugin',
				'page_title' =>  'Custom Post Types1',
				'menu_title' =>  'CPT1',
				'capability' =>  'manage_options',
				'menu_slug'  =>  'club_records_cbt1',
				'callback'   =>  function() { echo '<h1>CPT Manager1</h1>'; }
			)
		  );


	}

    public function setSettings() {

		$args = array(

			array (
				'option_group' => 'wp_club_records_plugin_settings',
				'option_name' => 'wp_club_records_plugin', /* Match slug */
				'callback' => array ( $this->callbacks_mngr, 'checkboxSantise')
			)

		);

        $this->settings->setSettings( $args );

    }    

    public function setSections() {

        $args = array (

            array (
                'id'           => 'wp_club_records_admin_index',
                'title'        => 'Records Manager',
                'callback'     =>  array ( $this->callbacks_mngr, 'recordSectionManager'),
                'page'         =>  'wp_club_records_plugin' 
                )

            );

        $this->settings->setSections( $args );

    }    

    public function setFields() {

		$args = array();

		foreach ( $this->managers as $key => $value) {
	
			// This injects into existing array;
			$args[] = array (
					'id'           => $key,
					'title'        => $value,
					'callback'     =>  array ( $this->callbacks_mngr, 'checkboxField'),
					'page'         =>  'wp_club_records_plugin' ,
					'section'      =>  'wp_club_records_admin_index',
					'args'         => array ( 
						                     'option_name' => 'wp_club_records_plugin',
						                     'label_for' => $key,
											 'class' => 'ui-toggle')			

			);
	
		};

        $this->settings->setFields( $args );

    } 

}


