<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/events', 'EventsController@index');
$router->get('/events{id}', 'EventsController@show');

//Creazione di un evento
$router->post('/events','EventsController@create');

//Aggiornamento di un av
$router->post('/events{id}','EventsController@update');

$router->delete('/events{id}', 'EventsController@delete');


$router->post('/users','UsersController@create');