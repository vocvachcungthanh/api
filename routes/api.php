<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

// admin
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\UploadFileController;
use App\Http\Controllers\Admin\CoupldeController;
use App\Http\Controllers\Admin\BgsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CountDownController;
use App\Http\Controllers\Admin\MusicController;


//public
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SliderPublicControll;
use App\Http\Controllers\AlbumPublicController;
use App\Http\Controllers\CoupledPublicController;
use App\Http\Controllers\EventPublicController;
use App\Http\Controllers\CountDownPublicController;
use App\Http\Controllers\MusicPublicController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResources([
    'login' => LoginController::class
]);

Route::middleware(['LoginToken'])->group(function () {
    Route::apiResources([
        'admin/auth'        => AuthController::class,
        'admin/sliders'     => SliderController::class,
        'admin/albums'      => AlbumController::class,
        'menus'             => MenuController::class,
        'admin/couples'     => CoupldeController::class,
        'admin/bgs'         => BgsController::class,
        'admin/events'      => EventController::class,
        'admin/countdowns'  => CountDownController::class,
        'admin/music'       => MusicController::class

    ]);

    Route::post('admin/slider-create', [SliderController::class,'create']);
    Route::post('admin/slider-status', [SliderController::class,'edit']);
    Route::post('admin/slider-delete', [SliderController::class,'delete']);
    Route::post('admin/upload-file', [UploadFileController::class,'UploadFile']);
    Route::post('admin/upload-delete-file', [UploadFileController::class, 'DeleteFileGoogle']);
    Route::post('admin/album-create', [AlbumController::class,'create']);
    Route::post('admin/album-status', [AlbumController::class,'edit']);
    Route::post('admin/album-delete', [AlbumController::class,'delete']);
    Route::post('admin/couple-create', [CoupldeController::class,'create']);
    Route::post('admin/bgs-create', [BgsController::class,'create']);
    Route::post('admin/event-create', [EventController::class,'create']);
    Route::post('admin/count-down-create', [CountDownController::class,'create']);
    Route::post('admin/music-create', [MusicController::class,'create']);
    Route::post('admin/music-delete', [MusicController::class,'delete']);

});


Route::get('/sliders',[SliderPublicControll::class,'index']);
Route::get('/menus',[MenuController::class,'index']);
Route::get('/albums/{album}',[AlbumPublicController::class,'index']);
Route::get('/couples',[CoupledPublicController::class,'index']);
Route::get('/events',[EventPublicController::class,'index']);
Route::get('/count-down',[CountDownController::class,'index']);
Route::get('/music',[MusicPublicController::class,'index']);

