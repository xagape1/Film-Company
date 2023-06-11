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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\IntroController;


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


Route::get('/covers', [CoverController::class, 'index'])->name('covers.index');
Route::get('/covers/create', [CoverController::class, 'create'])->name('covers.create');
Route::post('/covers', [CoverController::class, 'store'])->name('covers.store');
Route::get('/covers/{cover}', [CoverController::class, 'show'])->name('covers.show');
Route::get('/covers/{cover}/edit', [CoverController::class, 'edit'])->name('covers.edit');
Route::put('/covers/{cover}', [CoverController::class, 'update'])->name('covers.update');
Route::delete('/covers/{cover}', [CoverController::class, 'destroy'])->name('covers.destroy');

Route::get('/intros', [IntroController::class, 'index'])->name('intros.index');
Route::get('/intros/create', [IntroController::class, 'create'])->name('intros.create');
Route::post('/intros', [IntroController::class, 'store'])->name('intros.store');
Route::get('/intros/{intro}', [IntroController::class, 'show'])->name('intros.show');
Route::get('/intros/{intro}/edit', [IntroController::class, 'edit'])->name('intros.edit');
Route::put('/intros/{intro}', [IntroController::class, 'update'])->name('intros.update');
Route::delete('/intros/{intro}', [IntroController::class, 'destroy'])->name('intros.destroy');


Route::apiResource('files', FileController::class,);
Route::post('files/{file}', [FileController::class, 'update_post']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    
Route::post('/register', 'App\Http\Controllers\TokenController@register');
Route::post('/login', 'App\Http\Controllers\TokenController@login');
Route::post('/logout', 'App\Http\Controllers\TokenController@logout')->middleware(['auth:sanctum']);
Route::get('/user', 'App\Http\Controllers\TokenController@user')->middleware(['auth:sanctum']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::apiResource("series", SerieController::class);

// Route::get('/series', [SerieController::class, 'index']);
// Route::get('/series/{id}', [SerieController::class, 'show']);
// Route::post('/series', [SerieController::class, 'store']);
// Route::put('/series/{id}', [SerieController::class, 'update']);
// Route::delete('/series/{id}', [SerieController::class, 'destroy']);

Route::get('/chats', [ChatController::class, 'index']);
Route::get('/chats/{id}', [ChatController::class, 'show']);
Route::post('/chats/{id_profile}/create', [ChatController::class, 'create']);
Route::delete('/chats/{id}', [ChatController::class, 'destroy']);

Route::get('roles', [RoleController::class, 'index']);
Route::get('roles/{id}', [RoleController::class, 'show']);
Route::post('roles', [RoleController::class, 'store']);
Route::put('roles/{id}', [RoleController::class, 'update']);
Route::delete('roles/{id}', [RoleController::class, 'destroy']);

Route::post('/review', [ReviewController::class, 'create']);
Route::get('review/{id}', [ReviewController::class, 'show']);
Route::post('/review/store', [ReviewController::class, 'store']);
Route::delete('/review/{id}', [ReviewController::class, 'destroy']);
Route::get('/review', [ReviewController::class, 'index']);

Route::apiResource("profile", ProfileController::class);
/*
Route::get('/profile', 'App\Http\Controllers\ProfileController@index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');
*/

Route::apiResource("movies", MovieController::class);
/*
Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
*/
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

Route::apiResource("episodes", EpisodeController::class);
/*
Route::get('/episodes', [EpisodeController::class, 'index']);
Route::post('/episodes', [EpisodeController::class, 'store']);
Route::get('/episodes/{id}', [EpisodeController::class, 'show']);
Route::put('/episodes/{id}', [EpisodeController::class, 'update']);
Route::delete('/episodes/{id}', [EpisodeController::class, 'destroy']);
*/
Route::get('/collections', [CollectionController::class, 'index']);
Route::post('/collections', [CollectionController::class, 'store']);
Route::get('/collections/{collection}', [CollectionController::class, 'show']);
Route::put('/collections/{collection}', [CollectionController::class, 'update']);
Route::delete('/collections/{collection}', [CollectionController::class, 'destroy']);
