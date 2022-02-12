<?php

use App\Http\Controllers\ContactController;
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

Route::get('/',[ContactController::class, 'index'])->name('contacts.index');
Route::get('contact/{id}',[ContactController::class, 'show'])->name('contacts.show');


Route::middleware(['auth'])->group(function () {  
    Route::resource('contacts', ContactController::class)->except('index','show'); 
    Route::resource('users', UserController::class); 

});

//Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');


require __DIR__.'/auth.php';
