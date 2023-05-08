<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\FriendController;

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

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/series', [SerieController::class, 'index']);
Route::get('/series/{id}', [SerieController::class, 'show']);
Route::post('/series', [SerieController::class, 'store']);
Route::put('/series/{id}', [SerieController::class, 'update']);
Route::delete('/series/{id}', [SerieController::class, 'destroy']);

Route::get('/chats', [ChatController::class, 'index']);
Route::get('/chats/{id}', [ChatController::class, 'show']);
Route::post('/chats/{id_profile}/create', [ChatController::class, 'create']);
Route::delete('/chats/{id}', [ChatController::class, 'destroy']);

Route::get('roles', [RoleController::class, 'index']);
Route::get('roles/{id}', [RoleController::class, 'show']);
Route::post('roles', [RoleController::class, 'store']);
Route::put('roles/{id}', [RoleController::class, 'update']);
Route::delete('roles/{id}', [RoleController::class, 'destroy']);

Route::post('/reviews', [ReviewController::class, 'create']);
Route::post('/reviews/store', [ReviewController::class, 'store']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
Route::get('/reviews', [ReviewController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profiles.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
Route::delete('/profile/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

Route::post('/messages', [MessageController::class, 'store']);
Route::get('/messages', [MessageController::class, 'index']);
Route::delete('/messages/{id}', [MessageController::class, 'destroy']);

Route::get('/groups', [GroupController::class, 'index']);
Route::get('/groups/{id}', [GroupController::class, 'show']);
Route::post('/groups', [GroupController::class, 'store']);
Route::put('/groups/{id}', [GroupController::class, 'update']);
Route::delete('/groups/{id}', [GroupController::class, 'destroy']);

Route::get('/friends', [FriendController::class, 'index']);
Route::get('/friends/{id}', [FriendController::class, 'show']);
Route::post('/friends', [FriendController::class, 'store']);
Route::put('/friends/{id}', [FriendController::class, 'update']);
Route::delete('/friends/{id}', [FriendController::class, 'destroy']);

Route::get('/episodes', [EpisodeController::class, 'index']);
Route::post('/episodes', [EpisodeController::class, 'store']);
Route::get('/episodes/{id}', [EpisodeController::class, 'show']);
Route::put('/episodes/{id}', [EpisodeController::class, 'update']);
Route::delete('/episodes/{id}', [EpisodeController::class, 'destroy']);

Route::get('/collections', [CollectionController::class, 'index']);
Route::post('/collections', [CollectionController::class, 'store']);
Route::get('/collections/{collection}', [CollectionController::class, 'show']);
Route::put('/collections/{collection}', [CollectionController::class, 'update']);
Route::delete('/collections/{collection}', [CollectionController::class, 'destroy']);
