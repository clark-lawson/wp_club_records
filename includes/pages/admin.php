<?php 
/**
 * @package  wp_club_records
 */

require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/base/base_controller.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/settings_api.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/callbacks/admin_callbacks.php';

/**
* 
*/
class Admin extends BaseController
{

	public $settings;
	public $pages = array();
	public $subpages = array();
	public $callbacks;
	

	public function register() {

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
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
				'menu_slug'  => 'club_records',
				'callback'   => array ($this->callbacks, 'adminDashboard'),
				'icon_url'   => 'dashicons-star-empty',
				'position'   => '110'
			)

		);		

	}

	public function setSubPages() {

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

    public function setSettings() {

        $args = array (

            array (
                'option_group' => 'club_records_opt_group',
                'option_name'  => 'text_example',
                'callback'     =>  array ( $this->callbacks, 'ClubRecordsOptGroup')
                )

            );

        $this->settings->setSettings( $args );

    }    

    public function setSections() {

        $args = array (

            array (
                'id'           => 'club_records_admin_index',
                'title'        => 'Settings',
                'callback'     =>  array ( $this->callbacks, 'ClubRecordsAdminSection'),
                'page'         =>  'club_records' 
                )

            );

        $this->settings->setSections( $args );

    }    

    public function setFields() {

        $args = array (

            array (
                'id'           => 'text_example',
                'title'        => 'Text Example',
                'callback'     =>  array ( $this->callbacks, 'ClubRecordsTextExample'),
                'page'         =>  'club_records' ,
				'section'      =>  'club_records_admin_index',
				'args'         => array ( 'label_for' => 'text_example', 
				                          'class' => 'example-class')
                )

            );

        $this->settings->setFields( $args );

    } 

}


