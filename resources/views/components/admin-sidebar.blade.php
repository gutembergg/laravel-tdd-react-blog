<div class="flex" x-data="{ open: true }">
    <aside :class="{'-translate-x-full': !open, 'w-72': open, 'w-20': !open}" 
        class="bg-slate-800  p-5 leinset-y-0 ft-0 transform
        overflow-y-auto transition duration-200 shadow-md">
        {{-- Logo --}}
        <div class="flex-col justify-between items-center px-2 cursor-pointer">
            <div class="flex items-center justify-between w-full space-x-2">
                <div class="flex items-center">
                    <a href="">
                        <x-admin-logo class="h-10 text-white" />
                    </a>
                    <span class="text-2xl text-white ml-2 font-extrabold">Admin</span>
                </div>

                <button @click="open = false" class="bg-slate-700 text-white
                     hover:bg-slate-600 border-solid rounded-md p-3 focus:outline-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    
                </button>
            </div>

            <ul class="mt-16 space-y-4 dark:text-white text-black font-semibold text-[25px]">
                <li class=""><a href="{{ route('dashboard') }}">Posts</a></li>
                <li>
                    <a href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li><a href="{{ route('dashboard') }}">Profile</a></li>
            </ul>

           
        </div>
    </aside>

    <div :class="{'hidden': open}" class="flex-grow-0">
        <x-admin-sidebar-btn 
            class="h-10 absolute mt-6 left-4 fill-current text-gray-800 dark:text-gray-200 cursor-pointer"
            @click="open = true"
        />
    </div>
</div>