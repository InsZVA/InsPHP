<?php
    session_start();
    
    class InsPHP
    {
        public function __construct()
        {
        }
        
        public static function getRoot()
        {
            return dirname(__FILE__);
        } 
        
        public static function getApp()
        {
            return Cookie::get("App");
        }
        /*  Error Report Function - Report PHP Error
            Param:  ErrorInfo - Tips Infomation
                    Level - 0:Warning And Contine
                                 1:Error And Abort
                    ClassName,FunctionName,FileName - Where It Occurs
        */
        public static function errorReport($errorInfo,$className = '',$functionName = '',$fileName = '',$level = '0')
        {
            echo '<h1>InsPHP Error Report</h1>';
            echo '<ul>';
            if($level) echo '<li>Type:  Error!</li>';
            else       echo '<li>Type:  Warning!</li>';
            echo "<li>Infomation:$errorInfo</li>";
            if($className != '')echo "<li>In Class:$className</li>";
            if($functionName != '')echo "<li>In Function:$functionName</li>";
            if($fileName != '')echo "<li>In File:$fileName</li>";
            echo "</ul>";
            if($level)die(0);
        }
        
    }
    
    
    /*
        Auto Load Class
        Load Classes Without Require_once And Lasily
    */
    function __autoload($classname)
    {
        $classpath = InsPHP::getRoot()."/system/".$classname.".class.php";
        if(!file_exists($classpath))$classpath = InsPHP::getRoot()."/application/model/".InsPHP::getApp()."/".$classname.".php";
        if(!file_exists($classpath))$classpath = InsPHP::getRoot()."/application/controller/".InsPHP::getApp()."/".$classname.".php";
        if(!file_exists($classpath)) InsPHP::errorReport("<b>Class</b> ".$className." is not defined!",'','','',1);
        require_once($classpath);
    }
    /*
        Router Module In Construction Function
        Redirect The URI by /AppName/Controller/Method
    */
    
    if(!isset($_GET['app']))
    {
        $config = new Config();
        $data = $config->load("system");
        echo "<script>window.location.href = ('".$data['root']."/".$data['default_app']."/');</script>";
    }
    else $app_name = $_GET['app'];
    if(!is_dir(InsPHP::getRoot()."/application/controller/".$app_name))
        InsPHP::errorReport("<b>APP</b> ".$app_name." is not found!",'','','',1);
    Cookie::set("App",$app_name);
    $array = [];
    if(isset($_GET['uri']))$array = explode("/",$_GET['uri']);
    else $array = array();

    if($array[0]!='')
    {
        $str = '$controller = new '.$array[0].'Controller($array);';
        eval($str);
    }
    else
    {
        $config = new Config();
        $data = $config->load("system");
        $con_name = $data['default_controller'];
        echo "<script>window.location.href = ('".$data['root']."/".$data['default_app']."/".$con_name."');</script>";
    }
    