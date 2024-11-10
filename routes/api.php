<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'namespace' => 'Api'
], function () {

    //blog
    Route::get('/blog/detail/{id}',[BlogController::class, 'detail']);
    Route::post('users/login', [MemberController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('users/my-product',[ProductController::class, 'index']); 


    });
});