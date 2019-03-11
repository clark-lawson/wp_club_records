<?php 
/**
 * @package  wp_club_records
 */

require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/settings_api.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/base/base_controller.php';
require_once plugin_dir_path( dirname( __FILE__, 2 ) )  . 'includes/api/callbacks/admin_callbacks.php';

/**
* 
*/
class RoadRecordsController extends BaseController
{

    public $callbacks;
    public $subpages = array();
    public $subpage_list = array();
    
    public function register() {
    
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->setSubPages();
        
        // Only register subpages if they are switched on;
        if ( ! empty( $this->subpages ) ) {
            
            $this->settings->addSubPages( $this->subpages )->register();
        }

        add_action ( 'init' , array ($this, 'activate') );

    }

    public function setSubPages () {

        $this->subpage_list = array (
			array(
				'parent_slug' => 'wp_club_records_plugin',
				'page_title' =>  'Road Records',
				'menu_title' =>  'Road Records',
				'capability' =>  'manage_options',
				'menu_slug'  =>  'club_records_road',
				'callback'   =>  function() { echo '<h1>WP Club Records - Road</h1>'; }
			)
          );

        foreach( $this->subpage_list as $subpage ) {

            $title = $subpage['menu_title'];
            $title = str_replace(' ', '_', $title); // Swap Space to underscore to match option
            $option = get_option( 'wp_club_records_plugin');
            $activated = isset ( $option[$title]) ? $option[$title] : false ;

            if ( $activated ) {
                $this->subpages = array_merge ( $this->subpages, $subpage );
            }

        }

    }
    public function activate() {

        register_post_type ('wp_club_records',
            array (
                  'labels' => array (
                          'name' => 'Records',
                          'singular_name' => 'Record'
                  ),
                  'public' => true,
                  'has_archive' =>true,
            )
        );
    }

}