<?php
    /* Model Class For Some Work About Database..*/
    class Model
    {
        public $db;
        /*  Construct Function To Initilize Database Class  */
        public function __construct()
        {
            //$table_name = strtolower(substr(__CLASS__,0,strlen(__CLASS__)-5));
            $this->db = new Database();
        }
    }
    