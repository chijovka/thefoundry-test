<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.', 'middleware' => ['api']], function () {

    Route::get(
        '/task_2_1',
        [
            'as'   => 'task_2_1',
            'uses' => 'TasksController@task_2_1',
        ]
    );

    Route::get(
        '/task_2_2',
        [
            'as'   => 'task_2_2',
            'uses' => 'TasksController@task_2_2',
        ]
    );

    Route::get(
        '/task_3_1',
        [
            'as'   => 'task_3_1',
            'uses' => 'TasksController@task_3_1',
        ]
    );

    Route::get(
        '/task_3_2',
        [
            'as'   => 'task_3_2',
            'uses' => 'TasksController@task_3_2',
        ]
    );

});
