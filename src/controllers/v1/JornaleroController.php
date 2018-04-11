<?php

namespace Src\Controllers\v1;

use Src\Models\V1\JornaleroModel, Slim\Http\Request, Slim\Http\Response, Src\Libs\UtilResponse, Exception;

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

  public function getInstance($app){
    if(!(self::$instance instanceof self)){
      self::$instance = new self($app);
    }
    return self::$instance;
  }

  public function createJornalero(Request $request, Response $response, array $args){

    $this->jornaleroModel->createJornalero($request->getParsedBody());

    $this->utilResponse = new UtilResponse();
    $this->utilResponse = $this->utilResponse->setResponse(true, 'El Jornalero se inserto correctamente');
    return $response->withJson($this->utilResponse, 201);

  }

  public function readJornaleros(Request $request, Response $response, array $args){
    $this->utilResponse = new UtilResponse();
    $this->utilResponse->object = $this->jornaleroModel->readJornaleros();
    return $response->withJson($this->utilResponse, 200);
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
