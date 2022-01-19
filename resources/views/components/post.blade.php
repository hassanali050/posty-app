@props(['post' => $post])
<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> 
    <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
    <p class="mb-2">{{$post->body}}</p>
    <div class="flex items-center">
        @auth
            @can('delete', $post)
                <div>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">Delete</button>
                    </form>
                </div>
            @endcan    
            @if (!$post->liked_by(auth()->user()))
                <form action="{{route('posts.likes', $post->id)}}" method="POST" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{route('posts.likes', $post)}}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth
        <span>{{$post->likes->count()}} {{Str::plural('like', 
        $post->likes->count())}}</span>
    </div>
</div> <!-- (created_at: Carbon Library for date time management)-->