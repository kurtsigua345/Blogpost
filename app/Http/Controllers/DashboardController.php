<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Initialize variables
        $posts = collect([]);
        $stats = [
            'total_posts' => 0,
            'published_posts' => 0,
            'total_comments' => 0,
            'total_likes' => 0,
            'draft_posts' => 0,
        ];
        
        // Check if posts table exists
        if (Schema::hasTable('posts')) {
            // Get user's posts
            $posts = Post::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
            
            // Get statistics
            $stats['total_posts'] = Post::where('user_id', $user->id)->count();
            
            // Check if status column exists
            if (Schema::hasColumn('posts', 'status')) {
                $stats['published_posts'] = Post::where('user_id', $user->id)
                                               ->where('status', 'published')
                                               ->count();
                $stats['draft_posts'] = Post::where('user_id', $user->id)
                                           ->where('status', 'draft')
                                           ->count();
            }
        }
        
        return view('dashboard', compact('user', 'stats', 'posts'));
    }
}