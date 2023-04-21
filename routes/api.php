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
        $v1GuestRoute->post('/login', 'AuthController@login');
    });

    /*
     * Routes for authenticated request
     */
    $v1Route->group(['middleware' => ['auth:api','api.tokenValid']], function ($v1Route) {

        $v1Route->group(['prefix' => 'user'], function ($userRoute) {
            $userRoute->get('/', 'UserController@authUser');
            $userRoute->put('/{id}/toggle-role', 'UserController@toggleRole');
            $userRoute->put('/{id}/toggle-permission', 'UserController@togglePermission');
            $userRoute->post('/watch-list', 'UserController@addWatchList');
            $userRoute->put('/watch-list/{id}', 'UserController@updateWatchList');
            $userRoute->get('/watch-list', 'UserController@getWatchListItems');
            $userRoute->delete('/watch-list/{id}', 'UserController@deleteWatchList');
            $userRoute->post('/change-status', 'UserController@changeUserStatus');
            $userRoute->post('/delete', 'UserController@delete');
            $userRoute->put('/{id}/subscription', 'UserController@updateSubscription');
            $userRoute->put('/{id}/setting', 'UserController@updateSetting');
            $userRoute->put('/{id}/reset-dashboards', 'UserController@resetUserDashboards');

            // Routes for user email alert
            $userRoute->get('/email-alert', 'UserController@getEmailAlerts');
            $userRoute->get('/email-alert/{id}', 'UserController@getEmailAlert');
            $userRoute->post('/email-alert', 'UserController@addEmailAlert');
            $userRoute->put('/email-alert', 'UserController@updateEmailAlert');
            $userRoute->delete('/email-alert/{id}', 'UserController@deleteEmailAlert');

            // Route for auth user relations
            $userRoute->get('/{item}', 'UserController@item');
        });

        $v1Route->get('/categories/tree', 'CategoryController@tree');
        $v1Route->get('/categories/not-subscribed', 'CategoryController@getNotSubscribed');
        $v1Route->get('/categories/{id}/tree', 'CategoryController@tree');
        $v1Route->put('/categories/order/{initCatId}/{destCatId}', 'CategoryController@order');

        $v1Route->group(['prefix'=>'module'],function ($moduleRoutes){
            $moduleRoutes->get('/{id}/news', 'NewsController@byModuleId');
        });

        $v1Route->group(['prefix' => 'news'],function ($newsRoute){
            $newsRoute->get('/tickers/', 'NewsController@tickers');
            $newsRoute->put('/{id}/toggle-parked', 'NewsController@toggleParked');
            $newsRoute->put('/{id}/toggle-editor', 'NewsController@toggleEditor');
            $newsRoute->put('/{id}/toggle-images', 'NewsController@toggleImages');
        });

        $v1Route->post('/modules/{id}/update-coordinates', 'ModuleController@updateCoordinates');
        $v1Route->post('/dashboards/{id}/change-module-state', 'DashboardController@updateActiveModules');
        $v1Route->get('/dashboards/active', 'DashboardController@getActiveDashboards');
        $v1Route->get('/dashboard/{id}/news', 'DashboardController@getAllNewsForDashboard');
        $v1Route->put('/dashboards/{id}/update-dashboards-list', 'DashboardController@updateActiveList');
        $v1Route->group(['prefix' => 'settings'], function ($settingsRoute) {
            $settingsRoute->put('/', 'SettingsController@update');
            $settingsRoute->post('/change-theme', 'SettingsController@changeTheme');
        });

        $v1Route->resource('dashboards', 'DashboardController', RouteService::optional());
        $v1Route->resource('modules', 'ModuleController', RouteService::optional());
        $v1Route->resource('users', 'UserController', RouteService::optional());
        $v1Route->resource('categories', 'CategoryController', RouteService::optional());
        $v1Route->resource('subscriptions', 'SubscriptionController', RouteService::optional());
        $v1Route->resource('tickers', 'TickerController', RouteService::tickerOptional());
        $v1Route->resource('news', 'NewsController');
        $v1Route->resource('images', 'ImageController');

        $v1Route->post('/logout', 'AuthController@logout');

    });
});
