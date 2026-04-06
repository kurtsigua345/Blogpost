<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">My Posts</h2>
                        <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Create New Post</a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($posts->count() > 0)
                        <div class="space-y-4">
                            @foreach($posts as $post)
                                <div class="border p-4 rounded">
                                    <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                                    <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
                                    <div class="flex justify-between items-center mt-3">
                                        <span class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                                        <div class="space-x-2">
                                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600">View</a>
                                            <a href="{{ route('posts.edit', $post) }}" class="text-green-600">Edit</a>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600" onclick="return confirm('Delete this post?')">Delete</button>
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
                        <p class="text-gray-500 text-center py-8">No posts yet. Create your first post!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>