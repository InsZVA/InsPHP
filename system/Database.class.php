<?php
    /*  Database Class Based On MySQLi Interface    */
    class Database
    {
        protected $db_address,$db_name,$db_user,$db_password;
        protected $config;
        /*
            Construct Function - Initilize The Configure
            Param:  RootPath Db_name
        */
        public function __construct()
        {
            $this->config = new Config();
            $config = $this->config->load("database");
            $this->db_address = $config['address'];
            $this->db_name = $config['dbname'];
            $this->db_user = $config['user'];
            $this->db_password = $config['password'];
        }
        /*
            DoQuery Function - Do SQL Query
            Param:  Query String(s)
            Return: Query Result(s)
            Example:array(4) { [0]=> array(4) { ["id"]=> string(1) "1" ["title"]=> string(9) "第一篇" ["content"]=> string(9) "啦啦啦" ["author"]=> string(1) "1" } 
                    [1]=> array(4) { ["id"]=> string(1) "2" ["title"]=> string(9) "第二篇" ["content"]=> string(10) "啦啦啦2" ["author"]=> string(1) "2" }
                    [2]=> array(4) { ["id"]=> string(1) "3" ["title"]=> string(9) "第一篇" ["content"]=> string(9) "啦啦啦" ["author"]=> string(1) "1" }
                    [3]=> array(4) { ["id"]=> string(1) "4" ["title"]=> string(9) "第二篇" ["content"]=> string(10) "啦啦啦2" ["author"]=> string(1) "2" } }
        */
        public function doQuery($query)
        {
            $mysqli = new mysqli($this->db_address,$this->db_user,$this->db_password,$this->db_name);
            if(is_array($query))
            {
                $result = array();
                foreach($query as $key => $value)
                {
                    $rows = array();
                    $re = $mysqli->query($value);
                    while($row = $re->fetch_assoc())
                        $rows[] = $row;
                    $result[] = $rows;
                }
            }
            else
            {
                $rows = array();
                $re = $mysqli->query($query);
                while($row = $re->fetch_assoc())
                    $rows[] = $row;
                $result = $rows;
            }
            $mysqli->close();
            return $result;
        }
        
    }
    