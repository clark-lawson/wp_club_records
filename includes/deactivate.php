<?php

/*
 * @package wp_club_records
 * 
*/

class WPClubRecordsDeactivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
