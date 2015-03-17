<?php namespace App\Core;
class Controller
{
    //private $view;
    private $model;
    private $view;
    //Singleton pattern ile view'i yükle

    public function __construct(Model $model)
    {
        //$this->view  = $view;
        $this->model = $model;
    }

    public function model()
    {
        return $this->model;
    }





}