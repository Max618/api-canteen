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

$router->group(['prefix' => '/api/v1','namespace' => 'App\Http\Controllers'], function($app)){
	$app->post('login/','UsersController@authenticate');

	$app->group(['prefix' => 'cantina'], function($app)){
		$app->get('produtos/','ProductsController@index');
		$app->put('produto/','ProductsController@store');
		$app->delete('produto/{product}/','ProductsController@delete');
		$app->post('produto/{product}/','ProductsController@update');
		$app->get('produto/{product}/','ProductsController@get');

		$app->get('/pedidos/today/','RequestsController@getRequests');
		$app->get('pedidos/','RequestsController@index');
		$app->post('pedido/{request}/','RequestsController@update');
		$app->get('pedido/{request}/','RequestsController@get');
	}

	$app->group(['prefix' => 'resp'], function($app)){
		$app->get('filhos/','ProductsController@index');
		$app->put('filho/','ProductsController@store');
		$app->delete('filho/{student}/','ProductsController@delete');
		$app->post('filho/{student}/','ProductsController@update');
		$app->get('filho/{student}/','ProductsController@get');

		$app->post('pedido/{request}/','RequestsController@update');
		$app->get('pedido/{request}/','RequestsController@get');
		$app->put('pedido/','RequestsController@store');
		$app->delete('pedido/{request}/','RequestsController@delete');
		$app->get('meuspedido/','RequestsController@myRequest');
	}
}
