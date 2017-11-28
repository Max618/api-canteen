<?php

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

/*$router->get('/key', function() {
    return str_random(32);
});*/

$router->group(['prefix' => '/api/v1'], function($app){
	$app->group(['prefix' => 'auth'], function($app){
		$app->post('login/','AuthController@login');
		$app->post('register/parent/','AuthController@registerParent');
		$app->post('register/cook/','AuthController@registerCook');
		$app->post('logout/','AuthController@logout');
	});


	$app->group(['prefix' => 'cantina','middleware' => 'auth'], function($app){
		$app->get('produtos/','ProductController@index');
		$app->put('produto/','ProductController@store');
		$app->delete('produto/{product}/','ProductController@delete');
		$app->post('produto/{product}/','ProductController@update');
		$app->get('produto/{product}/','ProductController@get');

		$app->get('/pedidos/today/','RequestsController@getRequests');
		$app->get('pedidos/','RequestsController@index');
		$app->post('pedido/{request}/','RequestsController@update');
		$app->get('pedido/{request}/','RequestsController@get');
	});

	$app->group(['prefix' => 'resp','middleware' => 'auth'], function($app){
		$app->get('filhos/','StudentController@index');
		$app->put('filho/','StudentController@store');
		$app->delete('filho/{student}/','StudentController@delete');
		$app->post('filho/{student}/','StudentController@update');
		$app->get('filho/{student}/','StudentController@get');

		$app->post('pedido/{request}/','RequestsController@update');
		$app->get('pedido/{request}/','RequestsController@get');
		$app->put('pedido/','RequestsController@store');
		$app->delete('pedido/{request}/','RequestsController@delete');
		$app->get('meuspedido/','RequestsController@myRequest');
	});
});
