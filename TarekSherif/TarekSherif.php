<?php

$app->get('/TarekSherif',function (\Slim\Http\Request $request,\Slim\Http\Response $response){
    return $response->withJson(['massage'=>'Thank you MR. Ramy Hakam'],200);
});
