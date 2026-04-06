<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800">Welcome back, {{ $user->name }}!</h1>
                    <p class="text-gray-600 mt-2">Here's what's happening with your blog today.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Posts</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_posts'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Published Posts</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['published_posts'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Comments</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_comments'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Likes</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_likes'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white text-center py-3 rounded-lg hover:bg-indigo-700 transition">
                            ✍️ Create New Post
                        </a>
                        <a href="{{ route('posts.index') }}" class="bg-gray-600 text-white text-center py-3 rounded-lg hover:bg-gray-700 transition">
                            📝 View All Posts
                        </a>
                        <a href="{{ route('profile.edit') }}" class="bg-green-600 text-white text-center py-3 rounded-lg hover:bg-green-700 transition">
                            👤 Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Recent Posts</h2>
                        <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:underline text-sm">View All →</a>
                    </div>
                    
                    @if(isset($posts) && $posts->count() > 0)
                        <div class="space-y-4">
                            @foreach($posts as $post)
                                <div class="border-b pb-3 last:border-b-0">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="font-medium text-gray-800 hover:text-indigo-600">
                                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                            </h3>
                                            <div class="flex items-center gap-3 mt-1">
                                                <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                                                @if(isset($post->status))
                                                    @if($post->status == 'published')
                                                        <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded">Published</span>
                                                    @else
                                                        <span class="text-xs bg-yellow-100 text-yellow-600 px-2 py-0.5 rounded">Draft</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                            <span class="text-gray-300">|</span>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">You haven't created any posts yet.</p>
                            <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 inline-block">
                                Create Your First Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>