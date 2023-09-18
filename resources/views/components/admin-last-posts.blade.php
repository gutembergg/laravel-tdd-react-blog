@props(['posts'])

<ul class="pt-8">
    @foreach ($posts as $post)
        
        <li class="text-white font-bold">{{ $post->title }}</li>

    @endforeach
</ul>