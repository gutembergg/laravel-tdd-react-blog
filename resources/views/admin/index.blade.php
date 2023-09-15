<x-admin-layout>

<div class="flex" x-data="{ open: true }">
    {{-- Sidebar --}}
    <x-admin-sidebar />

    {{-- Content --}}
    <section class="flex text-gray-50 p-7">

        <x-store-post-form :categories="$categories" />
        
    </section>
</div>
          
</x-admin-layout>
