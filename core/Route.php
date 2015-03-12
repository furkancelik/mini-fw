<?php

class Route
{
    public $this_page;
    private $prefix = "/mini-fw";
    private static $routes = array();


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
        is_array($params) && isset($params['n']) ? self::$routes[$method]['name'][] = $params['n']:self::$routes[$method]['name'][]="";

    }

    public function start()
    {
        if(count($_POST)>0){ $method = isset($_POST['__method'])?$_POST['__method']:"POST";  }
        else { $method = "GET"; }
        $url = substr($this->this_page,strlen($this->prefix));
        if (@in_array($url,self::$routes[$method]['route']))
        {
            $key =  array_search($url,self::$routes[$method]['route']);
            var_dump($result = self::$routes[$method]['params'][$key]);

            if (is_array($result))
            {
                $this_controller = explode("@",$result['c']);
                $this_model = substr($this_controller[0],0,strlen($this_controller[0])-1);
                $this_model = new $this_model();
                $controller_result = (new $this_controller[0]($this_model))->$this_controller[1]();
                echo gettype($controller_result);
                echo get_class($controller_result);


            }
            //İşlem Yapılacak

        }else
        {
            //404
            die("404 - Sayfa Bulunamadı!");
            //404
        }
    }

}