@extends('layouts.admin')
@section('title', 'Админ панель | '. $rubric->name)

@section('content')
    <style>
        label {
            margin: 0 10px
        }
    </style>
    <div class="mar-30"></div>
    @if(isset($edit))
        <a class="btn green" href="{{url('admin/rubrics/'.$rubric->alias)}}">Назад</a><br><br><br>
        <form id="form-edit" action="{{route('update.rubric', $rubric->alias)}}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-field">
                <input id="name" name="name" type="text" required value="{{$rubric->name}}">
                <label for="name">Название вопроса</label>
            </div><br>
            <div class="input-field">
                <input id="alias" name="alias" type="text" required value="{{$rubric->alias}}">
                <label for="alias">Алиас</label>
            </div><br>
        </form>
        <button form="form-edit" class="btn blue">Сохранить</button>
        <div class="right center-align">
            <p>
                Количество вопросов в рубрике: {{count($questions)}}
            </p>
            <a class="btn red darken-2 right" href="{{url('admin/rubrics/'.$rubric->alias.'/delete-questions')}}">Удалить все</a>
        </div>
    @endif
    @if(!isset($edit))
        <h2>{{$rubric->name}} </h2>
        <a class="btn blue" href="{{route('edit.rubric', $rubric->alias)}}">Редактировать рубрику</a>
        <div class="right filter">
            <input type="checkbox" value="0" id="new-filter"
                   @if(in_array('0', $filter) or $filter == [])
                   checked
                    @endif
            >
            <label class="blue-text" for="new-filter">Новые</label>
            <input type="checkbox" value="1" id="public-filter"
                   @if(in_array('1', $filter) or $filter == [])
                   checked
                    @endif
            >
            <label class="green-text" for="public-filter">Опубликованные</label>
            <input type="checkbox" value="-1" id="block-filter"
                   @if(in_array('-1', $filter) or $filter == [])
                   checked
                    @endif
            >
            <label class="red-text" for="block-filter">Заблокированные</label>
            <button class="btn">Применить</button>
        </div>
    @endif
    <script>
        $(function () {
            $('.filter button').click(function () {
                var str = Array.from($('.filter').find('input[type=checkbox]')).reduce(function (str, value) {
                    if (value.checked) {
                        return str + value.value + ',';
                    }
                    return str;
                }, '');
                var filter = str.substr(0, str.length - 1);
                if (filter === '0,1,-1' || filter === '') {
                    window.location = '{{url('admin/rubrics/'.$rubric->alias)}}';
                } else {
                    window.location = '{{url('admin/rubrics/'.$rubric->alias.'?filter=')}}' + filter;
                }
            })
        })

    </script>
    <div class="clear"></div>
    <br><br>
    @if(!isset($edit))
        @forelse($questions as $question)
            <div class="card z-depth-2 lighten-5
            @if($question->block)
                    red
            @elseif($question->state)
                    green
            @else
                    blue-grey
            @endif
                    ">
                <div class="card-content">
                <span class="card-title left">
                    {{$question->name}}
                    @if($question->block)
                        <span class="red-text">(Заблокировано)</span>
                    @elseif($question->state)
                        <span class="red-text green-text">(Опубликованный)</span>
                    @else
                        <span class="red-text blue-text text-lighten-2">(Новый)</span>
                    @endif
                </span>
                    <span class="card-title right">{{$question->author}}</span>
                    <div class="clear"></div>
                    <span>Дата добавления: {{$question->created_at}}</span>
                    <div class="mar-30"></div>
                    <p>{!! $question->text !!}</p>
                </div>
                <div class="card-action">
                    <div>
                        <a href="{{route('show.question', $question->id)}}">Просмотреть</a>
                        @if($question->block == 0)
                            <a href="{{url('admin/questions/'.$question->id.'/block')}}" class="red-text">Заблокировать</a>
                        @else
                            <a href="{{url('admin/questions/'.$question->id.'/unblock')}}" class="green-text">Разблокировать</a>
                        @endif
                    </div>
                    <form action="{{route('destroy.question', $question->id)}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn red" value="Удалить">
                    </form>
                </div>
            </div>
        @empty
            <h4>В этой рубрике нет вопросов</h4>
        @endforelse
        {{ $questions->links() }}
    @endif
@endsection