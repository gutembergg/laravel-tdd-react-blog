<h2>Add a new Post</h2>

    <form action="{{ route('posts.store') }}" method="post" class="space-y-2 w-full">
        @csrf
        @method('post')
        <div>
            <x-input-label for="title" :value="'Title'" />
            <x-text-input id="title" class="bg-gray-50 border border-gray-300
                pt-2 pb-2 pl-4 mb-4"
                type="title"
                name="title"
                required 
            />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="content" :value="'Content'" />
            <x-textarea id="content" name="content" />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />

        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Register
        </button>
    </form>
       