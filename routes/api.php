<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/posts', function (){
    return response()->json([
        'posts' => [
            'title' => 'My first post',
            'content' => 'This is my first post'
        ]
    ]);
});