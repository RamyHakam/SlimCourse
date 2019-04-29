<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 5:35 PM
 */


$app->post('/login',function (\Slim\Http\Request $request,\Slim\Http\Response $response,$args){


});









$app->post('/signUpUser',function (\Slim\Http\Request $request ,\Slim\Http\Response $response){

     $data=$request->getParsedBody();

     $newUser=new $this->ParseObject('SlimUsers');
     $newUser->set('name',$data['userName']);
     $newUser->set('phone',$data['phone']);
     $newUser->set('password',$data['password']);
     $newUser->save();
     return $response->withJson(['status'=>true,'userId'=>$newUser->getObjectId()]);


});


