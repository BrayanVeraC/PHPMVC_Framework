<?php

  /*
    Creacion de un modelo ejemplo con la conexion a la base de datos
    Eliminar este archivo y usarlo como ejemplo
  */
  class Example{
    private $db;

    public function __construct(){
      $this->db = new Base;
    }

    /*
      Aqui se puede hacer las consultas que se necesite
    */
    public function obtenerItems(){
      $this->db->query("SELECT * FROM items");
      return $this->db->registros();
    }
  }