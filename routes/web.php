<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;

// use App\Http\Controllers\auth\LoginController;



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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/products/{id}', [PageController::class, 'getProduct'])->name('get.product');
Route::get('/productfilter/{idCat}/{idBrand}', [PageController::class, 'getProductFilter'])->name('get.productfilter');
Route::get('/productdetail/{id}', [PageController::class, 'getProductDetail'])->name('get.productdetail');
Route::get('/cart', [PageController::class, 'getCart'])->name('get.cart');
Route::get('/search', [PageController::class, 'search'])->name('get.search');


Route::get('/addCart/{id}', [PageController::class, 'addCart'])->name('addCart');
Route::get('deleteCart/{id}', [PageController::class, 'deleteCart'])->name('deleteCart');
Route::get('destroyCart', [PageController::class, 'destroyCart'])->name('destroyCart');
Route::get('updateCart/{rowId}', [PageController::class, 'updateCart'])->name('updateCart');
Route::get('updateCartAll', [PageController::class, 'updateCartAll'])->name('updateCartAll');

Route::get('checkOut', [PageController::class, 'checkOut'])->name('checkOut')->middleware('auth');
Route::get('checkOutSuccess', [PageController::class, 'checkOutSuccess'])->name('checkOutSuccess')->middleware('auth');

Route::group(['prefix' => 'admin','namespace'=>'admin', 'middleware' => ['auth']], function () {
    // home
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');
    //categorie
    Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie.list');
    Route::get('/categorie/create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/categorie/store', [CategorieController::class, 'store'])->name('categorie.store');
    Route::get('/categorie/edit/{id}', [CategorieController::class, 'edit'])->name('categorie.edit');
    Route::post('/categorie/update/{id}', [CategorieController::class, 'update'])->name('categorie.update');
    Route::get('/categorie/destroy/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');
    Route::get('/categorie/search', [CategorieController::class, 'search'])->name('categorie.search');
    //brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.list');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/brand/destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::get('/brand/search', [BrandController::class, 'search'])->name('brand.search');

    //product
    Route::get('/product', [ProductController::class, 'index'])->name('product.list');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('user.list');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/search', [UserController::class, 'search'])->name('user.search');

    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order.list');
    Route::get('/order/check-order/{id}', [OrderController::class, 'checkOrder'])->name('order.check');
    Route::get('/order/show/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
});

Auth::routes();
Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
