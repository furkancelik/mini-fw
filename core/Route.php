<?php

class Route
{
    public $this_page;
    private $prefix = "/route";
    private static $routes = array();
    private static $methods = array();
    private static $params = array();


    public function __construct($this_page)
    {
        $this->this_page = $this_page;

    }

    public function get($url,$param)
    {

        if (is_object($param) && ($param instanceof Closure))
        {
            $this->addRoutes('GET',$url,$param());
        }
        elseif(is_array($param))
        {
            $this->addRoutes('GET',$url,$param);
        }


    }

    public function post($url,$param)
    {

        if (is_object($param) && ($param instanceof Closure))
        {
            $this->addRoutes('POST',$url,$param());
        }
        elseif(is_array($param))
        {
            $this->addRoutes('POST',$url,$param);
        }


    }

    public function put($url,$param)
    {

        if (is_object($param) && ($param instanceof Closure))
        {
            $this->addRoutes('PUT',$url,$param());
        }
        elseif(is_array($param))
        {
            $this->addRoutes('PUT',$url,$param);
        }


    }

    public function delete($url,$param)
    {

        if (is_object($param) && ($param instanceof Closure))
        {
            $this->addRoutes('DELETE',$url,$param());
        }
        elseif(is_array($param))
        {
            $this->addRoutes('DELETE',$url,$param);
        }


    }

    private function addRoutes($method,$route,$params)
    {
        self::$routes[$method]['route'][] = $route;
        self::$routes[$method]['params'][] = $params;

    }

    public function start()
    {
        if(count($_POST)>0){ $method = isset($_POST['__method'])?$_POST['__method']:"POST";  }
        else { $method = "GET"; }
        $url = substr($this->this_page,strlen($this->prefix));
        if (in_array($url,self::$routes[$method]['route']))
        {
            $key =  array_search($url,self::$routes[$method]['route']);
            var_dump(self::$routes[$method]['params'][$key]);
            //İşlem Yapılacak

        }else
        {
            //404
            die("404 - Sayfa Bulunamadı!");
            //404
        }
    }

}