<?php 
/**
 * @package  wp_club_records
 */



/**
* 
*/
class SettingsApi {

    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();

    public function register() {

        if ( ! empty($this->admin_pages) || ! empty($this->admin_subpages) ) {
            add_action( 'admin_menu', array ($this, 'addAdminMenu' ) );
        }

        if ( ! empty ($this->settings)) {
            add_action( 'admin_init', array( $this, 'registerCustomFields' ) );
        }
    }
    public function addPages (array $pages) {

        $this->admin_pages = $pages;

        // Return this instance of this class at the end of this method
        // for method chaining
        return $this;
    }

    public function withSubPage( string $title = null) {
      if ( empty( $this->admin_pages) ) {
        return $this; // return stops processing;
      }

      $admin_page = $this->admin_pages[0];
      $subpage = array (
        array(
            'parent_slug' => $admin_page['menu_slug'],
            'page_title' =>  $admin_page['page_title'],
            'menu_title' =>  ($title) ? $title : $admin_page['menu_title'],
            'capability' =>  $admin_page['capability'],
            'menu_slug'  =>  $admin_page['menu_slug'],
            'callback'   =>  $admin_page['callback']
        )
      );

      $this->admin_subpages = $subpage;

      return $this;

    }

    public function addSubPages (array $pages ) {
        $this->admin_subpages = array_merge($this->admin_subpages ,array($pages));
        return $this;
    }

    public function addAdminMenu () {

        foreach ($this->admin_pages as $page ) {
            add_menu_page( $page['page_title'], 
                           $page['menu_title'], 
                           $page['capability'],
                           $page['menu_slug'],
                           $page['callback'],
                           $page['icon_url'],
                           $page['position']
                           );
        }

        foreach ($this->admin_subpages as $page ) {

            $parent = $page['parent_slug'];
            $page_title = $page['page_title'];
            $menu_title = $page['menu_title'];
            $capability = $page['capability'];
            $menu_slug = $page['menu_slug'];
            $callback = $page['callback'];
            
            add_submenu_page( 
                           $parent, 
                           $page_title, 
                           $menu_title, 
                           $capability,
                           $menu_slug,
                           $callback
                           );
        }

    }

    public function setSettings (array $settings) {

        $this->settings = $settings;

        // Return this instance of this class at the end of this method
        // for method chaining
        return $this;
    }

    public function setSections (array $sections) {

        $this->sections = $sections;

        // Return this instance of this class at the end of this method
        // for method chaining
        return $this;
    }

    public function setFields (array $fields) {

        $this->fields = $fields;

        // Return this instance of this class at the end of this method
        // for method chaining
        return $this;
    }

    public function registerCustomFields() {

        // Register setting, dont put callback if not set in array
        foreach ($this->settings as $setting ) {
            register_setting($setting["option_group"], 
                            $setting["option_name"], 
                            ( isset( $setting["callback"] ) ? $setting["callback"] : '' ) 
                            );
        }

        // Add settings section
        foreach ($this->sections as $section ) {        
            add_settings_section($section["id"], 
                                $section["title"], 
                                ( isset( $section["callback"] ) ? $section["callback"] : '' ),
                                $section["page"] 
                                );
        }

        // Add settings field
        foreach ($this->fields as $field ) {
            add_settings_field($field["id"], 
                            $field["title"], 
                            ( isset( $field["callback"] ) ? $field["callback"] : '' ), 
                            $field["page"], $field["section"], 
                            ( isset( $field["args"] ) ? $field["args"] : '' )
                            );
        }
    }





}