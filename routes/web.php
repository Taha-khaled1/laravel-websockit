<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MassgeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/chats', [MassgeController::class, 'index'])->name('chats.index');

// Show a Chat and Its Messages
Route::get('/chats/show', [MassgeController::class, 'show'])->name('chats.show');

// Create a New Chat
Route::get('/chats/create', [MassgeController::class, 'createChat'])->name('chats.create');

// Send a Message to a Chat
Route::get('/chats/send', [MassgeController::class, 'sendMessage'])->name('chats.sendMessage');






Route::get('/user/send-message', [ChatController::class, 'sendMessage']);
Route::get('/get-messages',[ChatController::class, 'getMessages']);


Route::get('/user/register', [UserController::class, 'register']);
Route::get('/user/count', [UserController::class, 'count']);
Route::get('/users', [UserController::class,'show']);
Route::post('/send-message', [PostController::class,'sendMessage'])->middleware('auth');
Route::get('test',[PostController::class,'test'])->name('test');
Route::get('goToChat',[PostController::class,'goToChat'])->name('goToChat');
Route::get('/', function () {
    $usersdata = User::all();
    return view('welcome',compact("usersdata"));
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';