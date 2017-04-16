<div class="collection" id="sidebar">
    @foreach($rubrics as $rubric)
        @if($rubric['link'] == $active)
            <a class="collection-item active" href="{{$rubric['link']}}">{{$rubric['title']}}</a>
        @else
            <a class="collection-item" href="{{$rubric['link']}}">{{$rubric['title']}}</a>
        @endif
    @endforeach
</div>