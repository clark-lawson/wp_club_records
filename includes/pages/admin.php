<?php 
/**
 * @package  wp_club_records
 */

## Run the Base Controller PHP;
//require_once $this->plugin_path . 'includes/base/base_controller.php';

/**
* 
*/
class Admin extends BaseController
{
	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
    }
    
	public function add_admin_pages() {
        add_menu_page( 'Club Records', 'Records', 'manage_options', 'club_records', array ( $this, 'admin_index'), 'dashicons-star-empty', 110);	
    }
    
	public function admin_index() {
		require_once $this->plugin_path . 'includes\templates\admin.php';
	}
}


