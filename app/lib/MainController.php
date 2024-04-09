<?php

  //Clase controlador principal
  //Se encarga de cargar los modelos y las vistas

  class mainController{

    //Cargar modelo
    public function loadModel($model){
      //Cargar el modelo
      require_once '../app/models/'.$model.'.php';
      //Instanciar el modelo
      return new $model();
    }

    //Cargar vista
    public function loadView($view, $data = []){
      //Verificar si existe la vista
      if (file_exists('../app/views/'.$view.'.php')){
        //Cargar la vista
        require_once '../app/views/'.$view.'.php';
      }else{
        //Cargar la vista por defecto
        //require_once '../app/views/404.php';
        die('La vista no existe');
      }
    }
  }