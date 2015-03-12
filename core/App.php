<?php
require 'Input.php';
require 'Route.php';

require 'Model.php';
require 'Controller.php';
require 'View.php';

$load_files = array("C","M");

foreach($load_files as $load_file)
{
    !file_exists($load_file)?die("No dir:".$load_file):"";
    if($handle = opendir($load_file))
    {
        while(($file = readdir($handle)) !== false)
        {
            if(substr($file,-3)=="php")
            {
                include $load_file."/".$file;
            }
        }

    }
    closedir($handle);
}



$route = new Route($_SERVER['REQUEST_URI']);
require 'Pages.php';

