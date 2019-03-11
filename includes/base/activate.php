<?php
/**
 * @package  wp_club_records
 */

class Activate
{
	public static function WPClubRecordsActivate() {
		flush_rewrite_rules();

	if ( get_option( 'wp_club_records_plugin' ) ) {
			return; // exit if option exists
	}

	// otherwise, create empty option
	$default = array();
	update_option( 'wp_club_records_plugin', $default );

	}

}