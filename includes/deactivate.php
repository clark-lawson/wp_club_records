<?php

/*
 * @package runabitfaster
 * 
*/

class runabitfasterDeactivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
