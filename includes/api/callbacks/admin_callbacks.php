<?php 
/**
 * @package  wp_club_records
 */

require_once plugin_dir_path( dirname( __FILE__, 3 ) )  . 'includes/base/base_controller.php';

/**
* 
*/
class AdminCallbacks extends BaseController {

    public function adminDashboard() {
        return require_once ("$this->plugin_path/includes/templates/admin.php");
    }

    public function ClubRecordsOptGroup( $input) {
        return $input;
    }

    public function ClubRecordsAdminSection( ) {
        echo 'Please check these settings to setup the types of records you wish to manage.';
    }

    public function ClubRecordsTextExample( ) {

        $value = esc_attr( get_option( 'text_example' ));
        echo '<input type="text" 
               class="regular-text" 
               name="text_example" 
               value="' . $value . '" 
               placeholder="Write Something Here!" />';
    }


}