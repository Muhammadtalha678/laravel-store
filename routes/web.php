<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// this is for admin verified and auth
Route::middleware(['auth', 'verified','admin'])->group(function () {
    //this is for Admin Dashboard
    Route::controller(AdminDashboardController::class)->prefix('admin')->group(function () {
        Route::get('/dashboard','index')->name("adminDashboard");
    });
    //this is for Admin Category
    Route::controller(CategoryController::class)->prefix('admin')->group(function () {
        Route::get('/category/add','add')->name("adminCategory"); //add page
        Route::post('/category/add/store','store')->name("adminCategory.store");//store page
        Route::get("/category/all","index")->name("adminCategory.all");//All page
        Route::post("/category/search","categorySearch")->name("adminCategory.search"); //searching
        Route::get('/category/edit/{id}','edit')->name('adminCategory.edit');
        Route::patch('/category/edit/store','update')->name('adminCategory.editStore');
        Route::delete('/category/delete/{id}','delete')->name('adminCategory.delete');
        Route::post('/clear-search-session', 'clearSearchSession')->name('clearSearchSession');//clear session with F5
    });
    //this is for Admin Product
    Route::controller(ProductController::class)->prefix('admin')->group(function () {
        Route::get('/products','index')->name('adminProduct.all');//add page
        Route::get('/product/add','add')->name('adminProduct.add');//add page
        Route::post('/product/add/store','store')->name('adminProduct.store');//STORE page
        Route::post('/product/search','productSearch')->name('adminProduct.search');
        Route::get('/product/edit/{id}','edit')->name('adminProduct.edit');
        Route::patch('/product/edit/store','update')->name('adminProduct.editStore');
        Route::delete('/product/delete/{id}','delete')->name('adminProduct.delete');
        
        
        Route::post('/clear-search-session/product', 'clearSearchSession')->name('clearSearchSession.Product');//clear session with F5
    });
    //this is for Admin Banner Images 
    Route::controller(BannerController::class)->prefix('admin')->group(function () {
        Route::get('/banner/add', 'add')->name('adminBanner.add');
        Route::post('/banner/add/store', 'store')->name('adminBanner.store');
        Route::get('/banner/images', 'index')->name('adminBanner.index');
        Route::get('/banner/edit/{id}','edit')->name('adminBanner.edit');
        Route::patch('/banner/edit/store','update')->name('adminBanner.editStore');
    });
});



//  is ko is liye alg kra hwa ha agr user email change krta ha to phr wo direct email.verifiy.blade
//  page pr chla jay ga isiye Middleware auth or admin ki hi rkhi ha verified ni rkhi 
Route::middleware('auth','admin')->prefix('admin')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [App\Http\Controllers\Admin\AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('profile.update');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Admin\AdminProfileController::class, 'destroy'])->name('profile.destroy');
});
// this is for user who logging as user 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user',[UserController::class,'index'])->name('user');
    Route::get('/logout',[UserController::class,'logout'])->name('user.logout');
});
require __DIR__.'/auth.php';
