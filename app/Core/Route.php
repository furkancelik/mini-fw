<?php namespace App\Core;
use JsonSchema\Constraints\String;

class Route
{
    private static $instance;
    public $this_page;
    private static $routes = array();


    private function __construct()
    {
        $this->this_page = !isset($_GET['__this_page'])?"/":"/".$_GET['__this_page'];

    }

    private function __clone()
    {
    }



    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }




    public function post($url,$param)
    {

        if (is_object($param) && ($param() instanceof Closure))
        {
            self::addRoutes('POST',$url,$param());
        }
        elseif(is_array($param))
        {
            self::addRoutes('POST',$url,$param);
        }


    }

    public function put($url,$param)
    {

        if (is_object($param) && ($param() instanceof Closure))
        {
            self::addRoutes('PUT',$url,$param());
        }
        elseif(is_array($param))
        {
            self::addRoutes('PUT',$url,$param);
        }


    }

    public function delete($url,$param)
    {

        if (is_object($param) && ($param() instanceof Closure))
        {
            self::addRoutes('DELETE',$url,$param());
        }
        elseif(is_array($param))
        {
            self::addRoutes('DELETE',$url,$param);
        }

    }

    public static function get($url,$param)
    {
        if (is_object($param)  && is_callable($param) /*&& ($param() instanceof Closure)*/)
        {
            self::addRoutes('GET',$url,$param());
        }
        elseif(is_array($param))
        {
            self::addRoutes('GET',$url,$param);
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
          if(count($_POST)>0)
        {
            $method = isset($_POST['__method'])?$_POST['__method']:"POST";
        }
        else
        {
            $method = "GET";
        }

        $url = $this->this_page;
        if (@in_array($url,self::$routes[$method]['route']))
        {
            $key =  array_search($url,self::$routes[$method]['route']);

            $result = self::$routes[$method]['params'][$key];
            #var_dump($result);


            /*
             * Controller Install
             * */
            if (is_array($result))
            {
                $this_controller = explode("@",$result['c']);
                $this_model = substr($this_controller[0],0,strlen($this_controller[0])-1);
                $this_model = new $this_model();
                $controller_result = (new $this_controller[0]($this_model))->$this_controller[1]();
                echo gettype($controller_result);
                echo get_class($controller_result);
            }

            /*
             * String Install
             * */

            if(is_string($result))
            {
                echo $result;
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