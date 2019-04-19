<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 4/19/19
 * Time: 3:34 PM
 */

 require_once '../vendor/autoload.php';



use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;
$app->post('/hello/{name}/{email}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $email=$args['email'];
    $response->getBody()->write("Hello, $name");
    $response->getBody()->write("your email is , $email");
    return $response;
});

$app->run();


