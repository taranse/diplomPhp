@extends('layouts.admin')
@section('title', 'Админ панель | Новый вопрос')

@section('content')
    <style>
        h1 {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .cke_contents {
            min-height: 600px !important;
        }
    </style>
    <div class="mar-30"></div>
    <h1>{{$question->name}}
        <span class="right size1 right-align">
            <span class="date-add">Дата добавление: {{$question->created_at}} </span><br>
            <span class="date-update">Последнее изменение: {{$question->updated_at}} </span><br>
            @if($question->state == 0 and $question->block == 0)
                <span class="blue-text">Новый вопрос</span>
            @elseif($question->state == 1 and $question->block == 0)
                <span class="green-text">Вопрос опубликован</span>
            @else
                <span class="red-text">Вопрос заблокирован</span>
            @endif
        </span>
    </h1>
    <h5>
        Рубрика: {{$question->getRubric->name}}
        <form class="right" action="{{route('destroy.admin', $question->id)}}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn red" value="Удалить">
        </form>
    </h5>

    <div class="clear"></div>
    <h4>Пользователь: {{$question->author}} <a href="{{route('edit.question', $question->id)}}" class="right btn">Изменить вопрос</a></h4>
    <p>
        {!! $question->text !!}
    </p>
    <div class="mar-30"></div>
    <div class="divider"></div>
    <form action="{{route('update.question', $question->id)}}" method="POST">

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <textarea required name="answer" id="editor1" rows="10" cols="80">{{$question->answer}}</textarea><br>
        <div class="clear"></div>
        <button class="btn">Ответить</button>
        @if($question->block == 0)
            <a href="{{url('admin/questions/'.$question->id.'/block')}}" class="right red-text">Заблокировать</a>
        @else
            <a href="{{url('admin/questions/'.$question->id.'/unblock')}}" class="right green-text">Разблокировать</a>
        @endif

    </form>
    <script>
        CKEDITOR.replace('editor1');
    </script>

@endsection