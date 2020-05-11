<?php

    // Main Controller
    class Controller{
        // Load Model
        public function model($model){
            //load
            require_once '../app/models/'.$model.'.php';
            //instance model
            return new $model();
        }
        
        // Load View
        public function view($view,$data=[]){
            //check if exist
            if(file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';
            }else{
                die('The view '.$view.' not exist');
            }
        }
        
    }