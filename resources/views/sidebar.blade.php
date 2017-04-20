<div class="collection" id="sidebar">
    @foreach($rubrics as $rubric)
        @if($rubric->link == $active->link)
            <a class="collection-item active" href="{{$rubric->link}}">{{$rubric->name}}</a>
        @else
            <a class="collection-item" href="{{$rubric->link}}">{{$rubric->name}}</a>
        @endif
    @endforeach
</div>