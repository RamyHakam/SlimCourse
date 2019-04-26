<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 3:34 PM
 */

 require_once '../vendor/autoload.php';
 require_once '../Classes/CustomBasicAutho.php';
require_once  '../Classes/OneSessionMiddleware.php';
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;



// Instantiate the app
$settings = require __DIR__ . '/../Config/settings.php';
$app = new \Slim\App($settings);
// Set up dependencies
require __DIR__ . '/../Config/dependiancies.php';
require  __DIR__.'/../Config/middlewares.php';

 require '../raouf/raouf.php';
 require '../TarekSherif/TarekSherif.php';
 require  '../API/login.php';
 require "../API/CRUDPosts.php";
 require '../raouf/CRUDPosts.php';


$app->run();



