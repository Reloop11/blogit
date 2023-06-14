@if(count($tags) > 0)
    <ul>
        @foreach ($tags as $tag)
            <li name='{{$tag->id}}'>{{$tag->name}}</li>
        @endforeach
    </ul>
@endif