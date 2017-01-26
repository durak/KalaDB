<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/kalareissu', function() {
    HelloWorldController::trip_list();
});

$routes->get('/kalareissu/1', function() {
    HelloWorldController::trip_show();
});

$routes->get('/kala', function() {
    HelloWorldController::fish_list();
});

$routes->get('/kala/1', function() {
    HelloWorldController::fish_show();
});

$routes->get('/kalapaikka', function() {
    HelloWorldController::spot_list();
});

$routes->get('/kalapaikka/1', function() {
    HelloWorldController::spot_show();
});
$routes->get('/viehe', function() {
    HelloWorldController::lure_list();
});

$routes->get('/viehe/1', function() {
    HelloWorldController::lure_show();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
