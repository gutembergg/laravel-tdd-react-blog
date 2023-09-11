<x-admin-layout>

<div class="flex" x-data="{ open: true }">
    {{-- Sidebar --}}
    <x-admin-sidebar />

    {{-- Content --}}
    <div class="flex text-gray-50 p-7">

       <section>
            <x-store-post-form />
       </section>
        
    </div>
</div>
          
</x-admin-layout>
