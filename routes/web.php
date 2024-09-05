<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/about-me', [AboutMeController::class,'index'])->name('about-me');
Route::get('/interests', [InterestsController::class,'index'])->name('interests');
Route::get('/study', [StudyController::class,'index'])->name('study');
Route::get('/album', [AlbumController::class,'index'])->name('album');
Route::get('/contacts', [ContactsController::class,'index'])->name('contacts');
Route::get('/test', [TestController::class,'index'])->name('test');
Route::get('/history', [HistoryController::class,'index'])->name('history');

Route::post('/test/submit', [TestController::class,'submit'])->name('test-form');
Route::post('/contacts/submit', [ContactsController::class,'submit'])->name('contact-form');
