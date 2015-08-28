<?php
    /*  Cookie Class Produce Cookie Interfaces    */
    class Cookie
    {
        public function __construct()
        {
        }
        
        public static function get($string)
        {
            error_reporting(1);
            if(!isset($_COOKIE[$string]))return "";
            return $_COOKIE[$string];
        }
    
        public static function set($key,$value)
        {
            $_COOKIE[$key] = $value;
        }
    }
    