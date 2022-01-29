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

$router->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($router){
	$router->group(['prefix' => 'v1', 'namespace' => 'V1'], function () use ($router){
		$router->group(['prefix' => 'user'], function () use ($router){
			$router->post('register', ['as' => 'user.register', 'uses' => 'AuthController@register']);
			$router->post('sign-in', ['as' => 'user.signIn', 'uses' => 'AuthController@signIn']);
			$router->patch('recover-password', ['as' => 'user.recoveryPassword', 'uses' => 'AuthController@recoveryPassword']);

			$router->group(['middleware' => 'auth'], function () use ($router) {
				$router->get('companies', ['as' => 'user.companies', 'uses' => 'UserController@companies']);
				$router->post('companies', ['as' => 'company.store', 'uses' => 'CompanyController@store']);
			});
		});
	});
});