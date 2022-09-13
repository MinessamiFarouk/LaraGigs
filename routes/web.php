<?php

use App\Http\Controllers\GigController;
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

// or we can use route model biding

Route::get('/gig/{gig}', [GigController::class, 'show']);
Route::get('/create', [GigController::class, 'create']);

