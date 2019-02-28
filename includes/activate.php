<?php

/*
 * @package wp_club_records
 * 
*/

class WPClubRecordsActivate {
    public static function activate() {
        flush_rewrite_rules();
    }
}
