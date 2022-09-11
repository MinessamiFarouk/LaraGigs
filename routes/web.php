<?php

use Illuminate\Support\Facades\Route;
use App\Models\Gig;

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

Route::get('/', function () {
    return view('gigs', [
        "heading" => "The Last Gigs",
        "gigs" => Gig::all()
    ]);
});

Route::get('/gig/{id}', function($id) {
    return view('findgig', ["gig" => Gig::find($id)]);
});

// Route::get('posts/{id}', function($id) {
//     return response("post " . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request) {
//     dd($request);
// });
