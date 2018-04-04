<?php

namespace \Src\Controller\v1;

use Slim\Http\Request, Slim\Http\Request, Src\Libs\UtilResponse, Exception;

class JornaleroController{
  private $app = null;
  private $jornaleroModel = null;
  private $utilResponse = null;

  static $instance;

  public function __construct($app){
    $this->app = $app->getContainer();

    $app->post('/jornalero', [$this,'createJornalero']);
    $app->post('/jornalero', [$this,'createJornalero']);
    $app->post('/jornalero', [$this,'createJornalero']);
    $app->post('/jornalero', [$this,'createJornalero']);
    $app->post('/jornalero', [$this,'createJornalero']);
    $app->post('/jornalero', [$this,'createJornalero']);
  }

  public function createJornalero(Request $request, Response $response, array $args){

  }
}

?>
