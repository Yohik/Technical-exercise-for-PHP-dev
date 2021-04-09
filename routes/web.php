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

$router->group(['prefix' => 'api/user'], function () use ($router) {
    $router->get('check', 'AuthController@check');
    $router->post('register', 'AuthController@register');
    $router->post('sign-in', 'AuthController@signIn');

    $router->addRoute(['POST', 'PATCH'], 'recover-password', [ 'as' => 'password.email', 'uses' => 'RequestPasswordController@sendResetLinkEmail' ]);

    $router->post('/password/reset', [ 'as' => 'password.update', 'uses' => 'ResetPasswordController@reset' ]);
    $router->get('/password/reset/{token}', [ 'as' => 'password.reset', 'uses' => 'ResetPasswordController@showResetForm' ]);


    $router->get('companies', 'CompanyController@getCompanies');
    $router->post('companies', 'CompanyController@addCompany');
});
