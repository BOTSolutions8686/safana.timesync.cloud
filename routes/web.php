<?php

use Carbon\Carbon;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\ValidationMessageController;
use App\Http\Controllers\Frontend\NavigatorController;
use App\Http\Controllers\Frontend\Auth\LoginController;


Route::get('create-user', [DevController::class, 'lol']);


Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
	$aaa = Artisan::call('optimize:clear'); 
    return 'storage-linked Successfully';
})->middleware('xss');


Route::get('sign-in', [LoginController::class, 'adminLogin'])->name('adminLogin')->middleware('xss');
Route::group(['middleware' => ['xss','MaintenanceMode','redirect']], function () {
    Route::get('/', [NavigatorController::class, 'index'])->name('home');
    Route::get('/home', [NavigatorController::class, 'index']);
    
});

Auth::routes();
//admin routes here
include_route_files(__DIR__ . '/admin/');

//frontend routes here
include_route_files(__DIR__ . '/frontend/');

// Route::domain('{username}.24hourworx.com')->group(function () {
//     Route::get('user/{id}', function ($username, $id) {
//         dd($username, $id);
//     });
// });

// Route::domain('sookh' . 'hrm.test')->group(function () {
//     Route::get('user/{id}', function ($username, $id) {
//         dd($username, $id);
//     });
// });

//====================Validation Message Generate===============================
Route::get('validation-message-generate', function () {
    return view('validation-message-generate');
})->name('test')->middleware('xss');
Route::POST('validation-message-generate', [ValidationMessageController::class, 'messageGenerate'])->name('message_generate')->middleware('xss');

Route::get('sync-flugs/{language_name}',[DevController::class, 'syncFlug']);
