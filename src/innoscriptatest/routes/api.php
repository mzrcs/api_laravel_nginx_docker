<?php

use App\Helpers\ApiResponseHandler;
use App\Helpers\Constant;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsfeedController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/user', [UserController::class, 'getLoggedInUserData']);
    Route::patch('/user', [UserController::class, 'updateLoggedUserData']);
    Route::post('/newsfeed', [NewsfeedController::class, 'getNewsfeeds']);

    //this should be a controller and get categories from API
    Route::get('/categories', function ()
    {
        $categories = array_flip(Constant::NewsFeedCategories);
        return ApiResponseHandler::success($categories, ''); 
    });

    //this should be a controller and get sources from API
    Route::get('/sources/category/{categoryName}', function ($categoryName)
    {
        $sources = Constant::NewsFeedSources;
        if($categoryName != "all"){
            $sources = array_filter($sources, function($source) use($categoryName) {
               return $source['category'] == $categoryName;
            });
        }
       return ApiResponseHandler::success([...$sources], ''); 
    });

});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
