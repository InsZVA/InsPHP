<?php
    /*  Session Class Produce Session Interfaces    */
    class Session
    {
        public function __construct()
        {
        }
        
        public static function get($string)
        {
            error_reporting(1);
            if(!isset($_SESSION[$string]))return "";
            return $_SESSION[$string];
        }
    
        public static function set($key,$value)
        {
            $_SESSION[$key] = $value;
        }
    }
    