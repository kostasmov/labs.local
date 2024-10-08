<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VisitorStatsController;

use App\Http\Middleware\LogVisitor;
use App\Http\Middleware\AdminMiddleware;


Route::middleware([LogVisitor::class])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('interests', [InterestsController::class,'index'])->name('interests');
    Route::get('/album', [AlbumController::class,'index'])->name('album');
    Route::get('/contacts', [ContactsController::class,'index'])->name('contacts');
    Route::get('/test', [TestController::class,'index'])->name('test');
    Route::get('/guestbook', [GuestbookController::class,'index'])->name('guestbook');
    Route::get('/blog', [BlogController::class,'index'])->name('blog');
});

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/visitor-stats', [VisitorStatsController::class,'index'])->name('visitor-stats');

    Route::get('/blog/loader', [BlogController::class,'loader'])->name('blog-loader');
    Route::get('/blog/editor', [BlogController::class,'editor'])->name('blog-editor');
    Route::post('/blog/submit', [BlogController::class,'submit'])->name('blog-form');
    Route::post('/blog/data/submit', [BlogController::class,'update_blog'])->name('update-blog');
    Route::post('/blog/upload', [BlogController::class,'upload'])->name('blog-upload');

    Route::get('/guestbook/loader', [GuestbookController::class,'loader'])->name('guestbook-loader');
    Route::post('/guestbook/upload', [GuestbookController::class,'upload'])->name('guestbook-upload');
});

Route::get('/login', [AuthController::class,'login_view'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/check-login', [AuthController::class,'check_login'])->name('check-login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class,'register_view'])->name('register');
Route::post('/register', [AuthController::class,'register']);

Route::post('/blog/comment/submit', [BlogController::class,'comment_submit'])->name('send-comment');
Route::post('/test/submit', [TestController::class,'submit'])->name('test-form');
Route::post('/contacts/submit', [ContactsController::class,'submit'])->name('contact-form');
Route::post('/guestbook/submit', [GuestbookController::class,'submit'])->name('guestbook-form');
