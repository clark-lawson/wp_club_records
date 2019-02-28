<?php 
/**
 * @package  wp_club_records
 */


## Run the Base Controller PHP;
//require_once $this->plugin_path . 'includes/base/base_controller.php';

//use \Inc\Base\BaseController;
/**
* 
*/
class WPClubRecordsEnqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/style.css' );
		#wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/script.js' );
	}
}