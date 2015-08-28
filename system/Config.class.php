<?php
    /*  Config Loader Class File By InsZVA
        Create A Class That Load Config File Easily
    */
    class Config
    {
        protected $rootpath = "";
        public function __construct()
        {
            $this->rootpath = InsPHP::getRoot();
        }
        
        /*
            param:config => The Config Filename You Want To Load
            return:Array Of Configure Infomation In Your Config File
        */
        public function load($config)
        {
            $content = file_get_contents($this->rootpath."/application/config/$config.php");
            $content = str_replace("<?php","",$content);    //Remove Head
            $content = str_replace("?>","",$content);       //Remove Tail
            eval($content);
            $array = get_defined_vars();
            unset($array['content']);
            unset($array['config']);
            return $array;
        }
        /*
            Usage Example:
            database.php:
                <?php
                    $address = 'localhost';
                    $user = 'root';
                    $password = 'root';
            Anywhere.php:
                echo $this->config->load("database")->address;  //Print localhost
        */
    }   
