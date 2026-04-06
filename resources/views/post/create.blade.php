<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Create New Post</h2>

                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Title</label>
                            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Content</label>
                            <textarea name="content" rows="10" class="w-full border rounded px-3 py-2" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full border rounded px-3 py-2">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Create Post</button>
                        <a href="{{ route('posts.index') }}" class="ml-2 text-gray-600">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>