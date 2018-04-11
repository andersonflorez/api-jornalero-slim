<?php

namespace Src\Models\v1;

use Exception;

class JornaleroModel
{

  private $conections = null;
  private $pdo = null;
  private $fluentpdo = null;
  private $tblJornalero = 'tblJornalero';

  public function __construct($conections){

   $this->conections = $conections;
    $this->pdo = $conections->pdo;
    $this->fluentpdo = $conections->fluentpdo;
  }

  public function createJornalero($jornalero){
    try {
      $jornalero['fechaNacimiento'] = date("Y-m-d", strtotime($jornalero['fechaNacimiento']));

      return $this->fluentpdo->insertInto($this->tblJornalero,$jornalero)->execute();

    } catch (Exception $e) {
      throw new Exception("Ocurrió un inesperado: ".$e->getMessage());

    }
  }

  public function readJornaleros(){
    try {
      return $this->fluentpdo->from($this->tblJornalero)->fetchAll();
    } catch (Exception $e) {
      throw new Exception("Ocurrió un inesperado: ".$e->getMessage());

    }
  }

  public function readJornalero($idJornalero){
    try {
      return $this->fluentpdo->from($this->tblJornalero)->where('idJornalero',$idJornalero)->fetch();
    } catch (Exception $e) {
      throw new Exception("Ocurrió un inesperado: ".$e->getMessage());

    }
  }

  public function updateJornalero($jornalero, $idJornalero){
    try {
      $jornalero['fechaNacimiento'] = date("Y-m-d", strtotime($jornalero['fechaNacimiento']));
      $jornalero['actualizado'] = date("Y-m-d H:i:s");
      return $this->fluentpdo->update($this->tblJornalero)->set($jornalero)->where('idJornalero',$idJornalero)->execute();
    } catch (Exception $e) {
      throw new Exception("Ocurrió un inesperado: ".$e->getMessage());

    }
  }

  public function deleteJornalero($idJornalero){
    try {

      return $this->fluentpdo->deleteFrom($this->tblJornalero)->where('idJornalero',$idJornalero)->execute();
    } catch (Exception $e) {
      throw new Exception("Ocurrió un inesperado: ".$e->getMessage());

    }
  }
}


?>
