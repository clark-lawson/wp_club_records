<?php
/**
 * @package  wp_club_records
 */

final class Init extends BaseController
{
    /*
     * Require once the base controller
    */

	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function register_services() 
	{

       ## For all services needed, we need a require once
       ## Then initiliase the class
       ## Run the register method if there is one within the class

       require_once plugin_dir_path( dirname( __FILE__, 1 ) ) . 'includes/pages/admin.php';
       $adminservice = new admin();
       if ( method_exists( $adminservice, 'register' ) ) {
          $adminservice->register();
       }

       require_once plugin_dir_path( dirname( __FILE__, 1 ) )  . 'includes/base/enqueue.php';
       $enqueueservice = new WPClubRecordsEnqueue();
       if ( method_exists( $enqueueservice, 'register' ) ) {
          $enqueueservice->register();
       }       

       require_once plugin_dir_path( dirname( __FILE__, 1 ) )  . 'includes/base/settings_links.php';
       $settingslnkservice = new SettingsLinks();
       if ( method_exists( $settingslnkservice, 'register' ) ) {
          $settingslnkservice->register();
       }

       require_once plugin_dir_path( dirname( __FILE__, 1 ) )  . 'includes/base/road_records_controller.php';
       $RoadRecordsController = new RoadRecordsController();
       if ( method_exists( $RoadRecordsController, 'register' ) ) {
          $RoadRecordsController->register();
       }

       require_once plugin_dir_path( dirname( __FILE__, 1 ) )  . 'includes/base/track_records_controller.php';
       $TrackRecordsController = new TrackRecordsController();
       if ( method_exists( $TrackRecordsController, 'register' ) ) {
          $TrackRecordsController->register();
       }

       require_once plugin_dir_path( dirname( __FILE__, 1 ) )  . 'includes/base/field_records_controller.php';
       $FieldRecordsController = new FieldRecordsController();
       if ( method_exists( $FieldRecordsController, 'register' ) ) {
          $FieldRecordsController->register();
       }


    }

}