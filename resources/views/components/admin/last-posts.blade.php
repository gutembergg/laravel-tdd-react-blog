@props(['posts'])

<ul class="pt-8">
    @foreach ($posts as $post)
        
        <li class="text-white font-bold">
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                @if (count($post->medias) !== 0)
                    <img class="w-full" src="storage/{{ $post->medias[0]->path }}" alt="Sunset in the mountains">
                @endif
                <div class="px-6 py-4">
                  <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                  <p class="text-gray-700 text-base">
                    {{ $post->content }}
                  </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                </div>
              </div>
        </li>

    @endforeach
</ul>