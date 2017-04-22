<div class="collection with-header" id="sidebar">
    <div class="collection-header"><b>{{$header}}</b></div>
    @foreach($links as $link)
        @if($link->link == $active->link)
            <a class="collection-item active" href="{{$link->link}}">{{$link->name}}</a>
        @else
            <a class="collection-item" href="{{$link->link}}">{{$link->name}}</a>
        @endif
    @endforeach
</div>