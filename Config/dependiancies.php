<?php
// DIC configuration
$container = $app->getContainer();
// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
//ParseClient
$container['ParseClient'] = function ($c) {
    $settings = $c->get('settings')['ParseClient'];
    $ParseClient=new Parse\ParseClient($settings['init'],$settings['URL']);
    return $ParseClient;

};
//ParseUser object
$container['ParseUser'] = function ($c) {
    $ParseUser=new Parse\ParseUser;
    return $ParseUser;
};
//ParseObject object
$container['ParseObject'] = function ($c) {
    $ParseObject=new  Parse\ParseObject;;
    return $ParseObject;
};
//ParseQuery object
$container['ParseQuery'] = function ($c) {
    $ParseQuery=new Parse\ParseQuery("");
    return $ParseQuery;
};
//ParseACL object
$container['ParseACL'] = function ($c) {
    $ParseACL=new Parse\ParseACL;
    return $ParseACL;
};
//ParsePush object
$container['ParsePush'] = function ($c) {
    $ParsePush=new Parse\ParsePush;
    return $ParsePush;
};
//ParseInstallation object
$container['ParseInstallation'] = function ($c) {
    $ParsInstallation=new Parse\ParseInstallation;
    return  $ParsInstallation;
};
//ParseException object
$container['ParseException'] = function ($c) {
    $ParseException=new Parse\ParseException;
    return $ParseException;
};
//ParseAnalytics object
$container['ParseAnalytics'] = function ($c) {
    $ParseAnalytics=new  Parse\ParseAnalytics;
    return $ParseAnalytics;
};
//ParseFile object
$container['ParseFile'] = function ($c) {
    $ParseFile=new Parse\ParseFile;
    return $ParseFile;
};
//ParseCloud object
$container['ParseCloud'] = function ($c) {
    $ParseCloud=new Parse\ParseCloud;
    return $ParseCloud;
};
//JWT object
$container['JWT'] = function ($c) {
    $JWT=new \Firebase\JWT\JWT;
    return $JWT;
};
