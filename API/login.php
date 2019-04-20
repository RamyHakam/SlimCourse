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


      $query=new $this->ParseQuery('SlimUsers');
      $query->equalTo('name',$name);
      $query->equalTo('password',$pass);
      $user= $query->find();
      if(isset($user[0])){
         return $response->withJson(['status'=>true,'login'=>true],200);
    }
     return $response->withJson(['status'=>false,'login'=>false],401);

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

