@props(['posts'])

<div {{ $attributes }}>
  <table class=" max-w-[900px] w-full text-sm text-left text-gray-500 dark:text-gray-400 
    border-collapse  border border-slate-500 rounded-md">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 
          dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-2">ID</th>
            <th scope="col" class="px-4 py-2">Title</th>
            <th scope="col" class="px-4 py-2">Created at</th>
            <th scope="col" class="px-4 py-2">Updated at</th>
            <th scope="col" class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr class="hover:bg-slate-100 hover:text-black cursor-pointer">
              

                  <td class="px-4 py-2">
                    <a href="{{ route('posts.web-show', $post->slug) }}" class="h-full block z-50">{{ $post->id }}</a></td>
                  <td class="px-4 py-2"><a href="{{ route('posts.web-show', $post->slug) }}" class="h-full block z-50">{{ $post->title }}</a></td>
                  <td class="px-4 py-2"><a href="{{ route('posts.web-show', $post->slug) }}" class="h-full block z-50">{{ $post->created_at }}</a></td>
                  <td class="px-4 py-2"><a href="{{ route('posts.web-show', $post->slug) }}" class="h-full block z-50">{{ $post->updated_at }}</a></td>
                  <td class="px-6">
                    delete
                  {{--  <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}

                </td>
              </a>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
  
{{--         
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
 --}}
