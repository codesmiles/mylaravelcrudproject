<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
        // PUBLIC ROUTES
Route::get('/welcome',[UserController::class,'welcome']);
Route::post("create-userAdmin", [UserController::class, 'userAdminRegister']); //ADMIN
Route::post("admin-login",[UserController::class, "userAdminlogin"]);
Route::post('/create-user', [UserController::class, 'store']);
Route::get('/get-all-users', [UserController::class, 'index']);
Route::get('/get-one-user/{id}', [UserController::class, 'show']);
Route::get('/get-user-by-username/{name}', [UserController::class, 'search']);

// protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/login-user', [UserController::class, 'userAdminLogin']);
    Route::post('/update-user/{id}', [UserController::class, 'update']);
    Route::post('/delete-user/{id}', [UserController::class, 'destroy']);
    Route::post("logout", [UserController::class, 'logout']); //USER
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
