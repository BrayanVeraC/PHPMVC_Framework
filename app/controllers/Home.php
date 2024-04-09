<?php

  class Home extends mainController{
    public function __construct(){
      //Ejemplo de uso
      $this->exampleModel = $this->loadModel('Example');
    }

    public function index(){
      //Ejemplo de uso
      $item= $this->exampleModel->obtenerItems();
      $data = [
        'title' => 'Bienvenido a prueba de inicio titulo home',
        'items' => $item
      ];
      $this->loadView('inc/header');
      $this->loadView('pages/start',$data);
      $this->loadView('inc/footer');
    }
  }