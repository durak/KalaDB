<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', function() {
    View::make('index.html');
//    Redirect::to('/login');
//    HelloWorldController::index();
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

$routes->get('/lure', 'check_logged_in', function() {
    LureController::index();
});
$routes->get('/lure/:id/edit', 'check_logged_in', function($id) {
    LureController::edit($id);
});

$routes->post('/lure/:id/edit', 'check_logged_in', function($id) {
    LureController::update($id);
});

$routes->post('/lure/:id/destroy', 'check_logged_in', function($id) {
    LureController::destroy($id);
});

$routes->post('/lure', 'check_logged_in', function() {    
    LureController::store();
});

$routes->get('/lure/new', 'check_logged_in', function() {
    LureController::create();
});

$routes->get('/lure/:id', 'check_logged_in', function($id) {
    LureController::show($id);
});

// Kalapaikka
$routes->get('/spot', 'check_logged_in', function() {
    SpotController::index();
});
$routes->get('/spot/:id/edit', 'check_logged_in', function($id) {
    SpotController::edit($id);
});

$routes->post('/spot/:id/edit', 'check_logged_in', function($id) {
    SpotController::update($id);
});

$routes->post('/spot/:id/destroy', 'check_logged_in', function($id) {
    SpotController::destroy($id);
});

$routes->post('/spot', 'check_logged_in', function() {    
    SpotController::store();
});

$routes->get('/spot/new', 'check_logged_in', function() {
    SpotController::create();
});

$routes->get('/spot/:id', 'check_logged_in', function($id) {
    SpotController::show($id);
});



$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout(); 
});