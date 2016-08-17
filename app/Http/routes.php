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

$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\V1', 'middleware'=>'auth'], function() use($app){
    $app->get('/users/{userId}/banks', 'BanksController@index');
    $app->get('/users/{userId}/banks/{bankId}', 'BanksController@read');
    $app->post('/users/{userId}/banks', 'BanksController@create');
    $app->put('/users/{userId}/banks/{bankId}', 'BanksController@update');
    $app->delete('/users/{userId}/banks/{bankId}', 'BanksController@delete');
    $app->post('/users/{userId}/banks/{bankId}/withdrawal', 'BanksController@withdrawal');
    $app->get('/withdrawals', 'WithdrawalsController@index');
});
