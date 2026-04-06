<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home page - Show all published posts
Route::get('/', function () {
    // Get only published posts, ordered by latest first
    $posts = Post::where('status', 'published')
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
    
    return view('home', compact('posts'));
})->name('home');

// Post show page - For guests to view individual posts
Route::get('/post/{id}', function ($id) {
    $post = Post::where('id', $id)
                ->where('status', 'published')
                ->with('user')
                ->firstOrFail();
    
    return view('post.show', compact('post'));
})->name('post.show');

// Dashboard
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Post routes (protected for authenticated users)
Route::middleware(['auth'])->group(function () {
    // Add 'show' back to the resource
    Route::resource('posts', PostController::class)->except([]); // Remove the except
    // OR explicitly add just the show route
    // Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    // Route::resource('posts', PostController::class)->except(['show']);
});

// Auth routes
require __DIR__.'/auth.php';