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
	}

	$app->group(['prefix' => 'resp'], function($app)){
		//$app->
	}
}
