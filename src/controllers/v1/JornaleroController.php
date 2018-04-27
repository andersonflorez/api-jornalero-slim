<?php

namespace Src\Controllers\v1;

use Src\Models\V1\JornaleroModel, Slim\Http\Request, Slim\Http\Response, Src\Libs\UtilResponse, Exception, Src\Validations\v1\JornaleroValidation;

class JornaleroController{
  private $app = null;
  private $jornaleroModel = null;
  private $utilResponse = null;

  static $instance;

  public function __construct($app){
    $this->app = $app->getContainer();

    $conections = $this->app->database;
    $this->jornaleroModel = new JornaleroModel($conections);

    $app->post('', [$this,'createJornalero']);
    $app->get('', [$this,'readJornaleros']);
    $app->get('/{idJornalero:[0-9]+}', [$this,'readJornalero']);
    $app->put('/{idJornalero:[0-9]+}', [$this,'updateJornalero']);
    $app->delete('/{idJornalero:[0-9]+}', [$this,'deleteJornalero']);

  }

  private function __clone(){

  }

  public static function getInstance($app){
    if(!(self::$instance instanceof self)){
      self::$instance = new self($app);
    }
    return self::$instance;
  }

  public function createJornalero(Request $request, Response $response, array $args){

    $this->utilResponse = new UtilResponse();
    $data = $request->getParsedBody();

    $validation = JornaleroValidation::validate($data);

    if(!$validation->result){
      return $response->withJson($validation,422);
    }
    try{
      
      $idJornalero = $this->jornaleroModel->createJornalero($data);
      $this->utilResponse = $this->utilResponse->setResponse(true, 'El Jornalero se inserto correctamente');
      $data = $this->jornaleroModel->readJornalero($idJornalero);
      $this->utilResponse->object = $data;
      return $response->withJson($this->utilResponse, 201);

    }catch(Exception $e){
      $this->app->logger->error("Jornalero App - Ruta: POST v1/Jornaleros Controlador: JornaleroController:createJornalero. Error: ".$e->getMessage());
      $this->utilResponse = $this->utilResponse->setResponse(false, 'Ocurrio un error inesperado');
      return $response->withJson($this->utilResponse, 500);
    }
  }

  public function readJornaleros(Request $request, Response $response){
    $this->utilResponse = new UtilResponse();
    try{
      $this->utilResponse->object = $this->jornaleroModel->readJornaleros();
      $this->utilResponse = $this->utilResponse->setResponse(true, 'El Jornalero se listaron con exito');
      return $response->withJson($this->utilResponse, 200);
    }catch(Exception $e){
      $this->app->logger->error("Jornalero App - Ruta: GET v1/Jornaleros Controlador: JornaleroController:readJornaleros. Error: ".$e->getMessage());
      $this->utilResponse = $this->utilResponse->setResponse(false, 'Ocurrio un error inesperado');
      return $response->withJson($this->utilResponse, 500);
    }
  }

  public function readJornalero(Request $request, Response $response, array $args){
    $this->utilResponse = new UtilResponse();

    $this->utilResponse->object = $this->jornaleroModel->readJornalero($args['idJornalero']);
    return $response->withJson($this->utilResponse, 200);
  }

  public function updateJornalero(Request $request, Response $response, array $args){
    $this->jornaleroModel->updateJornalero($request->getParsedBody(), $args['idJornalero']);

    $this->utilResponse = new UtilResponse();
    $this->utilResponse = $this->utilResponse->setResponse(true, 'El Jornalero se actualizo correctamente');
    return $response->withJson($this->utilResponse, 201);

  }

  public function deleteJornalero(Request $request, Response $response, array $args){
    $this->jornaleroModel->deleteJornalero($args['idJornalero']);

    $this->utilResponse = new UtilResponse();
    $this->utilResponse = $this->utilResponse->setResponse(true, 'El Jornalero se elimino correctamente');
    return $response->withJson($this->utilResponse, 201);
  }
}

?>
