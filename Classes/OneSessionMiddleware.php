<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/26/19
 * Time: 4:20 PM
 */

class OneSessionMiddleware
{


    public  function __invoke(\Slim\Http\Request $request ,\Slim\Http\Response $response,$next)
    {
        // TODO: Implement __invoke() method.
        $token=$request->getHeaderLine('authorization');
        $token=str_replace('Bearer ','',$token);
        $username=$this->decodeToken($token);
        if($this->checkUserToken($username,$token)){
        return    $response=$next($request,$response);
        }

          return $response->withJson(['status'=>false,'message'=>'you have another open session']);


    }

    private  function  decodeToken($token){


        $jwt=new \Firebase\JWT\JWT();
        $decoded=$jwt::decode($token,'supersecretkeyyoushouldnotcommittogithub',["HS512"]);
        return$decoded->user;

    }



    private  function  checkUserToken($username,$token){
        $Query=new \Parse\ParseQuery('SlimUsers');
        $Query->equalTo('name',$username);
        $Query->equalTo('token',$token);
        $user=$Query->find();
        if(isset($user[0])){
            return true;
        }
        return false;

    }


}