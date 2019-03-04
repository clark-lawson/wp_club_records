<?php 
/**
 * @package  wp_club_records
 */

require_once plugin_dir_path( dirname( __FILE__, 3 ) )  . 'includes/base/base_controller.php';

/**
* 
*/
class ManagerCallbacks extends BaseController {

    public function checkboxSantise( $input ) {

        $output = array();
        
        foreach ($this->managers as $key => $value) {
            $output[$key] = ( isset( $input[$key] ) && $input[$key] == 1 ) ? true : false;
        }

        return $output;

    }

    public function recordSectionManager() {

        echo 'Manage the features of this plugin by activating the checkboxes from the following list.';

    }

    public function checkboxField( $args ) {

        $name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );
		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checkbox[$name] ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
    }

}