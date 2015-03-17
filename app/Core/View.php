<?php namespace App\Core;
Class View
{
    public function make($file)
    {
        return "MAKE";
    }

    public function with($key,$value)
    {
        return $value;
    }
}