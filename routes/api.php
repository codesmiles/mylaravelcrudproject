<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use
App\Http\Controllers\UserController;


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

// if your app performs CRUD operations on a model, you can use the resource route:
    // Route::resource('users', UserController::class); // will work

    // else you can use the api route:
Route::get('/welcome',[UserController::class,'welcome']);

Route::post('/register', [UserController::class, 'store']);

Route::get('/get-all-users', [UserController::class, 'index']);

Route::get('/get-one-user/{id}', [UserController::class, 'show']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
