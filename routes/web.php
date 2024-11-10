<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\CountryController;

use App\Http\Controllers\BlogController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\BrandController;

use App\Http\Controllers\Frontend\RegisterController;

use App\Http\Controllers\Frontend\LoginController;

use App\Http\Controllers\Frontend\BlogfrontendController;

use App\Http\Controllers\Frontend\AccountController;

use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\MailController;

use App\Models\Frontend\Products;
use Illuminate\Support\Facades\Auth;

// Route::get('admin/blog', function () {
//     return view('admin/blog');
// });

Auth::routes();

Route::group([
    'middleware' => ['admin']
], function () {
    Route::get('admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('admin/profile',[UserController::class, 'index']);
    Route::post('admin/profile',[UserController::class, 'update']);
    // Route::get('admin/country', function () {
    //     return view('admin/country');
    // });
    Route::get('admin/country',[CountryController::class, 'index'])->name('admin.country');
    
    Route::get('admin/country/add',[CountryController::class, 'add_country']);
    Route::post('admin/country/add',[CountryController::class, 'create']);
    
    Route::get('admin/country/edit/{id}',[CountryController::class, 'edit']);
    Route::post('admin/country/edit/{id}',[CountryController::class, 'update']);
    
    Route::get('admin/country/delete/{id}',[CountryController::class, 'destroy']);
    
    //Blog
    
    Route::get('admin/blog',[BlogController::class, 'index'])->name('admin.blog');
    
    Route::get('admin/blog/add',[BlogController::class, 'add_blog']);
    Route::post('admin/blog/add',[BlogController::class, 'create']);
    
    Route::get('admin/blog/edit/{id}',[BlogController::class, 'edit']);
    Route::post('admin/blog/edit/{id}',[BlogController::class, 'update']);
    
    Route::get('admin/blog/delete/{id}',[BlogController::class, 'destroy']);
    
    // Category
    
    Route::get('admin/category',[CategoryController::class, 'index'])->name('admin.category');
    
    Route::get('admin/category/add',[CategoryController::class, 'add_category']);
    Route::post('admin/category/add',[CategoryController::class, 'create']);
    
    Route::get('admin/category/edit/{id}',[CategoryController::class, 'edit']);
    Route::post('admin/category/edit/{id}',[CategoryController::class, 'update']);
    
    Route::get('admin/category/delete/{id}',[CategoryController::class, 'destroy']);
    
    //Brand
    
    Route::get('admin/brand',[BrandController::class, 'index'])->name('admin.brand');
    
    Route::get('admin/brand/add',[BrandController::class, 'add_brand']);
    Route::post('admin/brand/add',[BrandController::class, 'create']);
    
    Route::get('admin/brand/edit/{id}',[BrandController::class, 'edit']);
    Route::post('admin/brand/edit/{id}',[BrandController::class, 'update']);
    
    Route::get('admin/brand/delete/{id}',[BrandController::class, 'destroy']);
});





// Route::get('admin/blog', function () {
//     return view('admin/blog');
// });
// Route::get('admin/blog/add', function () {
//     return view('admin/addblog');
// });

//FrontEnd

Route::group([
    'middleware' => ['memberIsLogin']
], function () {
    Route::get('users/login',[LoginController::class, 'index'])->name('users.login');
    Route::post('users/login',[LoginController::class, 'login']);

    Route::get('users/register',[RegisterController::class, 'index']);
    Route::post('users/register',[RegisterController::class, 'create']);
});

Route::group([
    'middleware' => ['user']
], function() {

    Route::get('blog',[BlogfrontendController::class, 'index']);
    Route::get('blog/detail/{id}',[BlogfrontendController::class, 'detail']);
    Route::post('blog/rate',[BlogfrontendController::class, 'store']);
    Route::post('blog/cmt',[BlogfrontendController::class, 'cmt']);

    Route::get('users/account', function () {
        return view('frontend/members/account');
    });

    Route::get('users/logout',[LoginController::class, 'checkLogin']);

    Route::get('users/account',[AccountController::class, 'profileUser']);
    Route::post('users/account',[AccountController::class, 'updateProfileUser']);


    Route::get('users/my-product',[ProductController::class, 'index']);

    Route::get('users/add-product',[ProductController::class, 'add_product']);
    Route::post('users/add-product',[ProductController::class, 'create']);

    Route::get('users/product/edit/{id}',[ProductController::class, 'edit']);
    Route::post('users/product/edit/{id}',[ProductController::class, 'update']);

    Route::get('users/product/delete/{id}',[ProductController::class, 'destroy']);

    Route::get('/',[ProductController::class, 'home'])->name('frontend.index');

    Route::get('users/product/detail/{id}',[ProductController::class, 'detail_product']);

    Route::post('users/product/add-to-cart',[ProductController::class, 'add_to_cart']);

    Route::get('users/cart',[ProductController::class, 'list_cart']);
    Route::post('users/cart',[ProductController::class, 'update_cart']);

    Route::get('users/checkout',[ProductController::class, 'checkout']);

    Route::get('test',[MailController::class, 'index']);

    Route::get ('/search',[SearchController::class, 'search']);

    Route::post ('/search-advanced',[SearchController::class, 'searchPost']);

    Route::post ('/search-price',[SearchController::class, 'searchPrice']);

});



