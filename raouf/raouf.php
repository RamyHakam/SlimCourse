<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Raouf
 * Date: 4/19/2019
 * Time: 10:38 PM
 */

$app->get('/name/{name}',function (\Slim\Http\Request $request,\Slim\Http\Response $response,$args){

    $name=$args['name'];

    return $response->withJson(['name'=>$name],200);


});