<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopifyOrderController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
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

Auth::routes([
    'register' => false, // Register Routes
    'verify' => false, // Email Verification Routes  
]);

// Dashboard route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::middleware('can:shopify-order-retry')->get('shopify-orders/{shopifyOrder}/retry', [ShopifyOrderController::class, 'retry'])->name('shopify-orders.retry');
    Route::get('/tokens', [TokenController::class, 'index'])->name('tokens.index');
    Route::get('/tokens/generate', [TokenController::class, 'create'])->name('tokens.create');
    Route::post('/tokens/generate', [TokenController::class, 'generate'])->name('tokens.generate');
    Route::delete('/tokens/{id}/destroy', [TokenController::class, 'destroy'])->name('tokens.destroy');
    Route::delete('/tokens/destroy-all', [TokenController::class, 'revokeAll'])->name('tokens.delete-all');
    Route::resource('settings', SettingController::class);

});
