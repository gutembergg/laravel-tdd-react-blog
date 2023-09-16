@extends('layouts.admin')

@section('content')
    <div class="p-8">
        <x-store-post-form :categories="$categories" />
    </div>
@endsection


{{-- <x-admin-layout>

<div class="flex" x-data="{ open: true }">
    <x-admin-sidebar />

</div>
          
</x-admin-layout> --}}
