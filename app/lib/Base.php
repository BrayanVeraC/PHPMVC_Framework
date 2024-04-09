<?php

  /*
    Clase de conexion a la base de datos y las consultas PDO
  */
  class Base{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;

    private $dbh; // DataBase Handle
    private $stmt; //Statement (Ejecutar una consulta)
    private $error;

    public function __construct() {
      //Configurar la conexion
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      );

      //Crear una instancia PDO
      try {
        $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        $this->dbh->exec('set names utf8');
      } catch (PDOException $e) {
        $this->error = $e->getMessage();
        echo $this->error;
      }
    }

    //Preparamos la consulta
    public function query($sql) {
      $this->stmt = $this->dbh->prepare($sql);
    }

    //Vinculamos la consulta
    public function bind($parametro, $valor, $tipo = null){
      if(is_null($tipo)){
        switch (true) {
          case is_int($valor):
            $tipo = PDO::PARAM_INT;
            break;
          case is_bool($valor):
            $tipo = PDO::PARAM_BOOL;
            break;
          case is_null($valor):
            $tipo = PDO::PARAM_NULL;
            break;
          default:
            $tipo = PDO::PARAM_STR;
            break;
        }
      }
      $this->stmt->bindValue($parametro, $valor, $tipo);
    }
    
    //EJECUTAMOS LA CONSULTA
    public function execute(){
      return $this->stmt->execute();
    }

    //OBTENER REGISTROS DE LA CONSULTA
    public function registros(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //OBTENER UN SOLO REGISTRO
    public function registro(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //OBTENER CANTIDAD DE FILAS CON EL METODO ROWCOUNT
    public function rowCount(){
      return $this->stmt->rowCount();
    }
  }