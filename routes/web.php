<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UploadController;

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

Route::get('/', function () {
    return view('welcome');
});

// upload with ajax
Route::get('/ajax-upload', [DocumentController::class, 'showUploadForm'])->name('upload-document-form');
Route::post('/ajax-upload', [DocumentController::class, 'uploadDocument']);

// upload with xhr and progress bar
Route::get('/xhr-upload', function () {
    return view('upload-document-with-xhr-progress');
});
Route::post('/xhr-upload', [UploadController::class, 'upload']);

// upload with axios and progress bar
Route::get('/axios-upload', function () {
    return view('upload-document-with-axios-progress');
});
Route::post('/axios-upload', [UploadController::class, 'upload']);

// upload with axios and progress bar and simultan
Route::get('/axios-upload-2', function () {
    return view('upload-document-with-axios-progress-simultan');
});
Route::post('/axios-upload-2', [UploadController::class, 'upload']);

// Routes for Artisan commands
Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    return 'Configuration cache cleared!';
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared!';
});

Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache cleared and cached again!';
});

Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache cleared!';
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'Application optimized!';
});
