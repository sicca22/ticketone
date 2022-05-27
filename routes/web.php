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
|  // php -S localhost:8000 -t public
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/events', 'EventsController@index');
$router->get('/events/{id}', 'EventsController@show');

$router->group(['middleware' => 'auth'], function () use ($router){
    $router->post('/events', 'EventsController@create');
    //* bisogna che l'utente sia identificato

    
//Aggiornamento di un av
    $router->put('/events/{id}','EventsController@update');//* -> anche (authToken) autorizzazzione, modifico solo i miei

    
    $router->delete('/events/{id}', 'EventsController@delete');//*->

});

//Creazione di un evento



$router->post('/users','UsersController@create');

//autenticazione utente/log in
$router->post('/login','UsersController@login');