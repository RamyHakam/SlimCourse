<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 5:35 PM
 */
use Tuupola\Middleware\HttpBasicAuthentication;


$app->post('/login',function (\Slim\Http\Request $request,\Slim\Http\Response $response,$args){

      if($request->getAttribute('user')){

          $MyJWT=$this->JWT;
          $now = new DateTime();
          $future = new DateTime("now +10 minutes");
          // $server = $request->getServerParams();
          $payload = [
              "iat" => $now->getTimeStamp(),
              "exp" => $future->getTimeStamp(),
              "user" =>$request->getAttribute('user'),
          ];
          $secret = "supersecretkeyyoushouldnotcommittogithub";
          $token = $MyJWT->encode($payload, $secret, "HS512");

         saveUserToken($request->getAttribute('user'),$token);

          return $response->withJson(['status'=>true,'token'=>$token],201);
    }
     return $response->withJson(['status'=>false,'login'=>false],401);

})->add(new HttpBasicAuthentication([


    "authenticator" => new CustomBasicAutho(),
    "before" => function ($request, $arguments) {
        return $request->withAttribute("user", $arguments["user"]);
    }
]));









$app->post('/signUpUser',function (\Slim\Http\Request $request ,\Slim\Http\Response $response){

     $data=$request->getParsedBody();

     $newUser=new $this->ParseObject('SlimUsers');
     $newUser->set('name',$data['userName']);
     $newUser->set('phone',$data['phone']);
     $newUser->set('password',$data['password']);
     $newUser->save();
     return $response->withJson(['status'=>true,'userId'=>$newUser->getObjectId()]);


});



function saveUserToken($username,$token){
    $Query=new \Parse\ParseQuery('SlimUsers');
    $Query->equalTo('name',$username);
    $user=$Query->first();
    $user->set('token',$token);
    $user->save();
}