<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Common Route Methods
/* 
1. index - Show all listings
2. show - Show single listing
3. create - Show create form
4. store - Store the listing
5. edit - Show edit form
6. update - Update the listing
7. destroy - Delete the listing

*/

Route::get('/posts/{id}', function ($id) {
    dd($id);
    return 'Post ID: ' . $id;
})->where('id', '[0-9]+');  // You can add constraints

Route::get('/search', function(Request $request){
    dd($request->name . ' ' . $request->city);
});

//All Listings
Route::get('/', [ListingController::class, 'index']);


//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create']);

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


//Store Listing
Route::post('/listings', [ListingController::class, 'store']);

//Edit Listing
Route::get('listings/{listing}/edit', [ListingController::class, 'edit']);

//Update Listing
Route::put('listings/{listing}', [ListingController::class, 'update'])->name('listings.update');

//Route Model Binding
Route::get('/listings/{listing}', [ListingController::class, 'show']);
