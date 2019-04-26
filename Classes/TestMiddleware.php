<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/26/19
 * Time: 2:23 PM
 */

class TestMiddleware
{



  public function __invoke( \Slim\Http\Request $request ,\Slim\Http\Response $response ,$next)
  {
      // TODO: Implement __invoke() method.
      echo "before";
      $response=$next($request,$response);
      echo "after";
      return $response;


  }


}