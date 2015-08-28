<?php
    /*  Load Class To Load Model,Library,...    */
    class Load
    {
        /* Function Model To Load And Return A Model    */
        public function model($modelName)
        {
            $exec = '$model = new '.$modelName.'();';
            eval($exec);
            return $model;
        }
        /*  Function View To Load And Display The View
            Param:  data - DataArray To Load In View File    */
        public function view($viewName,$data)
        {
            foreach($data as $key => $value)
            {
                if(is_string($value))eval('$'."$key = '$value';");
                else if(is_numeric($value))eval('$'."$key = $value;");
                else if(is_array($value)){
                    $json = json_encode($value);
                    eval('$'."$key = json_decode('$json');");
                }
                else InsPHP::errorReport("Unsupported Data Type Of Var:$key;",__CLASS__,__FUNCTION__,__FILE__);
            }
            require_once(InsPHP::getRoot()."/application/view/$viewName.php");
        }
        
    }
    
    /*  Controller Class Base Class */
    class Controller
    {
        protected $load;
        protected $uri_segment;
        public function __construct($array)
        {
            $this->load = new Load();
            $this->uri_segment = $array;
            if($array[1]=='')   //Load Default Method
                {$this->Index();}
            else eval('$this->'.$array[1].'();');
        }
        
        public function Index()
        {
            InsPHP::errorReport('Defaut Index Method!',__CLASS__,__FUNCTION__,__FILE__);
        }
        
    }
    
        