<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 5:35 PM
 */

$app->post('/login/{username}/{password}',function (\Slim\Http\Request $request,\Slim\Http\Response $response,$args){

     $name=$args['username'];
     $pass=$args['password'];

     if($name=='1234'&&$pass=='1234'){
         return $response->withJson(['status'=>true,'login'=>true],200);
     }
     return $response->withJson(['status'=>false,'login'=>false],401);


});