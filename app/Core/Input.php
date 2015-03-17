<?php namespace App\Core;
Class Input {
    private $name = array();

    private function __construct()
    {
        //
    }

    public function get($name)
    {

        if (count($_POST)>0) { $type = $_POST; }
        else { $type = $_GET; }

            if (is_array($name))
            {
                foreach($name as $k=>$v)
                {
                    $this->name[$k] = $type[$v];
                }
            }else
            {
                return $type[$name];
            }

    }

    public function __call($a,$b)
    {
        die("No Input this Method:".$a);
    }

    public static function __callStatic($method, $params)
    {
       return $this->get();
    }
}