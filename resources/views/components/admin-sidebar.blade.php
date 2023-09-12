<aside :class="{'-translate-x-full': !open, 'w-0': !open}" 
    class="bg-slate-500 text-gray-50 h-screen p-5 w-80 left-0 transform 
    overflow-y-auto transition ease-in-out duration-200 shadow-md">
    {{-- Logo --}}
    <div class="flex justify-between items-center px-2">
        <div class="flex items-center space-x-2">
            <a href="">
                <x-admin-logo class="h-10" />
            </a>
            <span class="text-2xl text-white font-extrabold">Admin</span>
        </div>
        <button @click="open = false" class="hover:bg-slate-400 border-solid border-slate-500 border-2 
            rounded-md p-4 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            
        </button>
    </div>
</aside>

<div :class="{'hidden': open, 'mr-8': !open}">
    <x-admin-sidebar-btn 
        class="h-10 absolute mt-6 left-4 fill-current text-gray-800 dark:text-gray-200"
        @click="open = true"
    />
</div>