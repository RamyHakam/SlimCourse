<?php










 $app->group('', function ( \Slim\App $app){


     $app->post('/AddPost',function(\Slim\Http\Request $request,\Slim\Http\Response $response){
         $data=$request->getParsedBody();
         $newPost=new $this->ParseObject('SlimPosts');
         $newPost->set('title',$data['title']);
         $newPost->set('body',$data['body']);
         $newPost->set('likes',$data['likes']);
         $newPost->set('user',getUserObject($data['userId'],$this));
         $newPost->save();
         return $response->withJson(['status'=>true,'postId'=>$newPost->getObjectId()]);

     });

     $app->get('/getPost[/{postId}]',function (\Slim\Http\Request $request,\Slim\Http\Response $response,$args) {

         $query = new $this->ParseQuery('SlimPosts');
         $query->includeKey('user');
         if (isset($args['postId'])) {
             $query->equalTo('objectId', $args['postId']);
         }
         $posts = $query->find();
         $postsList=[];
         foreach ($posts as $post) {
             $data = ['postId'=>$post->getObjectId(),'title' => $post->get('title'), 'body' => $post->get('body'), 'likes' => $post->get('likes'), 'userName' => $post->get('user')->get('name'), 'createdAt' => $post->getCreatedAt()->getTimeStamp()];
             array_push($postsList,$data);
         }
         return $response->withJson(['status'=>true,'posts'=>$postsList],200);



     });


     $app->put('/updatePost',function (\Slim\Http\Request $request , \Slim\Http\Response $response){

         $data=$request->getParsedBody();
         $query=new $this->ParseQuery('SlimPosts');
         $post=$query->get($data['postId']);
         $post->set('title',$data['title']);
         $post->set('body',$data['body']);
         $post->save();
         return $response->withJson(['status'=>true,'message'=>'post  is updated']);
     });


     $app->delete('/deletePost[/{postId}]',function (\Slim\Http\Request $request , \Slim\Http\Response $response,$args){

         $data=$request->getParsedBody();
         $query=new  $this->ParseQuery('SlimPosts');
         if (isset($args['postId'])) {
             $query->equalTo('objectId', $args['postId']);
         }
         $posts=$query->find();

         foreach ($posts as $post){$post->destroy();}

         return $response->withJson(['status'=>true,'message'=>'post  is deleted']);
     });



 })->add(new Tuupola\Middleware\JwtAuthentication([
    "secret" => "supersecretkeyyoushouldnotcommittogithub"
]))->add(new OneSessionMiddleware());






















function getUserObject($userId,$service) {

    $query=new $service->ParseQuery('SlimUsers');
    $user= $query->get($userId);
    return $user;

}

