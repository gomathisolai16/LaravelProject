<?php

use App\Services\RouteService;

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


/*
 * API version 1 Routes
 */
Route::group(['namespace' => 'V1\Controllers'], function ($v1Route) {

    /*
     * Routes for not authenticated users
     */
    $v1Route->get('/is-token-valid', 'AuthController@tokenStatus');

    $v1Route->group(['middleware' => 'guest'], function ($v1GuestRoute) {
    });

    /*
     * Routes for authenticated request
     */
    $v1Route->group(['middleware' => ['auth:api','api.tokenValid']], function ($v1Route) {

        $v1Route->group(['prefix' => 'user'], function ($userRoute) {
            $userRoute->get('/', 'UserController@authUser');
            $userRoute->put('/{id}/toggle-role', 'UserController@toggleRole');
            $userRoute->put('/{id}/toggle-permission', 'UserController@togglePermission');

            // Routes for user email alert

            // Route for auth user relations
            $userRoute->get('/{item}', 'UserController@item');
        });

        $v1Route->get('/categories/tree', 'CategoryController@tree');

        $v1Route->group(['prefix'=>'module'],function ($moduleRoutes){
            $moduleRoutes->get('/{id}/news', 'NewsController@byModuleId');
        });

        $v1Route->group(['prefix' => 'news'],function ($newsRoute){
            $newsRoute->get('/tickers/', 'NewsController@tickers');
        });
;
        $v1Route->resource('tickers', 'TickerController', RouteService::tickerOptional());
        $v1Route->resource('news', 'NewsController');
        $v1Route->resource('images', 'ImageController');

        $v1Route->post('/logout', 'AuthController@logout');

    });
});
