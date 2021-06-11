<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\CartController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontProductListController::class,'index']);
Route::get('/product/{id}',[FrontProductListController::class,'show'])->name('product.view');
Route::get('/category/{name}',[FrontProductListController::class,'allProduct'])->name('product.list');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/addToCart/{product}',[CartController::class,'addToCart'])->name('add.cart');
Route::get('/cart',[CartController::class,'showCart'])->name('cart.show');
Route::post('/products/{product}',[CartController::class,'updateCart'])->name('cart.update');

Route::group(['prefix'=>'auth','middleware'=>['auth','isAdmin']],function(){
    Route::get('/dashboard',function(){
        return view('admin.dashboard');
    });
    Route::get('subcategories/{id}',[ProductController::class,'loadSubCategories']);
    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubcategoryController::class);
    Route::resource('product',ProductController::class);
});



