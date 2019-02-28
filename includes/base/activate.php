<?php
/**
 * @package  wp_club_records
 */

class Activate
{
	public static function WPClubRecordsActivate() {
		flush_rewrite_rules();
	}
}