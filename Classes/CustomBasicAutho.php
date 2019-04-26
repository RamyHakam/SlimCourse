<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/26/19
 * Time: 2:43 PM
 */

class CustomBasicAutho implements  \Tuupola\Middleware\HttpBasicAuthentication\AuthenticatorInterface
{


    public function __invoke(array $arguments): bool
    {
        // TODO: Implement __invoke() method.
         $user=$arguments['user'];
         $pass=$arguments['password'];
        $query=new \Parse\ParseQuery('SlimUsers');
        $query->equalTo('name',$user);
        $query->equalTo('password',$pass);
        $user= $query->find();
        if(isset($user[0])){
            return true;
        }
             return false;


    }


}