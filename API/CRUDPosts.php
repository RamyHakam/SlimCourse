<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 5:35 PM
 */

// $app->post('/AddPost/{username}',function (\Slim\Http\Request $request,\Slim\Http\Response $response,$args){

//      $name=$args['username'];
//      $pass=$args['password'];


//       $query=new $this->ParseQuery('SlimPosts');
//       $query->equalTo('name',$name);
//       $query->equalTo('password',$pass);
//       $user= $query->find();
//       if(isset($user[0])){
//          return $response->withJson(['status'=>true,'login'=>true],200);
//     }
//      return $response->withJson(['status'=>false,'login'=>false],401);

// });


$app->post('/AddPost',function (\Slim\Http\Request $request ,\Slim\Http\Response $response){

     $data=$request->getParsedBody();

     $newPost=new $this->ParseObject('SlimPosts');
     $newPost->set('title',$data['title']);
     $newPost->set('body',$data['body']);
     $newPost->set('likes',$data['likes']);
     $newPost->save();
     return $response->withJson(['status'=>true,'PostId'=>$newPost->getObjectId()]);


});