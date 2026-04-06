<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BlogSystem') }} - Home</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .blog-card {
            transition: transform 0.2s;
        }
        .blog-card:hover {
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-indigo-600">{{ config('app.name', 'BlogSystem') }}</a>
            
            <div class="flex items-center space-x-4">
                <a href="/" class="text-gray-600 hover:text-indigo-600">Home</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600">Blog</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600">About</a>
                
                @auth
                    <a href="/dashboard" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-indigo-600">Logout</button>
                    </form>
                @else
                    <a href="/login" class="text-gray-600 hover:text-indigo-600">Login</a>
                    <a href="/register" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-indigo-600 text-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to {{ config('app.name', 'BlogSystem') }}</h1>
            <p class="text-xl mb-6">Discover amazing stories and insights from our community</p>
            <a href="#" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">Start Reading</a>
        </div>
    </div>

    <!-- Featured Posts -->
    <div class="max-w-6xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Featured Posts</h2>
        
        <div class="grid md:grid-cols-3 gap-6">
            @if(isset($posts) && $posts->count() > 0)
                @php
                    $featuredPosts = $posts->take(3);
                @endphp
                
                @foreach($featuredPosts as $post)
                    <div class="blog-card bg-white rounded-lg shadow overflow-hidden">
                        <img src="https://picsum.photos/400/250?random={{ $post->id }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="text-sm text-indigo-600 mb-2">{{ $post->user->name ?? 'Anonymous' }}</div>
                            <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-3">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="text-indigo-600 hover:underline">Read More →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">No featured posts yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Categories -->
    <div class="bg-white py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Categories</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-blue-100 text-blue-700 p-4 rounded-lg text-center font-semibold">Technology</div>
                <div class="bg-purple-100 text-purple-700 p-4 rounded-lg text-center font-semibold">Design</div>
                <div class="bg-green-100 text-green-700 p-4 rounded-lg text-center font-semibold">Productivity</div>
                <div class="bg-orange-100 text-orange-700 p-4 rounded-lg text-center font-semibold">Lifestyle</div>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">Recent Posts</h2>
            <a href="#" class="text-indigo-600 hover:underline">View All →</a>
        </div>
        
        <div class="space-y-4">
            @if(isset($posts) && $posts->count() > 0)
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow p-4 flex flex-wrap md:flex-nowrap gap-4 hover:shadow-md transition">
                        <img src="https://picsum.photos/120/80?random={{ $post->id }}" alt="{{ $post->title }}" class="w-full md:w-32 h-24 object-cover rounded">
                        <div class="flex-1">
                            <div class="text-sm text-indigo-600 mb-1">By {{ $post->user->name ?? 'Anonymous' }}</div>
                            <h3 class="text-lg font-semibold mb-1">
                                <a href="{{ route('post.show', $post->id) }}" class="hover:text-indigo-600">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm">{{ Str::limit($post->content, 120) }}</p>
                            <div class="text-xs text-gray-400 mt-2">{{ $post->created_at->format('F j, Y') }}</div>
                        </div>
                        <a href="{{ route('post.show', $post->id) }}" class="text-indigo-600 hover:underline self-center">Read →</a>
                    </div>
                @endforeach
                
                @if($posts->hasPages())
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <p class="text-gray-500 mb-4">No posts yet. Be the first to create a post!</p>
                    @guest
                        <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Create an account to start blogging
                        </a>
                    @endguest
                </div>
            @endif
        </div>
    </div>

    <!-- Newsletter -->
    <div class="bg-indigo-600 text-white py-12">
        <div class="max-w-2xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-2">Subscribe to Newsletter</h2>
            <p class="mb-4">Get the latest posts delivered to your inbox</p>
            <form class="flex gap-2 max-w-md mx-auto">
                <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded text-gray-900">
                <button type="submit" class="bg-white text-indigo-600 px-6 py-2 rounded font-semibold hover:bg-gray-100">Subscribe</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'BlogSystem') }}. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>