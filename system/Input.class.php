<?php
    /*  Input Class Produce Interface For GET&POST  */
    class Input
    {
        public function __construct()
        {
        }
        
        /*  Get Function Produce Interface For HTTPGET
            Param:  String To Get From $_GET
                    Type:A Filter To Avoid Some Attack
                        raw:   No Filter
                        int,integer:    Only Accept Integer
                        text:   Convert HTML Special Chars To Real
                        nospace:    Remove Any Space Char(space,tab,nextline,...)
                        nosql:  Convert SQL Special Chars(\x00,\n,\r,\,',",\x1a)
                    Length:Limit The Length Of Input(For Number,The Super Limit,eg,100<300(Length))
                            0 Stands For No Limit
        */
        public static function get($string,$type = 'raw',$length = 0)
        {
            error_reporting(1);
            if(!isset($_GET[$string]))InsPHP::errorReport("Input-Get: '$string' was not found in ".'$_GET[]',__CLASS__,__FUNCTION__,__FILE__);
            switch($type)
            {
                case 'int':
                case 'integer':
                    $int = intval($_GET[$string]);
                    if($length && $int > $length)$int = $length;
                    return $int;
                case 'text':
                    $str = htmlspecialchars($_GET[$string]);
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
                case 'nospace':
                    $str = $_GET[$string];
                    $str = str_replace(" ","",$str);
                    $str = str_replace("\n","",$str);
                    $str = str_replace("\t","",$str);
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
                case 'nosql':
                    $str = $_GET[$string];
                    $str = str_replace("\x00","",$str);
                    $str = str_replace("\n","",$str);
                    $str = str_replace("\r","",$str);
                    $str = str_replace("\\","",$str);
                    $str = str_replace("'","\\'",$str);
                    $str = str_replace("\"","\\\"",$str);
                    $str = str_replace("\x1a","",$str);
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
                case 'raw':
                    $str = $_GET[$string];
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
            }
        }
        /*  POST Function Produce Interface For HTTPGET
            Param:  String To Get From $_GET
                    Type:A Filter To Avoid Some Attack
                        raw:   No Filter
                        int,integer:    Only Accept Integer
                        text:   Convert HTML Special Chars To Real
                        nospace:    Remove Any Space Char(space,tab,nextline,...)
                        nosql:  Convert SQL Special Chars(\x00,\n,\r,\,',",\x1a)
                    Length:Limit The Length Of Input(For Number,The Super Limit,eg,100<300(Length))
                            0 Stands For No Limit
        */
        public static function post($string,$type = 'raw',$length = 0)
        {
            switch($type)
            {
                case 'int':
                case 'integer':
                    $int = intval($_POST[$string]);
                    if($length && $int > $length)$int = $length;
                    return $int;
                case 'text':
                    $str = htmlspecialchars($_POST[$string]);
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
                case 'nospace':
                    $str = $_POST[$string];
                    $str = str_replace(" ","",$str);
                    $str = str_replace("\n","",$str);
                    $str = str_replace("\t","",$str);
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
                case 'nosql':
                    $str = $_POST[$string];
                    $str = str_replace("\x00","",$str);
                    $str = str_replace("\n","",$str);
                    $str = str_replace("\r","",$str);
                    $str = str_replace("\\","",$str);
                    $str = str_replace("'","\\'",$str);
                    $str = str_replace("\"","\\\"",$str);
                    $str = str_replace("\x1a","",$str);
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
                case 'raw':
                    $str = $_POST[$string];
                    if($length && strlen($str) > $length)$str = substr($str,0,$length);
                    return $str;
            }
        }
    }
    
                    