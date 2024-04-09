<?php

  /*
    Mapear la URL ingresada en el navegador
    1- Controlador
    2- Metodo
    3- Parametro
  */

  class Core {
    /*
      Carga el controlador, metodo y parametros de inicio (estos se cargan de manera automatica hasta que se lance otro controlador con otro metodo y otro parameto)
    */
    protected $currentController = 'Home';
    protected $currentMethod = 'index';
    protected $currentParams = [];

    public function __construct() {
      $url = $this->getURL();
      //Buscar en los controladores (Controllers) si el controlador existe
      if (isset($url[0])) {
        if (file_exists('../app/controllers/' .ucwords($url[0]). '.php')) {
          //Si existe se setea como controlador por defecto
          $this->currentController = ucwords($url[0]);
  
          //Unset indice 0
          unset($url[0]);
        }  
      }
      //Requerir el controlador
      require_once '../app/controllers/' . $this->currentController . '.php';
      $this->currentController = new $this->currentController;

      //Buscar el metodo de la url con el controlador
      if (isset($url[1])) {
        if (method_exists($this->currentController, $url[1])) {
          //Revisamos el metodo
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }
      unset($url[0]);
      //Obtener los parametros
      $this->currentParams = $url ? array_values($url) : [];
      //Llamar los parametros del array
      call_user_func_array([$this->currentController,$this->currentMethod], $this->currentParams);
    }

    public function getURL(){
      /*
        Se obtiene la variable url del archivo (.htaccess->public)
      */
      if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode("/", $url);
        return $url;
      }
    }
  }
