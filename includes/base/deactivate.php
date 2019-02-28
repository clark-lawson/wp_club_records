<?php
/**
 * @package  wp_club_records
 */

class Deactivate
{
	public static function WPClubRecordsDeactivate() {
		flush_rewrite_rules();
	}
}