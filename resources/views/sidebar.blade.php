<div class="collection with-header" id="sidebar">
    <div class="collection-header"><b>{{$data['header']}}</b></div>
    <p class="collection-item active">{{$data['activeName']}}</p>
    <div class="collection-header"><input type="text" placeholder="Найти" class="search"></div>
    @foreach($data['links'] as $link)
        @if($link->alias != $data['activeAlias'])
            <a class="collection-item" href="{{url($link->alias)}}">{{$link->name}}</a>
        @endif
    @endforeach
</div>