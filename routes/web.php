<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/img/news/{fileName}', function ($filename)
{
    return \App\Services\PathService::forEnv()->getResponse($filename);
});

Route::get('/img/news/{folder}/{fileName}', function ($folder, $filename)
{
    return \App\Services\PathService::forEnv()->getResponse("$folder/$filename");
});

Route::get('/', function () {
    return view('welcome');
})->middleware('adminBasicAuth');
