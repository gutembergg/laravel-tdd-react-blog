<x-admin-layout>

<div class="flex" x-data="{ open: true }">
    {{-- Sidebar --}}
    <x-admin-sidebar />

    {{-- Content --}}
    <section class="flex flex-1 text-gray-50 p-7">

        <x-store-post-form />
        
    </section>
</div>
          
</x-admin-layout>
