@props(['categories'])

<form action="{{ route('posts.store') }}" method="post" class="flex md:flex flex-col space-y-2">
    @csrf
    @method('post')
    <h2 class="text-2xl dark:text-white font-extrabold">Add a new Post</h2>

    <div class="flex md:flex-row flex-col">
        <div>
            <div>
                <x-input-label for="title" :value="'Title'" class="pb-2" />
                <x-text-input id="title" class="bg-gray-50 border border-gray-300
                    pt-2 pb-2 pl-4 mb-4"
                    type="title"
                    name="title"
                    required 
                />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="content" :value="'Content'" class="pb-2" />
                <x-textarea id="content" name="content" />
                <x-input-error :messages="$errors->get('content')" class="mt-2" />

            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 w-full mt-4 text-white font-bold py-2 px-4 rounded-md">
                Register
              </button>
        </div>
        <div class="pl-6">
            <x-input-label for="categories" :value="'Categories'" class="pb-2" />
            <x-input-select :options="$categories" name="categories" />
        </div>
    </div>
   
   
</form>
    