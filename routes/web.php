<?php

use App\Http\Controllers\GigController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [GigController::class, 'index']);
// we can use the findOrFail to rout us to 404 page if the use want to go to gig that not exist

// Route::get('/gig/{id}', function($id) {
//     return view('showgig', ["gig" => Gig::findOrFail($id)]);
// });

// Route::get('/gigs/create', [GigController::class, 'create']);

// or we can use route model biding
// Route::get('/gigs/{gig}', [GigController::class, 'show']);

Route::resource('/gigs', GigController::class);


//user show (register page, login page)
Route::get("/users.register", [userController::class, "register"]);
Route::get("/users.login", [userController::class, "login"]);

// store the user
Route::post('/users', [userController::class, 'store']);

// logout
Route::post('/logout', [userController::class, 'logout']);

// log in
Route::post("/authenticate", [userController::class, 'authenticate']);


