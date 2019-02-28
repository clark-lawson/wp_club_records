<?php

/*
 * @package runabitfaster
 * 
*/

class runabitfasterActivate {
    public static function activate() {
        flush_rewrite_rules();
    }
}
