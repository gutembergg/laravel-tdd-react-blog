@extends('layouts.admin')

@section('content')
    <div class="p-8 md:min-w-[900px]">
        <x-admin.store-post-form :categories="$categories" />
        <x-admin.last-posts :posts="$posts" class="mt-10" />
    </div>
@endsection


