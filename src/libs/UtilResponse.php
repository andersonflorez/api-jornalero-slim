<?php
namespace Src\Libs;

class UtilResponse{

  //Esta variable va a contener todos los datos que se van a responder al cliente
  public $object = null;

  //Va a responder true o false para identificar si la peticion se hizo correctamente
  public $result = null;

  //Se guarda el mensaje estandar
  public $message = '';

  //Array que contiene todos los errores que sucedieron en la peticion
  public $errors = [];

  public function setResponse($result, $message = ''){
    $this->result = $result;
    $this->message = $message;

    if($result == false && $message == ''){
      $this->message = 'Ocurrio un error inesperado, por favor revise los datos enviados';
    }
    return $this;
  }
}

?>
