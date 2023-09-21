@extends('layouts.admin')

@section('content')
    <div class="h-screen p-8">
        <h1 class="text-white">Categories</h1>

        <ul class="text-white">
            @foreach ($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection