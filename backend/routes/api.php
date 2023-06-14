<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// --------------------------------------------------------------------------
/**
 * Public APIs
 * */ 

    /**
     * User Registeration
     * @method POST
     * @param [name, email, password, password_confirmation]
     */
    Route::post('/register', [AuthController::class, 'register']);

    /**
     * User Login
     * @method POST
     * @param [email, password]
     */
    Route::post('/login', [AuthController::class, 'login']);

// --------------------------------------------------------------------------
/**
 * Private APIs
 * You need the token in the header for accessing the following apis
 */
    Route::group(['middleware' => ['auth:sanctum']], function () {

        /**
         * Fetch User details
         * @method GET
         */
        Route::get('/users', [AuthController::class, 'index']);

        /**
         * User Logout
         * @method POST
         */
        Route::post('/logout', [AuthController::class, 'logout']);

        /**
         * Add updated news from the three sources
         * - Media Stack
         * - News API
         * - The Guardian
         * @method POST
         */
        Route::get('/add-news', [ArticleController::class, 'addNews']);

        /**
         * Fetch Articles
         * @method GET
         */
        Route::get('/articles', [ArticleController::class, 'index']);

        /**
         * Fetch Feed Articles
         * @method GET
         */
        Route::get('/feed', [ArticleController::class, 'feed']);

        /**
         * Fetch Fields
         * @method GET
         */
        Route::get('/getFields', [ArticleController::class, 'getFields']);

        /**
         * Fetch Settings
         * @method GET
         */
        Route::get('/getSetting', [SettingController::class, 'getSetting']);

        /**
         * ADD Setting
         * @method POST
         * @param [user_id, name, type]
         */
        Route::post('/addSetting', [SettingController::class, 'addSetting']);

        /**
         * User Logout
         * @method POST
         * @param [user_id, name, type]
         */
        Route::post('/deleteSetting', [SettingController::class, 'deleteSetting']);
    });

// --------------------------------------------------------------------------
