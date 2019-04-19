<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 3:34 PM
 */

 require_once '../vendor/autoload.php';


use Slim\Http\Request as Request;
use Slim\Http\Response as Response;


$app = new \Slim\App;


require '../API/login.php';



$app->run();



