@props(['posts'])

<div>


<table class="table-fixed w-full text-white mt-6 border-2 border-white">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($posts as $post)
        <tr>
            <td class="text-center">{{ $post->id }}</td>
            <td class="text-center">{{ $post->title }}</td>
            <td class="text-center">{{ $post->created_at }}</td>
            <td class="text-center">{{ $post->updated_at }}</td>
            <td class="text-center">
              delete
             {{--  <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form> --}}

           </td>
           @endforeach
        </tr>
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
