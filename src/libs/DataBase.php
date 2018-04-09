<?php

namespace Src\Libs;

use FluentPDO, PDO, Exception;

class DataBase{

  //Singleton
  public $pdo;
  public $fluentpdo;

  static $instances;

  private function __construct($stringConection){
      try {
        $this->pdo = new PDO($stringConection['dns'], $stringConection['user'], $stringConection['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $this->fluentpdo = new FluentPDO($this->pdo);
      } catch (Exception $e) {
        die($e->getMessage());
      }
  }

  private function __clone(){

  }

  public static function getInstance($stringConection){
    //aplicamos el factor Singleton

    if (!(self::$instances instanceof self)) {
      self::$instances = new self($stringConection);
    }
    return self::$instances;
  }
}


?>
