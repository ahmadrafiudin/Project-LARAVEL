<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Master\AssetController; 
use App\http\Controllers\Administration\MenuController;
use App\http\Controllers\Administration\GroupMenuController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // route Asset
    // Route::resource('master/aset', AssetController::class);
    // Route::get('/aset', [AssetController::class, 'index'])->name('aset.index');
    
    Route::resource('master/aset', AssetController::class)->names('aset');

    Route::resource('administration/menu', MenuController::class)->names('menu');

    Route::resource('administration/groupmenu', GroupMenuController::class)->names('groupmenu');


});



require __DIR__.'/auth.php';
