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

/*
 * Lures
 */

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

/*
 * Spots
 */

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

/*
 * Species
 */

$routes->get('/species', 'check_logged_in', function() {
    SpeciesController::index();
});

$routes->get('/species/:id', 'check_logged_in', function($id) {
    SpeciesController::show($id);
});

/*
 * Trips
 */

$routes->get('/trip', 'check_logged_in', function() {
    TripController::index();
});
$routes->get('/trip/:id/edit', 'check_logged_in', function($id) {
    TripController::edit($id);
});

$routes->post('/trip/:id/edit', 'check_logged_in', function($id) {
    TripController::update($id);
});

$routes->post('/trip/:id/destroy', 'check_logged_in', function($id) {
    TripController::destroy($id);
});

$routes->post('/trip', 'check_logged_in', function() {
    TripController::store();
});

$routes->get('/trip/new', 'check_logged_in', function() {
    TripController::create();
});

$routes->get('/trip/:id', 'check_logged_in', function($id) {
    TripController::show($id);
});

/*
 * Fishes
 */

$routes->get('/fish', 'check_logged_in', function() {
    FishController::index();
});

$routes->get('/fish/:id/edit', 'check_logged_in', function($id) {
    FishController::edit($id);
});

$routes->post('/fish/:id/edit', 'check_logged_in', function($id) {
    FishController::update($id);
});

$routes->post('/fish/:id/destroy', 'check_logged_in', function($id) {
    FishController::destroy($id);
});

$routes->post('/fish', 'check_logged_in', function() {
    FishController::store();
});

$routes->get('/fish/new', 'check_logged_in', function() {
    FishController::create();
});

$routes->get('/fish/:id', 'check_logged_in', function($id) {
    FishController::show($id);
});


/*
 * LOGIN & SIGNUP, User functions
 */
$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});

$routes->get('/signup', function() {
    UserController::signup();
});

$routes->post('/signup', function() {
    UserController::handle_signup();
});

$routes->get('/user/:id', 'check_logged_in', function($id) {
    UserController::show($id);
});

$routes->post('/user/:id/edit', 'check_logged_in', function($id) {
    UserController::update($id);
});

$routes->post('/user/:id/destroy', 'check_logged_in', function($id) {
    UserController::destroy($id);
});
