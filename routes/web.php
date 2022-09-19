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
// we can use the findOrFail to rout us to 404 page if the user want to go to gig that not exist

// Route::get('/gig/{id}', function($id) {
//     return view('showgig', ["gig" => Gig::findOrFail($id)]);
// });

// show create form
Route::get("/gigs/create", [GigController::class, 'create'])->middleware('auth');

// store gigs data
Route::post("/gigs", [GigController::class, "store"])->middleware('auth');

// show edite form
Route::get("/gigs/{gig}/edit", [GigController::class, "edit"])->middleware("auth");

// update gig
Route::put("/gigs/{gig}", [GigController::class, "update"])->middleware('auth');

// delete gig
Route::delete("/gigs/{gig}", [GigController::class, "destroy"])->middleware("auth");

// show gig
Route::get('/gigs/{gig}', [GigController::class, 'show']);



//user show (register page, login page)
Route::get("/users.register", [userController::class, "register"])->middleware("guest");
Route::get("/users.login", [userController::class, "login"])->name("login")->middleware("guest");

// store the user
Route::post('/users', [userController::class, 'store']);

// logout
Route::post('/logout', [userController::class, 'logout'])->middleware('auth');

// log in
Route::post("/authenticate", [userController::class, 'authenticate']);


