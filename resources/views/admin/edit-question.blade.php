@extends('layouts.admin')
@section('title', 'Админ панель | Редактирование вопроса ' . $question->name)

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
    <form action="{{route('update.question', $question->id)}}" method="POST">
        <h5>
            Название вопроса:
            <input type="text" value="{{$question->name}}" name="name"><br>
            Рубрика:
            <select name="rubric" class="browser-default inline">
                @foreach($rubrics as $rubric)
                    @if($rubric->id == $question->getRubric->id)
                        <option selected value="{{$rubric->id}}">{{$rubric->name}}</option>
                    @else
                        <option value="{{$rubric->id}}">{{$rubric->name}}</option>
                    @endif
                @endforeach
            </select><br><br>
            Пользователь: <input class="browser-default" type="text" name="author" value="{{$question->author}}">
        </h5>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <textarea required name="text" id="editor1" rows="10" cols="80">{!! $question->text !!}</textarea><br>
        <div class="clear"></div>
        <button class="right btn">Сохранить</button>
    </form>
    <script>
        CKEDITOR.replace('editor1');
    </script>

@endsection