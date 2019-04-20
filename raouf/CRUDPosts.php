<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Raouf
 * Date: 4/20/2019
 * Time: 4:41 PM
 */

$app->post('/Raouf/newPost',function (\Slim\Http\Request $request ,\Slim\Http\Response $response){

    $data=$request->getParsedBody();

    $newPost=new $this->ParseObject('SlimPosts');
    $newPost->set('title',$data['postTitle']);
    $newPost->set('body',$data['postBody']);
    $newPost->set('likes',$data['likes']);
    $newPost->save();
    return $response->withJson(['status'=>true,'postId'=>$newPost->getObjectId()]);

});
