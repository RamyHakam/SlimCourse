<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/26/19
 * Time: 5:01 PM
 */

namespace Controllers;

use DateTime;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController
{






    private  $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
    }


    public function __invoke(Request $request,Response $response,$args)
    {
        // TODO: Implement __invoke() method.
        if($request->getAttribute('user')){
            $this->container->get('logger')->info('user login with name ',['name'=>$request->getAttribute('user')]);
                 $MyJWT=$this->container->get('JWT');
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

            $this->saveUserToken($request->getAttribute('user'),$token);

            return $response->withJson(['status'=>true,'token'=>$token],201);
        }
        return $response->withJson(['status'=>false,'login'=>false],401);

    }


private function saveUserToken($username,$token){
        $Query=new \Parse\ParseQuery('SlimUsers');
        $Query->equalTo('name',$username);
        $user=$Query->first();
        $user->set('token',$token);
        $user->save();
    }


}
