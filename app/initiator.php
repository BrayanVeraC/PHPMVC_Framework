<?php

  //Cargamos las librerias
  require_once 'config/Config.php';

  
  //require_once 'lib/Base.php';
  //require_once 'lib/Controller.main.php';
  //require_once 'lib/Core.php';

  //Autoload php
  spl_autoload_register(function ($nameClass) {
    require_once 'lib/' .$nameClass . '.php';
  });