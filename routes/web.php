<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\segmentController;
use App\Http\Controllers\subscriberController;

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
//
Route::get('/', [segmentController::class, 'segmentPage'])->name('/');
Route::post('/segment/add', [segmentController::class, 'segmentAdd'])->name('segment-add');
Route::get('subscribers', [subscriberController::class, 'subscribersPage'])->name('subscribers');
Route::get('subscriber/add', [subscriberController::class, 'addSubscriberPage'])->name('subscriber-add');
Route::get('segment/subscribers/{target_segment}', [segmentController::class, 'showData'])->name('show-data');
Route::post('subscribers/add/action', [subscriberController::class, 'addSubscriber'])->name('subscriber-add-action');
