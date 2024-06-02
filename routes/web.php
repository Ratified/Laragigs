<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/posts/{id}', function ($id) {
    dd($id);
    return 'Post ID: ' . $id;
})->where('id', '[0-9]+');  // You can add constraints

Route::get('/search', function(Request $request){
    dd($request->name . ' ' . $request->city);
});

//All Listings
Route::get('/', [ListingController::class, 'index']);

//Single Listing
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);

//     if($listing){
//         return view('listing', [
//             'listing' => $listing
//         ]);
//     } else{
//         abort(404, 'Listing not found');
//     }
// });

//Route Model Binding
Route::get('/listings/{listing}', [ListingController::class, 'show']);
