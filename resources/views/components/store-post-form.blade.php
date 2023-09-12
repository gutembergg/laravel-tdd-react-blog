<div>
    <h2>Add a new Post</h2>

    <div class="space-y-2">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            @method('post')
            <div>
                <x-input-label for="title" :value="'Title'" />
                <x-text-input id="title" class="bg-gray-50 border border-gray-300 pt-2 pb-2 pl-4 mb-4"
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

            <button type="submit">
                Register
            </button>
        </form>
       
    </div>
</div>