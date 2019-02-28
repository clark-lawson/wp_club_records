<?php

/*
 * Trigger this file on Plugin uninsall
 * 
 * 
 * @package runabitfaster
 * 
*/

if ( ! defined ( 'WP_UNINSTALL_PLUGIN') ) {
    die;
}

## Clear Database stored data
## Not used as want to ensure that records are maintained
// Access the database via SQL
//global $wpdb;
//$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'club_records'");
//$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)";
//$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)";