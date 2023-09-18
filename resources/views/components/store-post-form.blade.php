@props(['categories'])

<form action="{{ route('posts.store') }}" method="post" 
    class="flex md:flex flex-col space-y-2" 
    x-data="{ collapse: false }"
>
    @csrf
    @method('post')

    <button type="button" @click="collapse = !collapse" class="hs-collapse-toggle 
        py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border
        border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 
         dark:focus:ring-indigo-600 shadow-sm" 
        >
        <h2 class="text-2xl dark:text-white font-extrabold">Add a new Post</h2>
        <svg class="hs-collapse-open:rotate-180 w-2.5 h-2.5 text-white" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
      <div id="hs-basic-collapse-heading" :class="{'hidden': !collapse}" class="hs-collapse overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-collapse">
        <div class="mt-5">
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
        </div>
      </div>

</form>
    