<?php
//Dependencies settings of full app Slim and Parse
//Parse server app variabels

$app_id='2getherNetworkapp'; // The ID of the the parse app
$master_key='bWFzdGVydG29nZreXRoto2039XJyYW15MTAyOTMwNDk';  //The Master Key of the app
$Server_URL='https://backend.2gethernetwork.com'; //Server URL of the parse Server


return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Monolog settings
//        'logger' => [
//            'name' => 'Your Log API ',
//            'path' => '/../logs/app.log',
//            'level' => \Monolog\Logger::DEBUG,
//        ],
        // ParseClient settings

        'ParseClient'=> [
            'init'=>\Parse\ParseClient::initialize($app_id,null,$master_key),
            'URL'=>\Parse\ParseClient::setServerURL($Server_URL,'parse'),
        ],
    ],
];