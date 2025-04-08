<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\crud;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth','role:user')->group(function () {
    Route::get('/home',[crud::class,'home'])->name('user.dashboard');
    Route::get('/cart', [crud::class, 'cart'])->name('user.cart');
    Route::post('/cart/{id}', [crud::class, 'cartStore']);
    Route::post('/order/{id}', [crud::class, 'order'])->name('order');
    Route::post('/confirm/order/{id}', [crud::class, 'confirmOrderFinal'])->name('confirm.order');
    Route::post('/bayar/order/{id}', [crud::class, 'bayarOrder'])->name('bayar.order');
    Route::get('/your/order',[crud::class,'userOrder'])->name('user.order');
    Route::post('/delete/cart/{id}', [crud::class, 'deleteCart'])->name('delete.cart');
    Route::get('/search', [crud::class, 'search'])->name('search');
});

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/create', [crud::class, 'create'])->name('create');
    Route::post('/create', [crud::class, 'store'])->name('create');
    Route::post('/delete/{id}', [crud::class, 'delete'])->name('delete');
    Route::post('/edit/{id}', [crud::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [crud::class, 'update']);
    Route::get('/stock', [crud::class, 'read'])->name('stock');
    Route::get('/order/come', [crud::class, 'comeOrder'])->name('come.order');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/proses/order/{id}', [crud::class, 'prosesOrder'])->name('proses.order');
    Route::post('/success/order/{id}', [crud::class, 'prosesOrder'])->name('success.order');

});

require __DIR__.'/auth.php';
